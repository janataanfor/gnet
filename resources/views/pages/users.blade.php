@extends('master')

@section('content')
<section class="all-cards wow slideInUp " data-wow-duration="2s" >
    <div class="container">
        <div class="row ">
            <h4 class="pr-4 pb-2" style="color:gray">قائمة المستخدمين ..</h4>
        </div>

        <table class="table table-light">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">الاسم</th>
                <th scope="col">الايميل</th>
                <th scope="col">الرصيد</th>
                <th scope="col">تاريخ التسجيل</th>
                <th scope="col">مستخدم </th>
                <th scope="col"> مسؤول</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $key=>$user)

            <form method="post" action="/addbalance/{{$user->id}}">{{csrf_field()}}</form>
            <form method="post" action="/delete/{{$user->id}}">{{csrf_field()}}</form>
            <form method="post" action="/update/{{$user->id}}">{{csrf_field()}}</form>

            <form method="post" action="/addrole"> 
            {{csrf_field()}}
            <input type="hidden" name="email" value="{{$user->email}}">
           
                <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->balance}}</td>
                <td>{{$user->created_at->toDateTimeString()}}</td>
                <td>
                    <input type="checkbox" name="role_user" onChange="this.form.submit()" {{$user->hasRole('user') ? 'checked' : '' }} >
                </td>
                <td>
                <input type="checkbox" name="role_admin" onChange="this.form.submit()" {{$user->hasRole('admin') ? 'checked ' : '' }}>
                </td>
                </form>
                <td>
                    <a href="addbalance/{{$user->id}}"><button class="btn btn-success"> شحن</button></a>
                </td>
                

                <td>
                @if(!$user->hasRole('admin'))
                    <a href="editeuser/{{$user->id}}"><button href="" class="btn btn-warning"> تعديل</button></a>
                </td>
                <td>
                    <button type="submit" onClick="return deletevalidate({{$user->id}});" class="btn btn-danger"> حذف</button>
                </td>
                @endif
                </tr>
                <tr>

                <div class="modal my_d_modal{{$user->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تأكيد بالحذف</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>سيتم حذف المستخدم {{$user->name}}</p> 
                        </div>
                        <div class="modal-footer">
                            <a href="deleteuser/{{$user->id}}"><button type="button" class="btn btn-primary" > حذف</button></a>
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