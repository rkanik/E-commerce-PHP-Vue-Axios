<div class="recent">
   <h2>Recent Posts</h2>
   <div class='re_posts'>
      <ul>
         <li v-for='post in recentPosts' :key='post._id'
            @mouseenter='onMouseEnterRecentPost'
            @mouseleave='onMouseLeaveRecentPost'>
               <h1>{{post.pName}}</h1>
               <i class="fas fa-ellipsis-v"></i>
               <img :src=post.src[0] >
               <p>{{post.pDesc}}<p>
               <h4>PRICE: {{post.price}}$</h4>
               <i class="far fa-eye"><span>{{post.viewed}}</span></i>
               <i class="far fa-check-circle"><span>{{post.ordered}}</span></i>
               <i class="far fa-comment-dots"><span>{{post.comment}}</span></i>
               <p class='created_at'>{{post.created_at}}</p>
         </li>
      </ul>
   </div>
</div>