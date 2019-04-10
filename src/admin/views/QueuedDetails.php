<!-- POP UP / MODAL -->
<div class="queuedShowPopup">
   <img class='qp_CloseBtn' src="../../assets/images/close.svg" @click='closeQPopup'/>
   <div class="qp_post">
      <div class="qpImages">
         <img id='qpImgCon' :src='qpImgCon'>
         <img class='qpsinimage' v-for='src in qpPost.src' :src=src @click='qpSetSelectedImage'>
      </div>
      <div class="qpDetails">
         <h2>{{qpPost.pName}}</h2>
         <p class='price'>PRICE:{{qpPost.price}} USD</p>
         <p>DESCRIPTION:<br>{{qpPost.pDesc}}</p>
         <p>Category:{{qpPost.Cat}} > {{qpPost.subCat}}</p>
      </div>
   </div>
   <button class='qp_save' @click='qpAcceptPost'>ACCEPT</button>
   <div class='qpRA'>
      <label>Write down the problem & send back to seller again</label>
      <br><textarea cols="30" rows="5"></textarea><br>
      <button class='qpsb'>Send</button>
      <button class='qpdb'>Delete</button>
   </div>
</div>
<!-- POP UP / MODAL -->