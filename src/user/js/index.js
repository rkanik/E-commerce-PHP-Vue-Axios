var app = new Vue({
   el: '#app',
   data: {
      profileDef: '../../assets/images/profile_pic.svg',

      // Booleans //
      menu_toggle: false,
      menAopen: false,
      womAopen: false,
      preloader: true,
      pro_popup_sh: true,
      isLoggedIn: false,
      overlay: false,
      qvPopUp: false,
      comp: {
         pro: true,
         dash: false
      },
      isSpinning: false,
      edit_pro: false,


      // Arrays / Objects
      Categories: [],
      coverSrc: [],
      popular_Post: [],
      ssSrc: '',
      RecentPosts: [],
      qvPost: {},
      profileData: {},
      updateData: {},

      //Src
      slideShow: ['https://ethos-cdn1.ethoswatches.com/the-watch-guide/wp-content/uploads/2018/05/Top-five-Graham-watches-men-British-Swiss-watchmaking-chronograph-racing-vintage-mast.jpg',
         'https://hodinkee.imgix.net/uploads/images/1528929379845-9tmxeeamk4u-37a0fbf2500e7115606857ae7c09629b/Leica-10.jpg?ixlib=rails-1.1.0&fit=crop&ch=Width%2CDPR%2CSave-Data&alt=&fm=jpg&q=55&auto=format&usm=12&s=9e7766479e30019757ff25493274bcc8',
         'https://cdn.shopify.com/s/files/1/0855/7318/products/DSC_0211_1024x1024.JPG?v=1549460519'
      ],

   },
   created() {
      console.log('created user');
      axios.get('./inc/index.inc.php?action=getCats')
         .then(res => {
            if (!res.data.err) {
               //console.log(res.data);
               this.Categories = res.data.cats;
               this.preloader = false;
            }
         });
      this.initProfile();
      axios.get('./inc/index.inc.php?action=getItems')
         .then(res => {
            if (res.data !== 'No Post Found!') {
               this.RecentPosts = res.data;
            }
         });

      this.ssSrc = this.slideShow[0];
      let i = 0;
      let even = true;
      setInterval(() => {
         if (i === this.slideShow.length - 1) {
            i = 0
         } else {
            i++
         }
         this.ssSrc = this.slideShow[i];
         let img;
         if (this.comp.dash) {
            img = document.querySelector('.slideshow img');
         }
         if (even) {
            even = false;
            if (this.comp.dash) {
               img.style.width = '105%';
            }
         } else {
            even = true;
            if (this.comp.dash) {
               img.style.width = '100%';
            }
         }
      }, 5000);
   },
   mounted() {
      console.log('mounted');
   },
   methods: {
      initProfile: function () {
         axios.get('./inc/index.inc.php?action=initiateProfile')
            .then(res => {
               if (res.data === 'SignedOut') {
                  window.location.replace('./signin.php');
               } else {
                  this.profileData = res.data;
                  this.profileThumbnail = this.profileData.src;
                  this.profileData.date_of_birth = new Date(this.profileData.date_of_birth).toDateString();
               }
            });
      },
      showProfileEditor() {
         this.edit_pro = true;
         this.updateData = JSON.parse(JSON.stringify(this.profileData));
      },
      toFormData: function (obj) {
         var form_data = new FormData();
         for (var key in obj) {
            form_data.append(key, obj[key]);
         }
         return form_data;
      },
      updateProfile: function () {
         //console.log(this.updateData);
         this.updateData.updated_at = new Date();
         axios.post('./inc/index.inc.php?action=updateProfile', this.toFormData(this.updateData))
            .then(res => {
               if (res.data === 'SUC') {
                  this.initProfile();
                  this.edit_pro = false;
               }
            })
      },
      onClickProfileNavA: function (event) {
         if (!this.edit_pro) {
            let li = document.querySelectorAll('.left ul li');
            li.forEach(l => {
               if (l.classList.contains('active')) {
                  l.classList.remove('active')
               }
            });
            event.target.parentElement.classList.add('active');
         }
      },
      updateProfileImage: function () {

      },
      uploadCover: function () {

      },
      resetComp: function () {
         Object.keys(this.comp).forEach(key => {
            this.comp[key] = false
         })
      },
      onClickSideBarHome: function () {
         this.resetComp();
         this.comp.dash = true;
      },
      onClickProfileCog: function () {
         this.resetComp();
         this.comp.pro = true;
         //console.log(this.comp.pro);
      },
      qvSetSelectedImage: function (event) {
         this.qvImgCon = event.target.src;
         let a = document.querySelectorAll('.qvsinimage');
         a.forEach(b => {
            b.style.borderColor = 'rgb(214, 214, 214)';
         })
         event.target.style.borderColor = '#0097a7';
      },
      closeQVPopup: function () {
         this.overlay = false;
         this.qvPopUp = false;
         this.qvPost = {};
         this.qvImgCon = '';
      },
      onClickPostQuickView: function (id) {
         let post = this.RecentPosts.filter(p => p._id === id);
         this.qvPost = post[0];
         this.qvImgCon = this.qvPost.src[0];
         this.overlay = true;
         this.qvPopUp = true;
         console.log(this.qvPost);
      },
      showQuickViewBtn: function (event) {
         event.target.lastChild.style.bottom = '0';
      },
      hideQuickViewBtn: function (event) {
         event.target.lastChild.style.bottom = '-2.5rem';
      },
      SignOut: function () {
         axios.get('./inc/index.inc.php?action=signout')
            .then(res => {
               if (res.data = 'SignedOut') {
                  window.location.replace('./signin.php');
               }
            });
      },
      onClickMenuToggle: function (event) {
         //console.log('onClickMenuToggle');
         let sidebar = document.getElementById('sidebar');
         var sd_pr_bx = document.querySelector('.sd_pr_bx');
         var categories = document.querySelector('.categories');
         let cat_ti = document.querySelectorAll('.categories span');
         let li = document.querySelectorAll('.categories li');
         //console.log(categories);
         if (!this.menu_toggle) {
            this.menu_toggle = true;
            sidebar.style.cssText = 'width:3.5rem;overflow:hidden';
            sd_pr_bx.style.cssText = 'top:-16rem;left:-14rem;';
            categories.style.top = '4rem';
            cat_ti.forEach(c => {
               c.style.display = 'none';
            });
            li.forEach(l => l.style.cssText = 'padding:0.7rem 0.35rem;scale:1.1;');
            document.querySelector('.container').style.width = 'calc(100% - 3.5rem)';
            document.getElementById('header').style.width = 'calc(100% - 3.5rem)';
            this.sb_exanded = false;
         } else {
            sidebar.style.cssText = 'width:14rem;overflow:auto';
            this.menu_toggle = false;
            sd_pr_bx.style.cssText = 'top:0;left:0;';
            categories.style.top = '14rem';
            cat_ti.forEach(c => {
               c.style.display = 'initial';
            });
            li.forEach(l => l.style.padding = '0.7rem');
            document.querySelector('.container').style.width = 'calc(100% - 14rem)';
            document.getElementById('header').style.width = 'calc(100% - 14rem)';
            this.sb_exanded = true;
         }
      },
      ShowSidebar: function (event) {
         if (this.menu_toggle) {
            this.menu_toggle = false;
            document.getElementById('sidebar').style.left = '-14rem';
         } else {
            document.getElementById('sidebar').style.left = '0';
            this.menu_toggle = true;
         }
      },
      expandCategories: function (event) {
         if (!this.menu_toggle) {
            event.target.lastChild.style.cssText = 'max-height:16rem;margin-top:1rem;'
         }
      },
      collapseCategories: function (event) {
         if (!this.menu_toggle) {
            event.target.lastChild.style.cssText = 'max-height:0rem;margin-top:0'
         } else {

         }
      },
      expandCategory: function (event, x) {
         if (x) {
            console.log(event);
            event.target.parentNode.children[2].style.cssText =
               `max-height:0px;`;
         } else {
            event.target.parentNode.children[2].style.cssText =
               `max-height:16rem;`;
         }
      },
      onClickOverlay: function () {
         console.log('onClickOverlay');
         this.pro_popup_sh = !this.pro_popup_sh;
      },
      onClickProPop: function () {
         console.log('onClickProPop');
      }
   }
})