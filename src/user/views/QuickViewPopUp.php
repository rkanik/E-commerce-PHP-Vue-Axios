<!-- POP UP / MODAL -->
<div class="quickViewPopUp" :class="{qvp_show:qvPopUp}">
   <img class='qv_CloseBtn' src="../../assets/images/close.svg" @click='closeQVPopup'/>
   <div class="qv_post">
      <div class="qvImages">
         <img id='qvImgCon' :src='qvImgCon'>
         <img class='qvsinimage' v-for='src in qvPost.src' :src=src @click='qvSetSelectedImage'>
      </div>
      <div class="qvDetails">
         <h2>{{qvPost.pName}}</h2>
         <p class='price'>PRICE:{{qvPost.price}} USD</p>
         <p>DESCRIPTION:<br>{{qvPost.pDesc}}</p>
         <p>Category:{{qvPost.mcat}} > {{qvPost.scat}}</p>
      </div>
   </div>
</div>
<!-- POP UP / MODAL -->