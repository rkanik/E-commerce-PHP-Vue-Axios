<?php include('../head.php'); ?>
<title>Welcome to our website</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link href="../../assets/css/hamburgers.css" rel="stylesheet">
<link rel="stylesheet" href="./css/index.css">

<head>
<body>
   <div id='Admin'>

      <div class='overlay' v-if='overlay'></div>
   
      <?php include('./views/Sidebar.php'); ?>

      <?php include('./views/Header.php'); ?>

      <div class="container">
         
         <?php include('./views/Dashboard.php'); ?>
         <?php include('./views/ReviewPost.php'); ?>
         <?php include('./views/Category.php'); ?>
         <?php include('./views/Covers.php'); ?>
         <div class="Users" v-if='comp_users'>
            <h1>Users</h1>
         </div>

         <?php include('./views/Sellers.php'); ?>
         
         
      </div>

      <?php include('./views/QueuedDetails.php'); ?>
      
   </div>
   <script src='../js/uuid.js'></script>
   <script src='../js/axios.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/index.js'></script>
</body>
</html>