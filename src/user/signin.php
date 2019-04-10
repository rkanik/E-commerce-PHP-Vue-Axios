<?php include('../head.php'); ?>

<title>Signin | RK Shop</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="./css/signin.css">
<head>
   <body>

   <div id="signin">
        <div class="loading" v-if="isLoading"></div>
        <div class="bo-co-na"><h2>RK Shop</h2></div>
        <div class="bo-cr-ac"><h2><span class="si-in">Signin</span>
        <br>with your username/email & password</h2></div>
        <div class="in-box in-box-em" v-bind:class="{'wh-er':em_err}">
            <input type="text" v-model="email" id="in-em" required>
            <label for="in-em" v-bind:class="{'red-text':em_err}">Username/Email address</label>
            <p style="margin-bottom:0.2rem;" class="note hide" v-bind:class="{'err-show red-text':em_err}">{{em_msg}}</p>
        </div>
        <div class="in-box in-box-pass" v-bind:class="{'wh-er':pass_err}">
            <input :type="sh_ps?'text':'password'" v-model="password" id="in-pass" required>
            <label for="in-pass" v-bind:class="{'red-text':pass_err}">Password</label>
            <p class="red-text hide" v-bind:class="{'err-show':pass_err}">{{ps_msg}}</p>
            <span @click="showPass()" class="ps-eye"><img :src=eye_src class="eye-img"></span>
        </div>
        <div class="fo-pa">
            <p>Forgot password?</p>
        </div>
        <div>
            <a class="reg-ins" href='./register.php'>Create account</a>
        </div>
        <div>
            <button @click="SigninUser()" class="sin-btn">Signin</button>
        </div>
    </div>

   <!-- Vue script and index js-->
   <script src='../js/axios.js'></script>
   <script src='../js/uuid.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/signin.js'></script>
   </body>
</html>