<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $pageTitle; ?></title>

    <!-- Custom fonts for this template-->
    <?=link_tag('public/assets/admin/vendor/fontawesome-free/css/all.min.css')?>  
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <?=link_tag('public/assets/admin/css/sb-admin-2.css')?>  
    <!-- <?=link_tag('public/assets/admin/css/sb-admin-2.min.css')?>   -->     

      <!-- DATATABLES -->
      <?=script_tag('public/assets/admin/js/jquery.min.js')?>  
    <?=link_tag('public/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css')?>  
   
    <!--  Jquery-->
    <?=script_tag('public/assets/admin/vendor/jquery/jquery.min.js')?>  
    <?=link_tag('public/assets/admin/css/style.css')?>  
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

    <?=script_tag('public/assets/admin/js/jquery-3.2.1.min.js')?>      
    <?=script_tag('public/assets/admin/js/jquery-ui.js')?>  

    <!-- Toastr -->
    <?= script_tag('public/assets/admin/vendor/toastr/toastr.min.js') ?>

</head>

<body  onafterprint="myFunction()">


    <?= $this->renderSection("content") ?>


    <!-- Bootstrap core JavaScript-->
    <?=script_tag('public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>  
    
    <!-- Core plugin JavaScript-->
    <?=script_tag('public/assets/admin/vendor/jquery-easing/jquery.easing.min.js')?>  
    
    <!-- Custom scripts for all pages-->
    <?=script_tag('public/assets/admin/js/sb-admin-2.min.js')?>  
      
   
    <!-- Page level plugins -->
    <?=script_tag('public/assets/admin/vendor/datatables/jquery.dataTables.min.js')?>  
    <?=script_tag('public/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')?>  
    
    <!-- Page level custom scripts -->
    <?=script_tag('public/assets/admin/js/demo/datatables-demo.js')?>        


    <?= script_tag('public/assets/frontend/js/myscript.js') ?>

<script type="text/javascript"> 
  window.addEventListener("load", window.print());

  function myFunction() {
        window.close();
  }


</script>

</body>
</html>
