@extends('master')

@section('content')
<section class="all-cards wow slideInUp " data-wow-duration="2s" >
    <div class="container">
        <div class="row ">
            <h4 class="pr-4 pb-2" style="color:gray">قائمة التفعيلات ..</h4>
            <form method="post" action="/home/serials">
            {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <select id="inputState" name="select_cat" class="form-control" onchange="this.form.submit()">
                            <option selected>اختر حسب الفئة...</option>
                            <option value="-1">كل التفعيلات</option>
                        @foreach($categories as $key=>$category)
                            <option value="{{$key+1}}" >{{$category->id}}</option>
                            
                        @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <table class="table table-light">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">الفئة</th>
                <th scope="col">رمز التفعيل</th>
                <th scope="col">تاريخ الاضافة</th>
                <th scope="col">
                <button type="submit" onClick="return deletevalidate(-1);" class="btn btn-danger"> حذف الكل</button>
                </th>
                </tr>
            </thead>
            <tbody>
            @foreach($serials as $key=>$serial)

            <form method="post" action="/delete/{{$serial->id}}">{{csrf_field()}}</form>

           
                <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$serial->category_id}}</td>
                <td>{{decrypt($serial->serial)}}</td>
                <td>{{$serial->created_at->toDateTimeString()}}</td>
             

                
                <td>
                    <button type="submit" onClick="return deletevalidate({{$serial->id}});" class="btn btn-danger"> حذف</button>
                </td>
                
                </tr>
                <tr>

                <div class="modal my_d_modal{{$serial->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تأكيد بالحذف</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>سيتم حذف رمز التفعيل {{decrypt($serial->serial)}}</p> 
                        </div>
                        <div class="modal-footer">
                            <a href="deleteserial/{{$serial->id}}"><button type="button" class="btn btn-primary" > حذف</button></a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
                        

       
        
        

    </div>

    <div class="modal my_d_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد بالحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>سيتم حذف كل التفعيلات </p> 
            </div>
            <div class="modal-footer">
                <a href="deleteserial/-1"><button type="button" class="btn btn-primary" > حذف</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
            </div>
        </div>
    </div>

    
</section>

<script>
    function deletevalidate(id) {
        event.preventDefault();
        if(id == -1){
            $('.my_d_modal').modal();
        }else{
            $('.my_d_modal'+id).modal();
        }
        
        

    }
</script>

@stop