<div class="Home" v-if='comp.dash'>
   
   <div class="slideshow">
      <img :src=ssSrc >
   </div>

   <div class="ds_newest">


      <div class="post" v-for='post in RecentPosts' :key='post._id'>
         <div class="pi_con" @mouseenter='showQuickViewBtn' @mouseleave='hideQuickViewBtn'>
            <img :src=post.src[0] >
            <button @click='onClickPostQuickView(post._id)'>QUICK VIEW</button>
         </div>
         <div class="psh_det">
            <div class='pp_name'><span></span><h3>{{post.pName}}</h3></div>
            <p class='cats'><span class='mcat'>{{post.mcat}}</span> | <span class='scat'>{{post.scat}}</span></p>
            <p style='margin-top:0.4rem'>
               <span class='cur'>$</span>
               <span class='price'>{{post.price}}</span>
               <span class='offprice'></span>
            </p>
            <i class="fas fa-shopping-cart"></i>
         </div>
      </div>


   </div>
   
</div>


<!-- <div class="pst_con">
   <img src="https://i.ibb.co/nbLPqzY/sample-2-11.jpg">
</div>
<h3>Seller Name</h3>
<h4>Price <span>25</span><span> USD</span></h4>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, magni.</p>
<div class="pi_con">
   <img src="https://i.ibb.co/VmdXchM/sample-13.jpg">
   <img src="https://i.ibb.co/5GpF8kT/sample-14.jpg">
   <img src="https://i.ibb.co/VmdXchM/sample-13.jpg">
</div>
<div class="ps_con">
   <p><span>50</span> Likes</p>
   <p><span>5</span> Comments</p>
   <p><span>2</span> Carts</p>
</div>
<div class="pt_con">
   <i class="far fa-thumbs-up"><span>50</span></i>
   <i class="far fa-comment"></i>
   <i class="far fa-star"></i>
   <i class="fas fa-shopping-cart"><span>10</span></i>
</div> -->