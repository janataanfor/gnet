

 @extends('master')

@section('content')

<hr>
    @if (session('status')==1)
    <div class="alert alert-success mt-3">
        {{ session('status') }} تم ارسال رمز التفعيل بنجاح (:
    </div>
    @elseif(session('status')==2)
    <div class="alert alert-danger mt-3">
        {{ session('status')."ليس ثمة بطاقات" }}
    </div>
    @endif

    @foreach($errors->all() as $error)
    <div class="alert alert-warning mt-3">
        {{ $error }}
    </div>
    @endforeach

<div class="row m-auto">

  <div class="col-sm-12">
    <div class="card border-primary text-center">
        <a href="/home/category:{{$category->id}}">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title ">{{$category->title}}</h4>
        </a>
            <p class="card-text">{{$category->description}}.</p>
            <form class="m-auto" method="POST" action="/home/{{$category->id}}/sendserial">
                {{ csrf_field() }}
                <div class="form-row align-items-center">
                    <div class=" col-auto m-auto form-group">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg text-center" id="number" name="number" aria-describedby="emailHelp" placeholder="Enter phone number">
                            <small id="numberHelp" class="form-text text-muted">Insert full phone number like: 0592033448</small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">أرسل رمز التفعيل</button>
            </form>
           
        </div>
    </div>
  </div>

 </div>
 @stop