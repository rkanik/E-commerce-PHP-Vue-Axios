<div id="dashboard" v-if='comp_dash'>
    <div class='accent_box'>
        <h4 class='accent'>TOTAL OVERVIEW</h4>
        <i class="fas fa-redo-alt refresh"></i>
    </div>
    <div class="daTotals">
        <div class='dab cir_teal'>
            <p>TOTAL SELLER</p>
            <h2>{{dashboardData.t_sel}}</h2>
        </div>
        <div class='dab tri_pink'>
            <p>TOTAL USER</p>
            <h2>{{dashboardData.t_user}}</h2>
        </div>
        <div class='dab sqr_purple'>
            <p>TOTAL POST</p>
            <h2>{{dashboardData.t_post}}</h2>
        </div>
        <div class='dab tri_teal'>
            <p>TOTAL SELL</p>
            <h2>{{dashboardData.t_selled}}</h2>
        </div>
        <div class='dab tri_purple'>
            <p>TOTAL EARNING</p>
            <h2 class='f-2'>${{dashboardData.t_earnd}}</h2>
        </div>
        <div class='dab sqr_teal'>
            <p>TOTAL REVENUE</p>
            <h2 class='f-2'>${{dashboardData.t_rev}}</h2>
        </div>
        <div class='dab cir_pink'>
            <p>REVENUE SELLERS</p>
            <h2 class='f-2'>${{dashboardData.t_rev_sel}}</h2>
        </div>
        <div class='dab cir_purple'>
            <p>REVENUE RKSHOP</p>
            <h2 class='f-2'>${{dashboardData.t_rev_com}}</h2>
        </div>
    </div><br>
    <div class='accent_box'>
        <h4 class='accent'>TODAYS STATISTICS</h4>
        <i class="fas fa-redo-alt refresh"></i>
    </div>
    <div class='daToday'>
        <div class='dab2 f_bgrey'>
            <p>USER IN</p>
            <h2>{{dashboardData.user_today}}</h2>
        </div>
        <div class='dab2 f_green'>
            <p>SELLER IN</p>
            <h2>{{dashboardData.seller_today}}</h2>
        </div>
        <div class='dab2 f_orange'>
            <p>POST TODAY</p>
            <h2>{{dashboardData.post_today}}</h2>
        </div>
        <div class='dab2 f_blue'>
            <p>SELL TODAY</p>
            <h2>{{dashboardData.sell_today}}</h2>
        </div>
        <div class='dab2 f_amber'>
            <p>OFFER RUNNING</p>
            <h2>{{dashboardData.t_off}}</h2>
        </div>
    </div>

    <div class="review">
        <div class="queued">
            <table>
                <tr>
                    <th colspan='8' class='qud_top_th'>REVIEW QUEUED POSTS</th>
                </tr>
                <tr>
                    <th>Image</th>
                    <th>Product name</th>
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
</div>