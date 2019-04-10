 <!-- sidebar start -->
 <div id="sidebar" class='ma_left'>
   <!-- menu toggle button -->
   <button class="hamburger hamburger--arrowturn" type="button" @click='onClickMenuToggle'
      v-bind:class="{'is-active':!menu_toggle}">
      <span class="hamburger-box">
         <span class="hamburger-inner"></span>
      </span>
   </button>
   <!-- -------------------- -->
   <!-- -->
   <div class="sd_pr_bx">
      <img v-if='profileData.pro_src' :src=profileData.pro-src>
      <div class='spb_pro_else' v-else>
         <i class="fas fa-cloud-upload-alt fa-2x"></i>
         <img src='../../assets/images/profile_default_teal.svg'>
         <p>Upload Profile</p>
      </div>
      <div class='de'>
         <h3>{{profileData.firstName}} {{profileData.lastName}}</h3>
         <p>@{{profileData.userName}}</p>
         <i class="fas fa-users-cog" @click='onClickProfileCog'></i>
      </div>
   </div>
   <!-- -->
   <div class="categories">
      <hr>
      <ul>
         <li @click='onClickSideBarHome'><p><i class="fas fa-home"></i><span>Home</span></p></li>
         <li @mouseenter='expandCategories' @mouseleave='collapseCategories'>
            <p><i class="fab fa-accessible-icon"></i><span>Jump to</span></p>
            <ul id='subItems'>
               <li>New Arrivals</li>
               <li>Trending Products</li>
               <li>Best Selling</li>
               <li>Top Offers</li>
               <li>Top Sellers</li>
            </ul>
         </li>
         <li v-for='cat in Categories' :key='cat._id' 
         @mouseenter='expandCategories' @mouseleave='collapseCategories'>
            <p><i class="fas" v-bind:class="cat.fo_aw_class"></i>
            <span>{{cat.title}}</span></p>
            <ul>
               <li v-for='s in cat.sub' :key='s'>{{s}}</li>
            </ul>
         </li>
         <hr>
         <li><p><i class="fas fa-cog"></i><span>Settings</span></p></li>
         <li @click='SignOut'><p><i class="fas fa-sign-out-alt"></i><span>Logout</span></p></li>
      </ul>
   </div>
   <!-- -->
</div>
<!-- sidebar end-->