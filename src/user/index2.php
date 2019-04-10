<?php include('../head.php'); ?>

<title>Welcome to our website</title>
<link href="../../assets/css/hamburgers.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/index.css">
<head>
    <body>
        <div id="app">
            <header>
                <button @click='ShowSidebar' 
                class="hamburger hamburger--arrowturn" 
                type="button" v-bind:class="{'is-active':menu_toggle}">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
                <nav>
                    <ul>
                        <li @click='onClickOverlay'>ACCOUNT
                            <div class="acc_pop hide" 
                            v-bind:class="{'show':pro_popup_sh}"
                            @click='onClickProPop'>
                                <div class="pop-na-us" v-if='isLoggedIn' >
                                    <h3>RK ANIK</h3>
                                    <p>@rkanik</p>
                                </div>
                                <div class="pop-na-us reg_here">
                                    <button><a href="./src/views/register.php">REGISTER</a></button>
                                    <button><a href="">LOGIN</a></button>
                                </div>
                                <div class="pop-ul pop-basic">
                                    <ul>
                                    <li>Profile</li>
                                    <li>Favourite</li>
                                    <li>Watch list</li>
                                    </ul>
                                </div>
                                <div class="pop-ul pop-set">
                                    <ul>
                                    <li>Settings & privacy</li>
                                    <li><a href="./src/views/register_seller.php">Seller area</a></li>
                                    <li>Help Center</li>
                                    <li>Log out</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>SEARCH</li>
                        <li>CART(0)</li>
                        <li>WISH LIST</li>
                    </ul>
                </nav>
            </header>

            <section id='slide_show_container'>
                <img :src=coverSrc[2] >
                <div class="cd_arrow">
                    <a href="#main_content"></a>
                    <img src="https://img.icons8.com/ios/64/000000/expand-arrow-filled.png">
                </div>
            </section>

            <section id='main_content'>

                <div class="popular">
                    <div class="cat_box">
                        <span class='cb_circle cbc_one'></span>
                        <span class='cb_circle cbc_two'></span>
                        <h1>POPULAR PRODUCTS</h1>
                    </div>
                    <div class="item" v-for='item in popular_Post' v-bind:key=item.id>
                        <span class='item_overlay'></span>
                        <img :src=item.thumb class='item_thumb'>
                        <div class="i_desc">
                            <h3 class='price'>{{item.price}} <span class='currency'>{{item.currency}}</span></h3>
                            <p class='item_title'>{{item.title}}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Absolutes Layouts -->
            <!-- An invisible overlay -->
            <div @click="onClickOverlay" 
            class="overlay hide" 
            v-bind:class="{'show':pro_popup_sh}"></div>
            <?php include './views/sidebar.php'?>
        </div>
    <!-- Vue script and index js-->
    <script src='../js/axios.js'></script>
    <script src='../js/uuid.js'></script>
    <script src='../js/vue.min.js'></script>
    <script src='./js/index.js'></script>
    </body>
</html>