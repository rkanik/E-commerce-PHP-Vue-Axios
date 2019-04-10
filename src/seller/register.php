<?php include('../head.php');?>

<title>Complete your registration</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="../../assets/css/register.css">
<head>
<body>
   <div id="register">
      <div class="loading" v-if='showLoading'></div>
      <div class="bo-co-na"><h2>RK Shop</h2></div>
      <div class="bo-cr-ac"><h2>Create your RK Shop Account</h2></div>
      <div class="grid-wrapper" v-if='stage_one'>
         <div class="in-box in-box-sp" v-bind:class="{'wh-er':sp_err}">
            <input type="text" v-model="shopName" id="in-sp" required>
            <label for="in-sp" v-bind:class="{'red-text':sp_err}">Shop name</label>
            <p style="margin-bottom:0.2rem;" class="note" v-bind:class="{'err-show red-text':sp_err}">{{sp_msg}}</p>
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

      <div v-if='stage_two'>
         <div class="in-box in-box-ph" v-bind:class="{'wh-er':ph_err}">
            <input type="text" v-model="phoneNumber" id="in-ph" required>
            <label for="in-ph" v-bind:class="{'red-text':ph_err}">Phone Number</label>
            <p class="red-text hide" v-bind:class="{'err-show':ph_err}">Enter phone number</p>
         </div>
         <div class="in-box in-box-ds" v-bind:class="{'wh-er':ds_err}">
            <input type="text" v-model="district" id="in-ds" required>
            <label for="in-ds" v-bind:class="{'red-text':ds_err}">District</label>
            <p class="red-text hide" v-bind:class="{'err-show':ds_err}">Enter district</p>
         </div>
         <div class="in-box in-box-zp" v-bind:class="{'wh-er':zp_err}">
            <input type="number" v-model="zip" id="in-zp" required>
            <label for="in-zp" v-bind:class="{'red-text':zp_err}">Zip code</label>
            <p class="red-text hide" v-bind:class="{'err-show':zp_err}">Enter zip code</p>
         </div>
         <div class="in-box in-box-adr" v-bind:class="{'wh-er':adr_err}">
            <p class='note'>Enter address</p>
            <textarea rows="4" cols="66" v-model="address">
               Enter address
            </textarea>
            <p class="red-text hide" v-bind:class="{'err-show':adr_err}">Enter shop address</p>
         </div>
         
      </div>
      
      <div>
         <a class="sign-ins" href="./signin.php">or signin instead</a>
      </div>
      
      <div>
         <button @click="registerUser" class="reg-btn" v-if='stage_one'>Next</button>
      </div>
      <div>
         <button @click="CompleteReg" class="reg-btn" v-if='stage_two'>Finish</button>
      </div>
      <div>
         <button style='margin-right:1rem' @click="backToStageOne" class="reg-btn back" v-if='stage_two'>Back</button>
      </div>
      
   </div>
<!-- Vue script and index js-->
<script src='../js/axios.js'></script>
   <script src='../js/uuid.js'></script>
   <script src='../js/vue.min.js'></script>
   <script src='./js/register.js'></script>
</body>
</html>