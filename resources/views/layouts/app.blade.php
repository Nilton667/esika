<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Gestão de documentos a melhor opção para a sua empresa">
  <meta name="keyword" content="Gestão de documentos, documents, gestão, gestao">
  <link rel="icon" href="https://www.esika.ao/public/img/logo-icon.png" type="image/x-icon"> <!-- Favicon-->
  <title>Gestão de documentos</title>
  <!-- Application vendor css url -->
  <link rel="stylesheet" href="https://www.esika.ao/public/cssbundle/daterangepicker.min.css">
  
  <!-- project css file  -->
  <link rel="stylesheet" href="https://www.esika.ao/public/css/luno-style.css">

   <!-- Jquery Core Js -->
   <script src="https://www.esika.ao/public/js/plugins.js"></script>

     <script src="https://use.fontawesome.com/7491f2ea8f.js"></script>
</head>

<body class="layout-1" data-luno="theme-blush">
  <!-- sidebar -->
@include('inc.sidebar')
    <!-- start: body area -->
    <div class="wrapper">
    <!-- start: page header -->
    @include('inc.navbar')
    
    @yield('content')
 
    <!-- start: page footer -->
    @include('inc.footer')    
   
  <!-- Jquery Page Js -->
  <!-- Jquery Page Js -->
  <script src="https://www.esika.ao/public/js/theme.js"></script>
 
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
  @include('inc.messages')
</body>
</html>