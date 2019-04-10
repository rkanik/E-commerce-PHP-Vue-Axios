<div class="Sellers"  v-if='comp_sellers'>
   
   <div class="overview_joined">
      <div class='box to_seller'>
         <p>Total seller</p>
         <div class='circle'><span>{{sellerCounts.inTotal}}</span></div>
      </div>
      <div class='box joined_today'>
         <p>Joined today</p>
         <div class='circle'><span>{{sellerCounts.inDay}}</span></div>
      </div>
      <div class='box joined_week'>
         <p>Joined last leek</p>
         <div class='circle'><span>{{sellerCounts.inWeek}}</span></div>
      </div>
      <div class='box joined_month'>
         <p>Joined last month</p>
         <div class='circle'><span>{{sellerCounts.inMonth}}</span></div>
      </div>
      <div class='box joined_year'>
         <p>Joined last year</p>
         <div class='circle'><span>{{sellerCounts.inYear}}</span></div>
      </div>
   </div>

   <div class="tabs">
      <button class="active top_seller" @click='onClickSellerTabs("ts")'>TOP SELLERS</button>
      <button class="top_uploader" @click='onClickSellerTabs("tu")'>TOP UPLOADERS</button>
      <button class="recent_seller" @click='onClickSellerTabs("rs")'>RECENT SELLERS</button>
   </div>

   <div class="tabs_container">
      <div class="top_sellers" v-for='s in sellers' :key='s._id' v-if='top_sel'>
         <div class='he'>
            <img src="https://i.ibb.co/nbLPqzY/sample-2-11.jpg">
            <h3>{{s.firstName}} {{s.lastName}}</h3>
         </div>
         <hr>
         <div class='ba'>
            <!-- <i class="fas fa-envelope"></i> -->
            <p><span>Email address</span><br>{{s.email}}</p>
            <p><span>Contact number</span><br>{{s.phone}}</p>
            <p><span>Shop name</span><br>{{s.shopName}}</p>
            <p><span>Rating</span><br>{{s.rating}}</p>
         </div>
         <hr>
         <div>
            <a class='link' href='#'>Go to profile</p>
         </div>
      </div>
      <div class="top_uploader" v-if='top_uplo'>
         <h1>top uploader</h1>
      </div>
      <div class="recent_seller" v-if='rec_sel'>
         <h1>recent_seller</h1>
      </div>
   </div>

</div>