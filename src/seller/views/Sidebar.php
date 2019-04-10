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
      <img :src='sideBarThumbSrc'>
      <h3>Janine R. Henry</h3>
      <p>@jani.henry</p>
   </div>
   <!-- -->
   <div class="categories">
      <ul>
         <li v-for='cat in Categories' 
         @click='SidebarCatSelected(cat._id)'
         v-bind:key='cat._id' 
         class='ma_ca_li'>
            <i class="fas" v-bind:class="cat.fo_aw_class"></i>
            <a class='cat_ti' href="#">{{cat.title}}</a>
         </li>
         <hr>
         <li class='ma_ca_li'>
            <i class="fas fa-cog"></i>
            <a class='cat_ti' href='#'>Settings</a>
         </li>
         <li @click='SignOut' class='ma_ca_li'>
         <i class="fas fa-sign-out-alt"></i><a class='cat_ti' href='#'>Logout</a></li>
      </ul>
   </div>
   <!-- -->
</div>
<!-- sidebar end-->