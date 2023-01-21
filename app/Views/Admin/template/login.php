<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $this->renderSection("page-title") ?></title>

  <!-- Custom fonts for this template-->
  <?=link_tag('public/assets/admin/vendor/fontawesome-free/css/all.min.css')?>  


  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <?=link_tag('public/assets/admin/css/sb-admin-2.css')?>  



</head>

<body class="jumbotron vertical-center bg-gradient-primary">

<?= $this->renderSection("content") ?>



  <!-- Bootstrap core JavaScript-->
  <?=script_tag('public/assets/admin/vendor/jquery/jquery.min.js')?>  
  <?=script_tag('public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>  

  <!-- Core plugin JavaScript-->
  <?=script_tag('public/assets/admin/vendor/jquery-easing/jquery.easing.min.js')?>  

  <!-- Custom scripts for all pages-->
  <?=script_tag('public/assets/admin/js/sb-admin-2.min.js')?>  

</body>

</html>