<?php include('../head.php'); ?>
<title>Admin Panel | Signin</title>
<link rel="stylesheet" href="../../assets/css/admin.css">
<head>
 <body>
    <div id="signin">
        <div class="signin" v-if='!SignedIn' >
            <h3>Enter your admin username & password</h3>
            <input type="text" v-model='userName' placeholder='Enter username'><br>
            <input type="password" v-model='password' placeholder='Enter password'><br>
            <button @click='loginAdmin'>LOGIN</button>
            <p v-bind:class="{'err':err}">{{message}}</p>
        </div>
    </div>
    <script src="../js/axios.js"></script>
    <script src='../js/vue.min.js'></script>
    <script src='../js/uuid.js'></script>
    <script src='./js/signin.js'></script>
</body>
</html>