
var app = new Vue({
   el:'#register',
   data:{
      // Empty VARS
      shopName:'',      firstName:'',     lastName:'',
      email   :'',      password :'',     cPass   :'',
      phoneNumber:'',   district:"",      zip:'',
      address:'',

      user:{
         shopName:'',firstName:'',lastName:'',
         email:'',password:'',phone:'',
         district:'',zip:'',address:''
      },

      // Booleans
      sp_err:false,     fn_err  :false,      ln_err   :false,
      em_err :false,    pass_err:false,      cPass_err:false,
      to_er  :false,    showLoading:false,   stage_one:true,
      stage_two:false,   ph_err:false,        ds_err:false,
      zp_err:false,     adr_err:false,

      // Strings
      sp_msg  :'Physical or online shop name',
      em_msg  :'Enter Email Address',
      ps_note :'Use 6 or more characters with a mix of letters, numbers & symbols',
      cPs_msg :"Use 6 or more characters with a mix of letters, numbers & symbols"
   },
   created(){
      
   },
   methods:{
      toFormData:function(obj){
         var form_data = new FormData();
            for ( var key in obj ) {
                form_data.append(key, obj[key]);
            }
         return form_data;
      },
      registerUser:function(){
         this.showLoading=true;if(this.shopName===''){this.sp_err=true;this.sp_msg='Enter Shopname';this.to_er=true;this.showLoading=false;}else{this.sp_err=false;this.sp_msg='Physical or online shopname';this.to_er=false;}if(this.firstName===''){this.fn_err=true;this.to_er=true;this.showLoading=false;}else{this.fn_err=false;this.to_er=false;}if(this.lastName===''){this.ln_err=true;this.to_er=true;this.showLoading=false;}else{this.ln_err=false;this.to_er=false;}if(this.email===''){this.em_err=true;this.to_er=true;this.em_msg='Enter Email Address';this.showLoading=false;}else{this.em_err=false;this.to_er=false;}if(this.password===''){this.pass_err=true;this.ps_note='Enter Password';this.to_er=true;this.showLoading=false;}else{this.pass_err=false;this.to_er=false;this.ps_note='Use 8 or more characters with a mix of letters,numbers & symbols';}if(this.cPass===''){this.cPass_err=true;this.to_er=true;this.cPs_msg="Confirm Password";this.showLoading=false;return;}else{this.cPass_err=false;this.to_er=false;this.cPs_msg='Use 8 or more characters with a mix of letters, numbers & symbols';}if(this.password!==this.cPass){this.cPass_err=true;this.cPs_msg="Password doesn't matches";this.to_er=true;this.showLoading=false;}else{this.to_er=false;this.cPass_err=false;}         
         
         axios.post('./inc/register.inc.php?action=checkEmail',this.toFormData({email:this.email}))
         .then( res => {
            if( res.data === 'Exists'){
               this.em_err = true;this.to_er = true ;
               this.em_msg = 'Email already in use!';
               this.showLoading=false;
            }else if(res.data === 'continue' ){
               this.to_er=false;this,this.showLoading=false;
               console.log('No error / going to stage 2');
               this.showLoading = false ; this.stage_one = false ; this.stage_two = true ;
            }
         });
      },
      ResetForm:function(){
         this.showLoading=false;this.stage_one=true;this.stage_two=false;this.shopName='';this.firstName='';this.lastName='';this.email='';this.password='';this.cPass='';this.phoneNumber='';this.district='';this.zip='';this.address='';
      },
      CompleteReg:function(){
         console.log('Stage two');
         this.showLoading=false;
         //this.stage_one = false ; this.stage_two = true ;
         if(this.phoneNumber===''){this.ph_err=true;this.to_er=true;}else{this.ph_err=false;this.to_er=false;}if(this.district===''){this.ds_err=true;this.to_er=true;}else{this.ds_err=false;this.to_er=false;}if(this.zip===''){this.zp_err=true;this.to_er=true;}else{this.zp_err=false;this.to_er=false;}if(this.address===''){this.adr_err=true;this.to_er=true;}else{this.adr_err=false;this.to_er=false;}

         if( !this.to_er ){
            let data = {
               id:uuid.v4(),shopName:this.shopName,firstName:this.firstName,lastName:this.lastName,
               email:this.email,password:this.password,phone:this.phoneNumber,
               district:this.district,zip:Number(this.zip),address:this.address
            }
            axios.post('./inc/register.inc.php?action=comReg', this.toFormData(data) )
            .then(function (res) {
               if( res.data === 'Registered'){
                  this.showLoading=false;this.stage_one=true;this.stage_two=false;this.shopName='';this.firstName='';this.lastName='';this.email='';this.password='';this.cPass='';this.phoneNumber='';this.district='';this.zip='';this.address='';
                  window.location.replace('./');
               }else if(res.data.errorInfo){
                  this.em_err = true;this.to_er = true ;
                  this.em_msg = 'Email already in use!';
                  this.showLoading=false;this.stage_one=true;
                  this.stage_two = false ;
               }
            })
            //window.location.replace('../inc/register_seller.inc.php');
            console.log('complete bottom');
         }
      },
      backToStageOne:function(){
         this.showLoading=false;this.stage_one=true;this.stage_two=false;
      }
   }
})