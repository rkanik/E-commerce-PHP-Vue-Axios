const signin = new Vue({
   el:'#signin',
   data:{
      email:'',password:'',type:'password',

      em_err:false,   pass_err:false, sh_ps:false,
      isLoading:false,

      em_msg:'Enter your email address',
      ps_msg:'Enter your password',

      eye_src:'https://img.icons8.com/ios-glyphs/30/000000/invisible.png'
   },
   created(){
      console.log('Created');
      axios.get('./inc/signin.inc.php?action=checkStatus')
      .then( res => {
         if(res.data.mess === 'Signedin'){
            window.location.replace('./index.php');
         }
      });
   },
   methods:{
   toFormData: function(obj){
      var form_data = new FormData();
         for ( var key in obj ) {
               form_data.append(key, obj[key]);
         }
      return form_data;
   },
   showPass(){
      //console.log('showPass');
      this.sh_ps = !this.sh_ps ;
      if(this.sh_ps){
            this.eye_src = 'https://img.icons8.com/ios-glyphs/30/000000/visible.png'
      }else{this.eye_src = 'https://img.icons8.com/ios-glyphs/30/000000/invisible.png'}
   },
   SigninUser(){
      this.isLoading = true;
      this.email === '' ? this.em_err = true : this.em_err = false ;
      this.password === '' ? this.pass_err = true : this.pass_err = false ;
      if( this.em_err || this.pass_err ){this.isLoading = false;}
      else{
         let data = {em_or_un:this.email,password:this.password};
         axios.post('./inc/signin.inc.php?action=signin',this.toFormData(data))
         .then( res => {
            if(res.data === 'wrongPass'){
               this.pass_err = true ;
               this.ps_msg = 'Wrong password!';
            }else if(res.data === 'userNotFound'){
               this.em_err = true ;
               this.em_msg = 'Wrong username or email address!';
            }else if( res.data ==='SignedIn'){
               window.location.replace('./')
            }
            this.isLoading = false;
         })
      }
   }}
})