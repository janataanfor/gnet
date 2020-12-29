@extends('master')

@section('content')
<section class="all-cards wow slideInUp " data-wow-duration="2s" >
    <div class="container">
        <div class="row ">
            <h4 class="pr-4 pb-2" style="color:gray">قائمة عمليات الشحن ..</h4>
        </div>

        <table class="table table-light">
            <thead>
            <form method="post" id="sort1" action="/home/report:category">{{csrf_field()}}<input type="hidden" name="sort" value="category"></form>
            <form method="post" id="sort2" action="/home/report:date">{{csrf_field()}}<input type="hidden" name="sort" value="date"></form>
            
                <tr>
                <th scope="col">#</th>
                @if(Auth::user()->hasRole('admin'))
                <th scope="col">الاسم</th>
                @endif
                <th scope="col" onClick="$('#sort1').submit()" class="sortbtn">الفئة</th>
                <th scope="col">الرمز</th>
                <th scope="col">الجوال</th>
                <th scope="col" onClick="$('#sort2').submit()" class="sortbtn">تاريخ العملية </th>

                </tr>
            
            </thead>
            <tbody>
                
            
            @foreach($reports as $key=>$report)
            
                <tr>
                <th scope="row">{{$key+1}}</th>
                @if(Auth::user()->hasRole('admin'))
                <td>{{$report->user}}</td>
                @endif
                <td>{{$report->category}}</td>
                <td>{{$report->serial}}</td>
                <td>{{$report->mobile}}</td>
                <td>{{$report->created_at->toDateTimeString()}}</td>

                </tr>
                <tr>
            
            @endforeach
            </tbody>
        </table>
                        

       
        
        

    </div>

    
</section>

@stop