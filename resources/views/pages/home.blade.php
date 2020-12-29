@extends('master')

@section('content')
<section class="all-cards wow slideInUp " data-wow-duration="2s" >
    <div class="container">
        <div class="row ">
            <h4 class="pr-4 pb-2" style="color:gray">اختر فئة واشحن الان ..</h4>
        </div>
             @if (session('status') == -2)
            <div class="alert alert-danger mt-3">
رصيدك لا يكفي لهذه العملية
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('status') == -1)
            <div class="alert alert-danger mt-3">
             لم يتم الارسال، ليس ثمة بطاقات من فئة {{session('category')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('status')==1)
            <div class="alert alert-success mt-3">
                 تم ارسال رمز التفعيل لاشتراك من فئة {{ session('category') }} إلى رقم الجوال {{session('num')}} بنجاح (:
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            @endif

            @foreach($errors->all() as $error)
            <div class="alert alert-warning mt-3">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach

        <div class="row m-auto">

            @foreach($categories as $category)

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card border-primary text-center myvisible">

                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div class="card-body">
                        
                    <a class="card-link" href="/home/category:{{$category->id}}">    
                        <h4 class="card-title ">{{$category->title}} 
                        @if(Auth::user()->hasRole('admin'))
                        <span class="badge badge-secondary">{{$category->serials->count()}}</span>
                        @endif
                        </h4> 
                    </a>
                        
                        <p class="card-text">{{$category->description}}.</p>
                        <form  method="POST" action="/home/{{$category->id}}/sendserial" id="validform{{$category->id}}" >
                        {{ csrf_field() }}
                            <div class="form-group">
                                <input type="number" class="form-control text-center" id="number{{$category->id}}" oninput="vFunction({{$category->id}})" name="number"  placeholder="أدخل رقم الجوال" >
                                <p id="cond{{$category->id}}"></p>
                                <small id="numberHelp" class="form-text text-muted">أدخل رقم الجوال كاملاً، مثال: 0599123125</small>
                            </div>
                
                            <button onclick="return validate({{$category->id}});" id="triger-val{{$category->id}}" class="btn btn-primary" disabled>أرسل رمز التفعيل</button>
                            <input type="submit" id="submit-form{{$category->id}}" style="display:none" />
                        </form>
                        
                        
                        

                    </div>
                </div>
            </div>

            <div class="modal my_modal{{$category->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اشتراك من فئة {{$category->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>سيتم إرسال رقم التفعيل لاشتراك من فئة {{$category->title}} إلى رقم الجوال <strong id="pnumber{{$category->id}}" ></strong></p> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" value="Submit" onclick="return submitMy({{$category->id}});"  class="btn btn-primary" >تأكيد العملية</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        

    </div>

    
</section>

<script src="/js/popper.min.js"></script>

<script>

   
    
    $(function () {
        $('[data-toggle="popover"]').popover()
      });


    function vFunction(id) {
    var x = document.getElementById("number"+id).value;
    var ncount = x.toString().length;
    //document.getElementById("cond"+id).innerHTML = "You wrote: "+ ncount;

    var maxLength = 10;
    if (ncount > maxLength)
    document.getElementById("number"+id).value = document.getElementById("number"+id).value.slice(0, maxLength);
   

    $('#number'+id).popover(
        {
        trigger: 'manualy',
        html: true,
        placement: 'top',
        content: 'حد أدنى 10',
        title:'osama'
        });
if(ncount == '0'){

    $('#number'+id).attr('data-content','حد أدنى 10');
    $('#number'+id).popover('hide');  
    $('#triger-val'+id).attr("disabled", true);
    }else{
        if(ncount < '10'){
        $('#number'+id).attr('data-original-title', x);
        $('#number'+id).attr('data-content','حد أدنى 10');
        $('#number'+id).popover('show'); 
        $('#triger-val'+id).attr("disabled", true);

        }else{
            if(ncount == '10'){
               
            $('#number'+id).attr('data-original-title', x);
            $('#number'+id).attr('data-content','أرسل الآن');
            $('#number'+id).popover('show'); 

            $('#triger-val'+id).removeAttr("disabled");

            }
        }
    }

}

    function validate(id) {
        event.preventDefault();
        
        document.getElementById("pnumber"+id).innerHTML = document.getElementById("number"+id).value;
        $('.my_modal'+id).modal();
        

    }

    function submitMy(id){
        $("#validform"+id).submit();
    }

 
</script>

@stop