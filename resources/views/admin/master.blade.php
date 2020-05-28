<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4d23064df5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('/static/js/admin.js') }}"></script>



    <title>@yield('title') - Mars</title>

    <script>  
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="col1">@include('admin.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link">
                                <i class="fas fa-home"></i>Dashboard
                            </a>
                        </li>
                        
                    </ul>
                </div>            
            </nav>
            <div class="page">
                <div class="container-fluid">
                    <nav arial-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin') }}">
                                    <i class="fas fa-home"></i>Dashboard
                                </a>
                            </li>
                            @section('breadcrumb')
                            @show
                        </ol>
                    </nav>
                </div>

                @if(Session::has('message'))
                    <div class="container-fluid">
                        <div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:
                            block; margin-bottom 16px;">
                            {{ Session::get('message') }}
                            @if ($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <script>   
                                $('.alert').slideDown();
                                setTimeout(function(){ $('.alert').slideUp(); }, 10000);
                            </script>
                        </div>
                    </div>
                @endif

                @section('content')
                @show


            </div>
        </>
    </div>


    
</body>
</html>