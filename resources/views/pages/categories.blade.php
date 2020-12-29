@extends('master')

@section('content')
<section class="all-cards wow slideInUp " data-wow-duration="2s" >
    <div class="container">
        <div class="row ">
            <h4 class="pr-4 pb-2" style="color:gray">قائمة الفئات ..</h4>
        </div>

        <table class="table table-light">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">الفئة</th>
                <th scope="col">الوصف</th>
                <th scope="col">تاريخ إضافة الفئة</th>

                </tr>
            </thead>
            <tbody>
            @foreach($categories as $key=>$category)

            <form method="post" action="/delete/{{$category->id}}">{{csrf_field()}}</form>
            <form method="post" action="/update/{{$category->id}}">{{csrf_field()}}</form>

           
                <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->created_at->toDateTimeString()}}</td>
             

                <td>
                
                    <a href="editecategory/{{$category->id}}"><button href="" class="btn btn-warning"> تعديل</button></a>
                </td>
                <td>
                    <button type="submit" onClick="return deletevalidate({{$category->id}});" class="btn btn-danger"> حذف</button>
                </td>
                
                </tr>
                <tr>

                <div class="modal my_d_modal{{$category->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تأكيد بالحذف</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>سيتم حذف الفئة {{$category->title}}</p> 
                        </div>
                        <div class="modal-footer">
                            <a href="deletecategory/{{$category->id}}"><button type="button" class="btn btn-primary" > حذف</button></a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
                        

       
        
        

    </div>

    
</section>

<script>
    function deletevalidate(id) {
        event.preventDefault();
        
        $('.my_d_modal'+id).modal();
        

    }
</script>

@stop