<div class="up_cats" v-if='comp_upcats'>


   <!-- POP UP / MODAL -->
   <div class="uc_addCat">
      <img class='ucCloseBtn' src="../../assets/images/close.svg" @click='closeUcPopup'/>
      <label>Which category you want to update</label>
      <div class="ucac_select">
         <i class="fas fa-chevron-down"></i>
         <select @change='onChangeUcacSelect(event)'>
            <option value="Select">Select an option</option>
            <option value="Main">Main Category</option>
            <option value="Sub">Subcategory</option>
         </select>
      </div>
      <div class='op_ad_main' v-if='ucAdSelectedIndex!=0'>
         <p>{{ucSelectedCat}} :: Main Category</p>
         <input type="text" placeholder='Category title' v-model='ucMainCatTitle'>
         <input type="text" placeholder='Category icon' v-model='ucMainCatIcon'>
         <p class='err' v-if='ucAdFieldErr'>Fill up the field!</p>
      </div>
      <button v-if='ucAdSelectedIndex!=0'>ADD SUB</button>
      <div class='op_ad_sub' v-if='ucAdSelectedIndex!=0'>
         <input v-for='index in ucNoSubCat' type="text" placeholder='Sub-category title' v-bind:key='index'
            v-model='ucSubCats[index-1]'>
      </div>
      <div class='minus_add' v-if='ucAdSelectedIndex!=0'>
         <i class="fas fa-minus-circle" @click='onChangeUcMinusAdd("min")'></i>
         <p>{{ucNoSubCat}}</p>
         <i class="fas fa-plus-circle" @click='onChangeUcMinusAdd("add")'></i>
      </div>
      <div v-if='ucAdSelectedIndex!=0' class='fa_save' @click='saveUcCategory'><i class="fas fa-save"></i></div>
   </div>
   <!-- POP UP / MODAL -->


   <div id="form">
      <label>Which category you want to show</label>
      <div class="select">
         <i class="fas fa-chevron-down"></i>
         <select @change='onChangeWhichCatsToShow(event)'>
            <option value="Select">Select One</option>
            <option value="User">User</option>
            <option value="Seller">Seller</option>
         </select>
      </div>
      <p v-if='ucSelectErr' class='err center-auto'>Select an option first</p>
   </div>
   <div class="ca_ta_co">
      <div class="main_table" v-if='Usr_Cats.length>0'>
         <table>
            <tr>
               <th colspan='6' class='ta_to_th'>CATEGORIES</th>
            </tr>
            <tr>
               <th>Id</th>
               <th>Title</th>
               <th>Icon</th>
               <th>Edit</th>
               <th>Delete</th>
               <th>Sub</th>
            </tr>
            <tr v-for='cat in Usr_Cats' v-bind:key='cat[0]'>
               <td>{{cat[0]}}</td>
               <td>{{cat[1]}}</td>
               <td>{{cat[2]}}</td>
               <td><i class="far fa-edit" @click='onClickEditCategory(cat[0])'></i></td>
               <td><i class="far fa-trash-alt"></i></td>
               <td><i class="fas fa-arrow-circle-right" @click='getUsersSubCategoryList(cat[0])'></i></td>
            </tr>
         </table>
      </div>
      <div class="sub_table">
         <table v-if='Usr_SubC.length>0'>
            <tr>
               <th colspan='4' class='ta_to_th'>SUB-CATEGORIES</th>
            </tr>
            <tr>
               <th>Id</th>
               <th>Title</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>
            <tr v-for='sub in Usr_SubC' v-bind:key='sub[0]'>
               <td>{{sub[0]}}</td>
               <td>{{sub[1]}}</td>
               <td><i class="far fa-edit"></i></td>
               <td><i class="far fa-trash-alt"></i></td>
            </tr>
         </table>
         <h3 v-if='noSubCats'>No Sub-Categories Found!</h3>
      </div>
   </div>

   <button class='uc_add' @click='onClickUcAddBtn'><img src="../../assets/images/PLUS.svg"></button>
</div>