<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('style')
</head>

<body>
    <nav class="mt-5">
        <div class="container d-block">
            
            <a class="ms-4" href="/">
                <img src="{{asset('images/logo/kop_warna.png')}}" class="img-fluid" alt="Responsive image">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-3">
            <div class="card-header">  
                <div class="row">
                    <div class="col-md-12"><h4 class="text-center text-bold">@yield('title')</h4></div>                  
                </div>
            </div>
            <hr>
            <div class="card-body">
                @yield('isi')
            </div>
        </div>
    </div>
    @yield('modal')

</body>
@yield('script')
</html>