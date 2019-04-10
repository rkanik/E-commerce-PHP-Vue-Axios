var Seller = new Vue({
   el: '#seller',
   data: {
      sideBarThumbSrc: 'https://www.its4logistics.com/wp-content/uploads/2018/12/Seller-Fulfilled-Prime-by-ITS-Logistics.jpg',

      // Arrays / Objects
      Categories: [],
      paImageSrc: [],
      Pcategories: [],
      PSCategories: [],
      QueuedPosts: [],
      QueuedPostSrc: [],
      recentPosts: [],

      seller_id: '',
      signedIn: false,

      // Booleans //
      menu_toggle: false,
      sb_exanded: true,
      overlay: false,
      pa_upFinish: false,

      // Tabs / Views
      viewDashboard: true,
      viewPostAd: false,
      viewQueued: false,

      // Vue-Models
      paProductName: '',
      paProductPrice: '',
      paActualPrice:'',
      paProductDesc: '',
      paProductCat: '',
      paProductSubCat: '',

   },
   created() {
      axios.get('./inc/index.inc.php?action=getStatus')
         .then(res => {
            if (res.data.st === "SignedIn") {
               let data = res.data.data;
               this.signedIn = true;
               this.seller_id = data._id;

               axios.get('./inc/index.inc.php?action=getCats')
                  .then(res => {
                     if (!res.data.err) {
                        this.Categories = res.data.cats;
                     }
                  });
               axios.post('./inc/index.inc.php?action=getRecentPosts', this.toFormData({
                     id: this.seller_id
                  }))
                  .then(res => {
                     if (res.data.mess !== 'No Post Found!') {
                        console.log(res.data);
                        this.recentPosts = res.data.mess;
                        this.recentPosts.forEach(post => {
                           let srces = [];
                           post.src.forEach(p => {
                              srces.push(p.src)
                           });
                           post.src = srces;
                        });
                        console.log(this.recentPosts);
                     }
                  })
               this.setUpQueuedData();
            } else {
               window.location.replace('./signin.php');
            }
         })
   },
   mounted() {
      var feedback = function (res) {
         if (res.success === true) {
            let src = res.data.link;
            let pa_images = document.getElementById('pa_images');
            document.querySelector('.upFinish').classList.add('show');
            pa_images.innerHTML += `<img src='${src}'>`;
            //let pa_upd_img = document
         }
      };
      new Imgur({
         clientid: '5c078ee5335def9',
         callback: feedback
      });
   },
   methods: {
      SignOut: function () {
         axios.get('./inc/index.inc.php?action=signout')
            .then(res => {
               if (res.data = 'SignedOut') {
                  window.location.replace('./signin.php');
               }
            });
      },
      setUpQueuedData: function () {
         axios.post('./inc/index.inc.php?action=queuedPost', this.toFormData({
               sid: this.seller_id
            }))
            .then(res => {
               console.log('Getting Queued Data');
               if (res.data.mess !== null) {
                  console.log(res);
                  this.QueuedPosts = res.data.mess;
                  this.QueuedPostSrc = res.data.src;
               } else {
                  console.log('Queued Post Not found!');
               }
            })
      },
      savePost: function () {
         console.log('savePost');
         let mcat_id = this.Pcategories.filter(cat => cat.title === this.paProductCat)
         if (mcat_id.length === 0) {
            mcat_id = null
         } else {
            mcat_id = mcat_id[0]._id
         }
         let scat_id = this.PSCategories.filter(cat => cat.title === this.paProductSubCat)
         if (scat_id.length === 0) {
            scat_id = null
         } else {
            scat_id = scat_id[0]._id
         }

         let data = {
            _id: uuid.v4(),
            mcat_id: mcat_id,
            scat_id: scat_id,
            seller_id: this.seller_id,
            name: this.paProductName,
            price: this.paProductPrice,
            a_price: this.paActualPrice,
            desc: this.paProductDesc,
            imgSrc: this.paImageSrc.toString(),
            upd_at: new Date()
         }
         axios.post('./inc/index.inc.php?action=savePost', this.toFormData(data))
            .then(res => {
               if (res.data.pmess === 'Inserted' && res.data.smess === "Inserted") {
                  console.log('Post and Image src Inserted');
                  this.resetPostUploadForm();
                  this.resetTabs();
                  this.setUpQueuedData();
                  this.viewQueued = true;
               }
            })
      },
      resetTabs: function () {
         this.viewDashboard = false;
         this.viewPostAd = false;
         this.viewQueued = false;
      },
      resetPostUploadForm: function () {
         console.log('Reseting form');
         this.paProductName = '';
         this.paProductPrice = '';
         this.paProductDesc = '';
         this.paImageSrc = [];
         this.paImageSrc = [];
         document.querySelector('.spc_select select').selectedIndex = 0;
         document.querySelector('.spsc_select select').selectedIndex = 0;
         console.log('Form Reseted');
      },
      paImageUploadFinish: function () {
         let pa_images = document.getElementById('pa_images');
         let images = pa_images.childNodes;
         this.paImageSrc = [];
         images.forEach(img => {
            this.paImageSrc.push(img.src);
         })
         document.querySelector('.pa_upload').classList.remove('pa_upload_show');
         this.overlay = false;
         this.pa_upFinish = true;
      },
      onClickMenuToggle: function (event) {
         //console.log('onClickMenuToggle');
         let sidebar = document.getElementById('sidebar');
         var sd_pr_bx = document.querySelector('.sd_pr_bx');
         var categories = document.querySelector('.categories');
         let cat_ti = document.querySelectorAll('.cat_ti');
         //console.log(categories);
         if (!this.menu_toggle) {
            this.menu_toggle = true;
            sidebar.style.cssText = 'width:3.5rem;overflow:hidden';
            sd_pr_bx.style.cssText = 'top:-16rem;left:-14rem;';
            categories.style.top = '4rem';
            cat_ti.forEach(c => {
               c.style.display = 'none';
            });
            document.querySelector('.container').style.width = 'calc(100% - 3.5rem)';
            this.sb_exanded = false;
         } else {
            sidebar.style.cssText = 'width:14rem;overflow:auto';
            this.menu_toggle = false;
            sd_pr_bx.style.cssText = 'top:0;left:0;';
            categories.style.top = '14rem';
            cat_ti.forEach(c => {
               c.style.display = 'initial';
            });
            document.querySelector('.container').style.width = 'calc(100% - 14rem)';
            this.sb_exanded = true;
         }
      },
      OpenSubCategory: function (event) {
         let nodes = event.target.children;
         if (nodes.length > 2 && nodes[2].classList.contains('sub_cat')) {
            let sub_cat = nodes[2];
            //console.log(sub_cat);
            if (this.subCatExpanded) {
               sub_cat.style.cssText = 'height:auto;max-height:0px;';
               this.subCatExpanded = false;
            } else {
               sub_cat.style.cssText = 'height:auto;max-height:16rem;';
               this.subCatExpanded = true;
            }
         }
      },
      onMouseEnterRecentPost: function (event) {
         //console.log(event.target.children[2]);
         event.target.children[2].style.cssText = 'max-height:18rem;'
      },
      onMouseLeaveRecentPost: function (event) {
         //console.log(event.target.children[2]);
         event.target.children[2].style.cssText = 'max-height:0px;'
      },
      SidebarCatSelected: function (x) {
         if (x === '1') {
            this.resetTabs();
            this.viewDashboard = true;
         } else if (x === '2') {
            this.resetTabs();
            this.viewPostAd = true;
            this.LoadProductCategories();
         } else if (x == '3') {
            this.resetTabs();
            this.setUpQueuedData();
            this.viewQueued = true;
         }
      },
      ShowImageUploadPopup: function () {
         document.querySelector('.pa_upload').classList.add('pa_upload_show');
         this.overlay = true;
      },
      LoadProductCategories: function () {
         axios.get('./inc/index.inc.php?action=getPCats')
            .then(res => {
               if (!res.data.err) {
                  //console.log(res.data.pcats);
                  this.Pcategories = res.data.pcats;
               }
            });
      },
      paOnPcategorySelected: function (event) {
         console.log(event.target.value);
         this.paProductCat = event.target.value;
         axios.post('./inc/index.inc.php?action=getPSCats', this.toFormData({
               title: event.target.value
            }))
            .then(res => {
               //console.log(res);
               if (!res.data.err) {
                  //console.log(res.data.pcsats);
                  this.PSCategories = res.data.pcsats;
               } else {
                  this.PSCategories = [];
               }
            })
      },
      paOnPSCategorySelected: function (event) {
         console.log(event.target.value);
         this.paProductSubCat = event.target.value;
      },
      toFormData: function (obj) {
         var form_data = new FormData();
         for (var key in obj) {
            form_data.append(key, obj[key]);
         }
         return form_data;
      },
   }
});