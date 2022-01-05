<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    SAS Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.2" rel="stylesheet" />
</head>
<body>

<?php
    if(isset($_GET['msg']) AND isset($_GET['status']) ){  
      if($_GET['status'] == 'true'){
      echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style=\"padding: 8px; padding-left: 30px; padding-right: 30px;border-radius: 50px 20px;opacity: 0.8;\" >";
      echo "<span class=\"alert-icon\"><i class=\"ni ni-like-2\"></i></span>";
      echo "<span class=\"alert-text\"><strong> ";
      echo $_GET['msg'];               
      echo "</strong> ";
      echo "</span>";
      echo " <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\" style =\" padding-top:0;\">";
      echo "</button>";
      echo "</div>";
    } else{
      echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\" style=\"padding: 8px; padding-left: 30px; padding-right: 30px;border-radius: 50px 20px;opacity: 0.8;\" >";
      echo "<span class=\"alert-icon\"><i class=\"ni ni-bell-55\"></i></span>";
      echo "<span class=\"alert-text\"><strong>";
      echo " </strong> ";
      echo $_GET['msg']; 
      echo "</span>";
      echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\" style =\" padding-top:0;\" >";
      echo "</button>";
      echo "</div>";
    }}
?>


</body>
</html>