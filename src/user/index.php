<?php include('../head.php'); ?>

<title>Welcome to our website</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link href="../../assets/css/hamburgers.css" rel="stylesheet">
<link rel="stylesheet" href="./css/index.css">
<head>
   <body>
      <div id="app">
      
         <div class='overlay' v-if='overlay'></div>
         <div class='preloader' v-if='preloader'>
            <img src="../../imgur/svg/loading-spin.svg">
         </div>

         <?php include('./views/Sidebar.php') ?>
         <?php include('./views/Header.php') ?>

         <div class="container">

            <?php include('./views/Dashboard.php')?>
            <?php include('./views/Profile.php')?>

         </div>

         <?php include('./views/QuickViewPopUp.php') ?>

      </div>
   <!-- Vue script and index js-->
   <script src='../js/axios.js'></script>
   <script src='../js/uuid.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/index.js'></script>
   </body>
</html>