<?php include('../head.php'); ?>

<title>Create Account | RK Shop</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="./css/register.css">
<head>
   <body>
   <div class="register">
        <div class="loading" v-if='showLoading'></div>
        <div class="bo-co-na"><h2>RK Shop</h2></div>
        <div class="bo-cr-ac"><h2>Create your RK Shop Account</h2></div>
        <div class="grid-wrapper">
            <div class="in-box in-box-us" v-bind:class="{'wh-er':usr_err}">
                <input type="text" v-model="userName" id="in-us" required>
                <label for="in-us" v-bind:class="{'red-text':usr_err}">User name</label>
                <p style="margin-bottom:0.2rem;" class="note" v-bind:class="{'err-show red-text':usr_err}">{{us_msg}}</p>
            </div>
            <div class="in-box in-box-suu" v-bind:class="{'hide':!userSug}">
                <p v-for="r in ranUserName" v-bind:key=r @click="setSuggestedUserName">{{r}}</p>
                <span>available</span>
            </div>
            <div class="in-box in-box-fn" v-bind:class="{'wh-er':fn_err}">
                <input type="text" v-model="firstName" id="in-fn" required>
                <label for="in-fn" v-bind:class="{'red-text':fn_err}">First name</label>
                <p class="red-text hide" v-bind:class="{'err-show':fn_err}">Enter First name</p>
            </div>
            <div class="in-box in-box-ln" v-bind:class="{'wh-er':ln_err}">
                <input type="text" v-model="lastName" id="in-ln" required>
                <label for="in-ln" v-bind:class="{'red-text':ln_err}">Last name</label>
                <p class="red-text hide" v-bind:class="{'err-show':ln_err}">Enter Last name</p>
            </div>
            <div class="in-box in-box-em" v-bind:class="{'wh-er':em_err}">
                <input type="text" v-model="email" id="in-em" required>
                <label for="in-em" v-bind:class="{'red-text':em_err}">Email address</label>
                <p class="sa-em">sample@sample.com</p>
                <p class="red-text hide" v-bind:class="{'err-show':em_err}">{{em_msg}}</p>
            </div>
            <div class="in-box in-box-pass" v-bind:class="{'wh-er':pass_err}">
                <input type="password" v-model="password" id="in-pass" required>
                <label for="in-pass" v-bind:class="{'red-text':pass_err}">Password</label>
                <p class="note" v-bind:class="{'err-show red-text':pass_err}">{{ps_note}}</p>
                <!-- <p class="red-text hide">Enter Password</p> -->
            </div>
            <div class="in-box in-box-cpass" v-bind:class="{'wh-er':cPass_err}">
                <input type="password" v-model="cPass" id="in-cPass" required>
                <label for="in-cPass" v-bind:class="{'red-text':cPass_err}">Confirm</label>
                <p class="note hide" v-bind:class="{'err-show red-text':cPass_err}">{{cPs_msg}}</p>
                <!-- <p class="red-text hide">Password doesn't matches</p> -->
            </div>
        </div>
        <div>
            <a class="sign-ins" href="./signin.php">or signin instead</a>
        </div>
        <div>
            <button @click="registerUser()" class="reg-btn">Register</button>
        </div>
    </div>

   <!-- Vue script and index js-->
   <script src='../js/axios.js'></script>
   <script src='../js/uuid.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/register.js'></script>
   </body>
</html>