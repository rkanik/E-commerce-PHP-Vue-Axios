<?php include('../head.php'); ?>
<title>Welcome to our website</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link href="../../assets/css/hamburgers.css" rel="stylesheet">
<link rel="stylesheet" href="./css/index.css">

<head>
<body>
   <div id='seller'>
      <div class='overlay' v-if='overlay'></div>
      <?php include('./views/Sidebar.php') ?>
      <?php include('./views/Header.php') ?>

      <div class="container">

         <div class="dashboard" v-if='viewDashboard'>
            <?php include('./views/Overview.php') ?>
            
            <div class="re_a_que">
               <?php include('./views/RecentPosts.php') ?>
               <?php include('./views/QueuePostsDash.php') ?>
            </div>
         </div>

         <?php include('./views/Postad.php') ?>
         <?php include('./views/QueuedPosts.php') ?>

      </div>

         <!-- POP UP / MODAL -->
         <div class="pa_upload">
            <div class="col-md">
               <div class="dropzone"></div>
            </div>
            <button class='upFinish' @click='paImageUploadFinish'>FINISH</button>
            <div id="pa_images">
            </div>
         </div>
         <!-- POP UP / MODAL -->
   </div>

   <script src="../../imgur/imgur.min.js"></script>
   <script src='../js/axios.js'></script>
   <script src='../js/uuid.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/index.js'></script>
</body>
</html>