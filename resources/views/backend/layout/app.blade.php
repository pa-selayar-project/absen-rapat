<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layout.header')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
           @include('backend.layout.sidebar')
        </div>
        <div id="main" class='layout-navbar'>
            @include('backend.layout.content')
        </div>
    </div>
    
    @include('backend.layout.footer')

</body>

</html>