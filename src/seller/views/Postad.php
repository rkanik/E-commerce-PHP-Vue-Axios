<div class="post_ad"  v-if='viewPostAd'>
   <h3 class='pa_title'>Create your post</h3>
   <div class="pa_form">

      <p class='label'>Select product category</p>
      <div class='spc_select'>
         <i class="fas fa-chevron-down"></i>
         <select @change='paOnPcategorySelected'>
            <option>Select an option</option>
            <option v-for='cat in Pcategories' :key='cat._id'>{{cat.title}}</option>
         </select>
      </div>

      <p class='label'>Select product sub-category</p>
      <div class='spsc_select'>
         <i class="fas fa-chevron-down"></i>
         <select  @change='paOnPSCategorySelected'>
            <option>Select an option</option>
            <option v-for='cat in PSCategories' :key='cat._id'>{{cat.title}}</option>
         </select>
      </div>

      <p class='label'>Product name</p>
      <input type="text" placeholder='Enter product name' v-model='paProductName'>

      <p class='label'>Sell price</p>
      <input type="number" placeholder='Enter product price (USD)' v-model='paProductPrice'>

      <p class='label'>Actual price</p>
      <input type="number" placeholder='Enter actual price (USD)' v-model='paActualPrice'>
      
      <p class='label'>Product description</p>
      <textarea id="" cols="64" rows="10"  v-model='paProductDesc'></textarea>

      <div class="pa_upd_img">
         <img v-for='src in paImageSrc' v-bind:key='src' :src='src' >
      </div>
      <button @click='ShowImageUploadPopup'><i class="fas fa-camera"></i>Add picture</button>

      <button class='paPostBtn' @click='savePost'>POST</button>

   </div>
</div>