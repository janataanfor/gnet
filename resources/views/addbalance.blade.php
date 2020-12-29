@extends('master')

@section('content')
<section class="pb-5 ">
    <div class="container">
    

        <div class="row ">
        <div class="col-sm-6 mx-auto">
             @if (session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            @foreach($errors->all() as $error)
                <div class="alert alert-warning mt-3">
                    {{ $error }}
                </div>
            @endforeach
            <div class="card border-primary text-center">
                <div class="card-body ">
                    <form method="POST" action="/home/addbalance/{{$user->id}}">
                    {{csrf_field()}}
                      
                        <div class="form-group">
                            <label class="col-form-label float-right" for="formGroupExampleInput"></label>
                        </div>

                        <h5>{{$user->name}}</h5>
                        <div class="dropdown-divider"></div>
                        <div class="form-group">
                            <label class="col-form-label float-right" for="formGroupExampleInput">الرصيد</label>
                            <input type="number" max="9999" class="form-control form-control-lg" value="{{$user->balance}}" id="balance" name="balance" placeholder="إضافة رصيد">
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary ">اشحن</button>
                    </form>
                    
                </div>
            </div>
        </div>

        </div>
    </div>
</section>
 @stop