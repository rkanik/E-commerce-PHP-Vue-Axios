var app = new Vue({
   el:'#register',
   data:{
      // Empty VARS
      firstName:'',   lastName:'',
      email   :'',    password :'',   cPass   :'',

      // Booleans
      fn_err  :false,   ln_err   :false,
      em_err :false,  pass_err:false,   cPass_err:false,
      to_er  :false,  showLoading:false,

      // Strings
      em_msg  :'Enter Email Address',
      ps_note :'Use 6 or more characters with a mix of letters, numbers & symbols',
      cPs_msg :"Use 6 or more characters with a mix of letters, numbers & symbols"
   },
   created(){
      console.log('Created');
   },
   methods:{
      // setSuggestedUserName(event){
      //     console.log(event);
      //     this.userName = event.target.innerText;
      //     this.usr_err = false;
      //     this.us_msg='User name have to be unique';
      // },
      registerUser: function(){
         this.showLoading = true;
         if(this.firstName === ''){
            this.fn_err = true;
            this.to_er = true;
            this.showLoading = false ;
         }else{
            this.fn_err = false;
            this.to_er = false;
         }
         if(this.lastName === ''){
            this.ln_err = true;
            this.to_er = true;
            this.showLoading = false ;
         }else{
            this.ln_err = false;
            this.to_er = false;
         }
         if(this.email === ''){
            this.em_err = true;
            this.to_er = true;
            this.em_msg = 'Enter Email Address';
            this.showLoading = false ;
         }else{
            this.em_err = false;
            this.to_er = false;
         }
         if(this.password === ''){
            this.pass_err = true;
            this.ps_note = 'Enter Password';
            this.to_er = true;
            this.showLoading = false ;
         }else{
            this.pass_err = false;
            this.to_er = false;
            this.ps_note = 'Use 8 or more characters with a mix of letters, numbers & symbols';
         }
         if(this.cPass === ''){
            this.cPass_err = true;
            this.to_er = true;
            this.cPs_msg = "Confirm Password"
            this.showLoading = false ;
            return;
         }else{
            this.cPass_err = false;
            this.to_er = false;
            this.cPs_msg = 'Use 8 or more characters with a mix of letters, numbers & symbols';
         }
         if( this.password !== this.cPass ){
            this.cPass_err = true;
            this.cPs_msg = "Password doesn't matches"
            this.to_er = true;
            this.showLoading = false ;
         }else{this.to_er = false;this.cPass_err = false;}

         if( this.to_er === false ){

         }
      }
   }
})