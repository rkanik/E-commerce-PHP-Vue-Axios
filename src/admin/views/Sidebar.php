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
      <h3>RK ANIK</h3>
      <p>@Administrator</p>
   </div>
   <!-- -->
   <div class="categories">
      <ul>
         <li v-for='cat in Categories' 
         v-bind:key='cat[0]'
         @click='onClickSidebarCats(cat[1],cat[0])'
         class='ma_ca_li'>
            <i :class=cat[2]></i>
            <a class='cat_ti' href="#">{{cat[1]}}</a>
         </li>
         <hr class='hr'>
         <li class='ma_ca_li'><i class="fas fa-cog"></i><a class='cat_ti' href="#">Settings</a></li>
         <li class='ma_ca_li' @click='SignoutAdmin'><i class="fas fa-sign-out-alt"></i><a class='cat_ti' href="#">Logout</a></li>
      </ul>
   </div>
   <!-- -->
</div>
<!-- sidebar end-->