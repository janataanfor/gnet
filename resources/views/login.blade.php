@extends('master')

@section('content')
<section class="pb-5 ">
    <div class="container">
    

        <div class="row ">
        <div class="col-sm-6 mx-auto">
            @foreach($errors->all() as $error)
                <div class="alert alert-warning mt-3">
                    {{ $error }}
                </div>
            @endforeach
            <div class="card border-primary text-center">
                <div class="card-body ">
                    <form method="POST" action="/login">
                    {{csrf_field()}}
                      
                        <div class="form-group">
                            <label class="col-form-label float-right" for="formGroupExampleInput">اسم المستخدم</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="اسم المستخدم للدخول للموقع">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label float-right" for="formGroupExampleInput">كلمة السر</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="كلمة السر">
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary ">تسجيل الدخول</button>
                    </form>
                    
                </div>
            </div>
        </div>

        </div>
    </div>
</section>
 @stop