<html>

<head>
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
    
    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>

        @font-face { font-family: "Aver";  src: url('/fonts/aver/Aver.eot?') format('eot'), url('/fonts/aver/Aver.woff') format('woff'), url('/fonts/aver/Aver.ttf') format('truetype');}
        
        body{
            font-family: 'Aver';
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #26422e;
            color: white;
            text-align: center;
            padding: 0.5em 0;
        }

        .fulljustify {
            text-align: justify;
        }
        .fulljustify:after {
        content: "";
        display: inline-block;
        width: 100%;
        }

        .fPrincipal{
            background-color: #26422e;
        }

    </style>

</head>

<body>
    
    <nav class="navbar" style="background-color: #26422e; width:100%;">
        <img src="{{secure_asset('img/logoCompletoDorado.png')}}" alt="" class="navbar-brand" style="max-height:70px; ">
    </nav>
          
   
    <div class="container mb-4 pb-2">
        @yield('content')
    </div>
    <div class="text-center footer mt-4">

        <h6>&copy; Contrastes 2020</h4>
      
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @yield('js')
</body>


</html>