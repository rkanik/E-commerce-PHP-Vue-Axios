const add = new Vue({
   el: '#Admin',
   data: {
      menu_toggle: false,
      sideBarThumbSrc: 'https://i.imgur.com/rmrISmx.jpg',
      Categories: [
         [0, 'Dashboard', 'fas fa-tachometer-alt'],
         [1, 'Review Posts', 'fas fa-clipboard-check'],
         [2, 'Categories', 'far fa-edit'],
         [3, 'Covers', 'far fa-images'],
         [4, 'Sellers', 'fas fa-user-tie'],
         [5, 'Users', 'fas fa-user-friends']
      ],
      sb_exanded: true,
      noSubCats: true,
      subCatExpanded: false,
      overlay: false,
      comp_upcats: false,
      comp_users: false,
      comp_review: false,
      comp_sellers: false,
      comp_dash: true,
      ucAdFieldErr: false,
      showQueuedDetails: false,
      isSellerLoaded: false,
      top_sel: true,
      top_uplo: false,
      rec_sel: false,
      comp_covers: false,

      Usr_Cats: [],
      Usr_SubC: [],
      ucSubCats: [],
      QueuedPosts: [],
      qpPost: [],
      qpImgCon: '',
      sellers: [],
      dashboardData: [],

      ucSelectedCat: '',
      ucNoSubCat: 0,
      ucMainCatTitle: '',
      ucMainCatIcon: '',
      ucAdSelectedIndex: 0,
      qpSelectedImg: '',
      sellerCounts: [],

      // Errors
      ucSelectErr: false,
   },
   created() {
      console.log('Created Admin');
      axios.get('./inc/index.inc.php?action=CheckStatus')
         .then(res => {
            console.log(res);
            if (res.data.err && res.data.mess === 'SignedOut') {
               window.location.replace('./signin.php');
            }
         })
      axios.get('./inc/index.inc.php?action=initiateDashboard')
         .then(res => {
            console.log(res);
            if (res.data.s) {
               this.dashboardData = res.data.data;
            }
         })
      this.LoadQueuedPosts();
   },
   mounted() {
      document.querySelector('.ma_ca_li').classList.add('active');
   },
   methods: {
      onClickSellerTabs: function (x) {
         this.top_sel = false;
         this.top_uplo = false;
         this.rec_sel = false;
         if (x === 'ts') {
            this.top_sel = true
         } else if (x === 'tu') {
            this.top_uplo = true
         } else if (x === 'rs') {
            this.rec_sel = true
         }
      },
      SignoutAdmin: function () {
         axios.get('./inc/index.inc.php?action=SignOut')
            .then(res => {
               console.log(res);
               if (res.data.mess === 'SignedOut') {
                  window.location.replace('./signin.php');
               }
            })
      },
      qpAcceptPost: function () {
         console.log('qpAcceptPost');
         console.log(this.qpPost._id);
         axios.post('./inc/index.inc.php?action=acceptPost', this.toFormData({
               id: this.qpPost._id
            }))
            .then(res => {
               if (res.data.mess === 'Updated') {
                  this.closeQPopup();
                  this.LoadQueuedPosts();
               }
            })
      },
      qpSetSelectedImage: function (event) {
         this.qpImgCon = event.target.src;
         let a = document.querySelectorAll('.qpsinimage');
         a.forEach(b => {
            b.style.borderColor = 'rgb(214, 214, 214)';
         })
         event.target.style.borderColor = '#0097a7';
      },
      showDetailsQueuedPost: function (id) {
         this.qpPost = this.QueuedPosts.filter(post => post._id === id);
         this.qpPost = this.qpPost[0];
         this.qpImgCon = this.qpPost.src[0];
         this.showPopup();
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
      LoadQueuedPosts: function () {
         axios.get('./inc/index.inc.php?action=queuedPost')
            .then(res => {
               console.log('Getting Queued Data');
               if (res.data.mess !== null) {
                  console.log(res);
                  this.QueuedPosts = res.data.mess;
                  this.QueuedPosts.forEach(post => {
                     let srces = [];
                     post.src.forEach(p => {
                        srces.push(p.src)
                     });
                     post.src = srces;
                  })
                  console.log(this.QueuedPosts);
               } else {
                  console.log('Queued Post Not found!');
                  this.QueuedPosts = [];
               }
            })
      },
      getSellersInfo: function () {
         if (!this.isSellerLoaded) {
            axios.post('./inc/index.inc.php?action=getSellers')
               .then(res => {
                  if (res.data !== 'Noting Found') {
                     this.sellers = res.data;
                  }
               });
            axios.get('./inc/index.inc.php?action=getSellerCounts')
               .then(res => {
                  this.sellerCounts = res.data;
               });
            this.isSellerLoaded = true;
         }
      },
      onClickSidebarCats: function (text, position) {
         console.log(position);
         this.resetComps();
         this.resetSelectedCat();
         this.setSelectedCat(position);
         if (text === 'Review Posts') {
            this.LoadQueuedPosts();
            this.comp_review = true;
         } else if (text === 'Categories') {
            this.comp_upcats = true;
         } else if (text === 'Covers') {
            this.comp_covers = true;
         } else if (text === 'Sellers') {
            this.getSellersInfo();
            this.comp_sellers = true;
         } else if (text === 'Users') {
            this.comp_users = true;
         } else if (text === 'Dashboard') {
            this.comp_dash = true;
         }
      },
      resetComps: function () {
         this.comp_review = false;
         this.comp_users = false;
         this.comp_upcats = false;
         this.comp_sellers = false;
         this.comp_covers = false;
         this.comp_dash = false;
      },
      resetSelectedCat: function () {
         let a = document.querySelectorAll('.ma_ca_li');
         a.forEach(b => {
            if (b.classList.contains('active')) {
               b.classList.remove('active');
            }
         })
      },
      setSelectedCat: function (pos) {
         let a = document.querySelectorAll('.ma_ca_li');
         a[pos].classList.add('active');
      },
      onChangeWhichCatsToShow: function (event) {
         //console.log('onChangeWhichCatsToUpdate');
         //console.log(document.getElementById('sel_forwhich').value);
         console.log(event.target.value);
         let a = event.target.value;
         if (a !== 'Select') {
            if (a === 'Seller') {
               this.Usr_Cats = [];
               this.Usr_SubC = [];
               this.ucSelectedCat = 'Seller';
               this.ucSelectErr = false;
            } else if (a === 'User') {
               this.getUsersCategoryList();
               this.ucSelectedCat = 'User';
               this.ucSelectErr = false;
            }
         } else {
            this.Usr_Cats = [];
            this.Usr_SubC = [];
            this.ucSelectedCat = '';
         }
      },
      getUsersCategoryList: function () {
         this.Usr_Cats = [];
         axios.get('./inc/index.inc.php?action=getCats')
            .then(res => {
               console.log(res);
               if (!res.data.err) {
                  let cats = res.data.cats;
                  //console.log(cats);
                  cats.forEach(cat => {
                     this.Usr_Cats.push([cat._id, cat.title, cat.fo_aw_class]);
                  });
                  this.getUsersSubCategoryList(this.Usr_Cats[0][0]);
                  //console.log(this.User_Categories);
                  //console.log(this.Usr_Cats);
               }
            })

      },
      getUsersSubCategoryList(x) {
         console.log('Sub Cat');
         this.Usr_SubC = [];
         axios.get(`./inc/index.inc.php?action=getSubCats&id=${x}`)
            .then(res => {
               //console.log(res);
               if (!res.data.err) {
                  this.noSubCats = false;
                  let subs = res.data.subs;
                  subs.forEach(sub => {
                     this.Usr_SubC.push([sub._id, sub.title]);
                  });
               } else {
                  this.noSubCats = true;
               }
            })
      },
      onClickEditCategory: function (id) {
         console.log('onClickEditCategory: ID=>', id);
      },
      onClickUcAddBtn: function () {
         if (this.ucSelectedCat !== '') {
            this.overlay = true;
            document.querySelector('.uc_addCat').classList.add('uca_show');
         } else {
            this.ucSelectErr = true;
         }
      },
      onChangeUcMinusAdd: function (x) {
         switch (x) {
            case 'min':
               if (this.ucNoSubCat > 0) {
                  this.ucNoSubCat--;
                  this.ucSubCats.pop()
               }
               break;
            case 'add':
               if (this.ucNoSubCat < 0) {
                  this.ucNoSubCat = 1
               } else {
                  this.ucNoSubCat++;
               }
               break;
            default:
               break;
         }
      },
      saveUcCategory: function () {
         console.log('saveUcCategory');
         if (this.ucMainCatTitle === '' || this.ucMainCatIcon === '') {
            this.ucAdFieldErr = true;
         } else {
            this.ucAdFieldErr = false;
            this.ucSubCats = this.ucSubCats.filter(a => a !== '');
            //let id = uuid.v4();
            let data = this.toFormData({
               title: this.ucMainCatTitle,
               fo_aw_class: this.ucMainCatIcon
            })
            axios.post(`./inc/index.inc.php?action=add${this.ucSelectedCat}Cat`, data)
               .then(res => {
                  console.log(res);
                  if (!this.ucSubCats.length == 0) {
                     if (!res.data.err) {
                        let data = this.toFormData({
                           titles: this.ucSubCats.toString(),
                           mName: this.ucMainCatTitle
                        });
                        axios.post(`./inc/index.inc.php?action=add${this.ucSelectedCat}SubCat`, data)
                           .then(res => {
                              console.log(res);
                              if (res.data.mess === 'Inserted') {
                                 this.closeUcPopup();
                                 this.ucSubCats = [];
                                 this.ucMainCatTitle = '';
                                 this.ucMainCatIcon = '';
                                 this.noSubCats = 0;
                                 this.getUsersCategoryList();
                              }
                           })
                     }
                  }
                  if (res.data.mess === 'Inserted') {
                     this.closeUcPopup();
                     this.ucSubCats = [];
                     this.ucMainCatTitle = '';
                     this.ucMainCatIcon = '';
                     this.noSubCats = 0;
                     this.getUsersCategoryList();
                  }
               });
         }
      },
      onChangeUcacSelect: function (event) {
         console.log('onChangeUcacSelect');
         console.log(event.target.selectedIndex);
         this.ucAdSelectedIndex = event.target.selectedIndex;
      },
      toFormData: function (obj) {
         var form_data = new FormData();
         for (var key in obj) {
            form_data.append(key, obj[key]);
         }
         return form_data;
      },
      closeUcPopup: function () {
         this.overlay = false;
         document.querySelector('.uc_addCat').classList.remove('uca_show');
      },
      closeQPopup: function () {
         console.log('closeQPopup');
         this.qpPost = [];
         this.overlay = false;
         document.querySelector('.queuedShowPopup').classList.remove('qsp_show');
      },
      showPopup: function () {
         console.log('showPopup');
         this.overlay = true;
         document.querySelector('.queuedShowPopup').classList.add('qsp_show');
      }
   }
})