@extends('master')

@section('content')

<section class="pb-5">
    <div class="container">
        <div class="row ">

        <div class="col-sm-6 m-auto">
            <div class="card border-primary text-center">
                <div class="card-body ">
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
                    <form method="POST" action="/home/storeserials" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-form-label float-right" for="url">ملف أرقام التفعيل:</label>
                            <input type="file" class="form-control form-control-file " id="url" name="url">
                        </div>
                        
                        <button type="submit" class="btn btn-lg btn-primary ">رفع</button>
                    </form>
                  
                    
                </div>
            </div>
        </div>

        </div>




        </div>
</section>

 @stop

