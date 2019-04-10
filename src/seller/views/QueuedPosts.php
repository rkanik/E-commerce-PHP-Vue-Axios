<div class="queued" v-if='viewQueued'>
   <table>
      <tr>
         <th colspan='5' class='qud_top_th'>POSTS IN QUEUE</th>
      </tr>
      <tr>
         <th>Image</th>
         <th>Title</th>
         <th>Price</th>
         <th>Status</th>
         <th>Uploaded at</th>
      </tr>
      <tr v-for='post in QueuedPosts' :key='post._id'>
         <td>
            <img :src='post.src' >
         </td>
         <td>{{post.pName}}</td>
         <td>{{post.price}}</td>
         <td>Queued</td>
         <td>{{post.created_at}}</td>
      </tr>
   </table>
</div>