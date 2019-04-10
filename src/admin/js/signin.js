var signin = new Vue({
   el:'#signin',
   data:{
      // Booleans
      SignedIn:false,err:false,

      //Empty Strings/Object
      userName:'',   password:'',   message:'',
      sellers:[],
   },
   created(){
      axios.get('./inc/signin.inc.php?action=CheckStatus')
      .then( res => {
         if( res.data.err && res.data.mess === 'SignedOut' ){
            this.SignedIn = false;
         }else if(res.data.mess === 'Signedin'){
            window.location.replace('./index.php');
         }
      })
   },
   methods:{
      loginAdmin:function(){
         console.log('loginAdmin');
         var userData = this.toFormData({userName:this.userName,password:this.password});
         axios.post('./inc/signin.inc.php?action=SigninAdmin',userData)
         .then( response => {
            console.log(response);
            if(response.data.err){this.err = true ;this.SignedIn = false ;this.message = response.data.mess;
            }else if( response.data.mess === 'SignedIn'){
               window.location.replace('./index.php');
            }
         })
      },
      toFormData: function(obj){
         var form_data = new FormData();for ( var key in obj ){form_data.append(key, obj[key]);}return form_data;
      }
   }
})