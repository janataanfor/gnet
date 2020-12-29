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
                    <form method="POST" action="/home/storecategory">
                    {{csrf_field()}}
                       <!--  <div class="form-group">
                            <label class="col-form-label float-right" for="url">صورة الفئة :</label>
                            <input type="file" class="form-control form-control-lg form-control-file" id="url" name="url">
                        </div> -->
                        <div class="form-group">
                            <label class="col-form-label float-right" for="formGroupExampleInput">الفئة:</label>
                            <input type="number" class="form-control form-control-lg" id="title" name="title" placeholder="اسم الفئة الذي يظهر للزبون">
                        </div>
                        <div class="form-group">
                            <label class="float-right" for="exampleFormControlTextarea1">التفاصيل:</label>
                            <textarea class="form-control form-control-lg" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary ">حفظ</button>
                    </form>
                    
                </div>
            </div>
        </div>

        </div>
    </div>
</section>
 @stop