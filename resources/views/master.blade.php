<!doctype html>
<html lang="ar">
  <head>
    <title>GazaNet!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="/css/animate.css" rel="stylesheet"/>
    <link href="/css/mystyle.css" rel="stylesheet"/>
    <style>
    </style>
  </head>
  <body>
      <div class="test"><div class="test-color"></div></div>
    
    <!-- start navbar --> 
    <div class="container fixed-top"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class=" navbar-toggler no-border col-5">
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>
            </div>
            <div id ="sandh"class="col-5 order-sm-3 order-xs-3 order-lg-1 go-left hidden-md">
                @if(Auth::check())
               <strong id="huser" onclick="hideme()" >{{Auth::user()->name}}</strong><a class="nav-link"  id="hlogout" href="/logout"><strong>خروج</strong></a>
                 | <span class="d-xs-none d-sm-none d-md-inline">رصيدك</span>
                 <strong >@if(Auth::user()->hasRole('admin')){{Auth::user()->websiteBalance()}}@else{{Auth::user()->balance}}@endif</strong>
                @else
                <a class="nav-link" href="/login"><strong>دخول</strong></a>
                @endif
            </div>
           
            <a class="navbar-brand text-center col-2 order-sm-2 order-xs-2 " id="testg" href="/home"><span class="">غزة نت</span></a>

            <div class="collapse navbar-collapse col-5 order-xs-4 order-sm-4" id="navbarNav">
                <ul class="navbar-nav p-0 mr-auto">
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="/home/createcategory"> فئة جديدة <span class="sr-only">(current)</span></a>
                </li> -->
                @if(Auth::check())
                @if(Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    الفئات
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/home/categories">عرض الفئات</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/home/createcategory">إضافة فئة</a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    التفعيلات
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/home/serials">عرض التفعيلات</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/home/createserials">إضافة تفعيلات</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/home/users" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">الموزعين</a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/home/users">عرض الموزعين</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/register">إضافة موزع</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/home/report:date">تقارير</a>
                </li>
                @endif
                @if(Auth::user()->hasRole('user'))
                <li class="nav-item">
                    <a class="nav-link"  href="/home/report:date">عملياتي</a>
                </li>
                @endif
                @endif
                </ul>
            </div>
  
        </nav>
    </div> 
    
    <!-- end navbar -->

    <!-- start carousel -->
   <!--  <section class="myadv text-center">
        <div id="myslide" class="carousel slide " data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h1> الانترنت الأسرع</h1>
                    <p class="lead">this is test paragraph in my new carouselthis is test paragraph in my new carouselthis is test paragraph in my new carousel</p>
                </div>
                <div class="carousel-item ">
                    <h1>خدمة متواصلة</h1>
                    <p class="lead">this is test paragraph in my new carouselthis is test paragraph in my new carouselthis is test paragraph in my new carousel</p>
                </div>
                <div class="carousel-item ">
                    <h1>تحميل لا محدود</h1>
                    <p class="lead">this is test paragraph in my new carouselthis is test paragraph in my new carouselthis is test paragraph in my new carousel</p>
                </div>
            
                
            </div>
        </div>
    </section> -->
    <!-- end carousel -->

    <!-- start content section -->
    <section class="toppad">
    </section>
    @yield('content')
        
    <!-- end content section -->

    <!-- start footer section -->
    
    
        
    <!-- end footer section -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="/js/myjs.js"></script>
    <script src="/js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="/js/jquery.nicescroll.min.js"></script>
   
    
</body>
</html>

