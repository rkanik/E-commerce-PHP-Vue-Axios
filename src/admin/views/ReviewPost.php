<div class="review" v-if='comp_review'>
   
   <div class="queued">
      <table>
         <tr>
            <th colspan='8' class='qud_top_th'>POSTS IN QUEUE</th>
         </tr>
         <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Category</th>
            <th>Sub-category</th>
            <th>Status</th>
            <th>Uploaded at</th>
            <th>View</th>
         </tr>
         <tr v-for='post in QueuedPosts' :key='post._id' >
            <td><img :src='post.src[0]' ></td>
            <td>{{post.pName}}</td>
            <td>{{post.price}}</td>
            <td>{{post.Cat}}</td>
            <td>{{post.subCat}}</td>
            <td>Queued</td>
            <td>{{post.created_at}}</td>
            <td><i class="far fa-eye" @click='showDetailsQueuedPost(post._id)'></i></td>
         </tr>
      </table>
   </div>

</div>

