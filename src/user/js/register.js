const register = new Vue({
   el: '.register',
   data: {
      // Empty VARS
      userName: '',
      firstName: '',
      lastName: '',
      email: '',
      password: '',
      cPass: '',
      ranUserName: [],

      // Booleans
      usr_err: false,
      fn_err: false,
      ln_err: false,
      em_err: false,
      pass_err: false,
      cPass_err: false,
      to_er: false,
      showLoading: false,
      userSug: false,

      // Strings
      us_msg: 'User name have to be unique',
      em_msg: 'Enter Email Address',
      ps_note: 'Use 6 or more characters with a mix of letters, numbers & symbols',
      cPs_msg: "Use 6 or more characters with a mix of letters, numbers &"
   },
   created() {
      axios.get('./inc/register.inc.php?action=checkStatus')
         .then(res => {
            if (res.data.mess === 'Signedin') {
               console.log('here');
               window.location.replace('./index.php');
            }
         });
   },
   methods: {
      toFormData: function (obj) {
         var form_data = new FormData();
         for (var key in obj) {
            form_data.append(key, obj[key]);
         }
         return form_data;
      },
      setSuggestedUserName(event) {
         console.log(event);
         this.userName = event.target.innerText;
         this.usr_err = false;
         this.us_msg = 'User name have to be unique';
      },
      registerUser() {
         this.showLoading = true;
         if (this.userName === '') {
            this.usr_err = true;
            this.us_msg = 'Enter Username';
            this.to_er = true;
            this.showLoading = false;
         } else {
            this.usr_err = false;
            this.us_msg = 'User name have to be unique';
            this.to_er = false;
         }
         if (this.firstName === '') {
            this.fn_err = true;
            this.to_er = true;
            this.showLoading = false;
         } else {
            this.fn_err = false;
            this.to_er = false;
         }
         if (this.lastName === '') {
            this.ln_err = true;
            this.to_er = true;
            this.showLoading = false;
         } else {
            this.ln_err = false;
            this.to_er = false;
         }
         if (this.email === '') {
            this.em_err = true;
            this.to_er = true;
            this.em_msg = 'Enter Email Address';
            this.showLoading = false;
         } else {
            this.em_err = false;
            this.to_er = false;
         }
         if (this.password === '') {
            this.pass_err = true;
            this.ps_note = 'Enter Password';
            this.to_er = true;
            this.showLoading = false;
         } else {
            this.pass_err = false;
            this.to_er = false;
            this.ps_note = 'Use 8 or more characters with a mix of letters,numbers & symbols';
         }
         if (this.cPass === '') {
            this.cPass_err = true;
            this.to_er = true;
            this.cPs_msg = "Confirm Password";
            this.showLoading = false;
            return;
         } else {
            this.cPass_err = false;
            this.to_er = false;
            this.cPs_msg = 'Use 8 or more characters with a mix of letters,numbers & symbols';
         }
         if (this.password !== this.cPass) {
            this.cPass_err = true;
            this.cPs_msg = "Password doesn't matches";
            this.to_er = true;
            this.showLoading = false;
         } else {
            this.to_er = false;
            this.cPass_err = false;
         };

         if (this.to_er === false) {
            let data = {
               id: uuid.v4(),
               userName: this.userName,
               firstName: this.firstName,
               lastName: this.lastName,
               email: this.email,
               password: this.password
            };
            console.log(data);
            axios.post('./inc/register.inc.php?action=register', this.toFormData(data))
               .then(dataSnapshot => {
                  console.log(dataSnapshot);
                  if (dataSnapshot.data === "dun") {
                     this.usr_err = true;
                     this.us_msg = 'User name has already been taken';
                     this.showLoading = false;
                  } else if (dataSnapshot.data === 'dem') {
                     this.em_err = true;
                     this.em_msg = 'Email already in use';
                     this.showLoading = false;
                  } else if (dataSnapshot.data === 'Registered') {
                     window.location.replace('./index.php');
                  }
               })
         }
      }
   }
});