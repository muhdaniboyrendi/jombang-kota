<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>{{ $title }}</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="../assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="../assets/css/portal.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @livewireStyles
</head> 

<body class="app">   	
    
    <header class="app-header fixed-top">	   	       
        
        <x-topbar></x-topbar>
        
        <x-sidebar><x-slot:active>{{ $active }}</x-slot></x-sidebar>
        
    </header><!--//app-header-->
    
    <div class="app-wrapper">
        
        {{ $slot }}

        <x-footer></x-footer>
            
    </div><!--//app-wrapper-->    					

    <x-logout></x-logout>

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>

    {{-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../assets/plugins/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="../assets/plugins/chart.js/chart.min.js"></script> 
    <script src="../assets/js/index-charts.js"></script> 

    <!-- Page Specific JS -->
    <script src="../assets/js/app.js"></script> 

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/2898c758a1.js" crossorigin="anonymous"></script>

    {{-- clopboard --}}
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>

    {{-- my script --}}
    <script src="js/script.js"></script>
    

</body>
</html> 