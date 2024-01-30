<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PIS') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css')}}">
        <style>
            .card-welcome{
                background: #dbdada;
                /* box-shadow: 2px 2px 8px rgba(0,0,0,0.2); */
            }
            img{
                width: 100%;
            }
            .logo{
                width: 50px
            }
        </style>

        
    </head>
    <body >
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand font-weight-bold mr-5" href="/">PIS <span class="mx-2"><i class=" nav-icon far fa-calendar-alt"></i></span> <span class="text-warning font-weight-normal">AKADEMIK</span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Beranda</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Percarian data
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('find.santri')}}">Find Santri</a>
                                    <a class="dropdown-item" href="#">Action 2</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Akademik
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action 1</a>
                                    <a class="dropdown-item" href="#">Action 2</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Pengaduan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </header>

        <div class="container">
            <section id="logo area" class="mt-4 d-flex justify-content-start align-items-center">
                <img src="{{asset('images/favicon.ico')}}" class="logo" alt="logo" class="mr-2">
                <div>
                    <p class="text-warning m-0">Informasi Akademik</p>
                    <h2 class="font-weight-bold m-0">PESANTREN <span class="font-weight-normal">IMAM SYAFI'I</span></h2>
                </div>
    
            </section>

            
            {{$slot}}
        
        </div>

        
            


        <!-- jQuery -->
        <script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('lte/dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{asset('lte/dist/js/demo.js')}}"></script> --}}
    </body>
</html>
