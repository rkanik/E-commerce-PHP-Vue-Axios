<div id="profile" v-if='comp.pro'>
    <!-- <div class="pro_head pro-pic">
        <img :src='profileDef'>
        <h2>{{profileData.firstName}} {{profileData.lastName}}</h2>
        <p>@{{profileData.userName}}</p>
    </div> -->
    <div class="pro_con">
        <div class="left">
            <div class="pl_head">
                <h3>MY ACCOUNT</h3>
            </div>
            <ul>
                <li class='active' @click='onClickProfileNavA'><a href="#pr_head">Profile Overview</a></li>
                <li><a href="#basic" @click='onClickProfileNavA'>Basics Info</a></li>
                <li><a href="#contact" @click='onClickProfileNavA'>Contact & Social</a></li>
                <li><a href="#address" @click='onClickProfileNavA'>Address book</a></li>
                <li><a href="#favcat" @click='onClickProfileNavA'>Favorite Categories</a></li>
                <li><a href="#morders" @click='onClickProfileNavA'>My orders</a></li>
                <li><a href="#msaved" @click='onClickProfileNavA'>Saved post</a></li>
            </ul>
        </div>
        <div class="right" v-if='!edit_pro'>
            <div id="pr_head">
                <i class="fas fa-user-edit" @click='showProfileEditor'><span>EDIT</span></i>
                <img :src='profileDef'>
                <h2>{{profileData.firstName}} {{profileData.lastName}}</h2>
                <p>@{{profileData.userName}}</p>
            </div>
            <div id="basic">
                <div class="info">
                    <p class='acn'>Email address</p>
                    <h2>{{profileData.email}}</h2>
                    <p class='acn'>Gender</p>
                    <h2 v-if='profileData.gender'>{{profileData.gender}}</h2>
                    <p class='alt' v-else>edit your profile</p>
                    <p class='acn'>Date of birth</p>
                    <h2 v-if='profileData.date_of_birth'>{{profileData.date_of_birth}}</h2>
                    <p class='alt' v-else>edit your profile</p>
                </div>
                <div class="ills">
                    <img src="../../assets/images/basic.svg">
                </div>
            </div>
            <div id="contact">
                <div class="ills">
                    <img src="../../assets/images/contact.svg">
                </div>
                <div class="info">
                    <p class="acn">Contact number</p>
                    <h2 v-if='profileData.phone'>{{profileData.phone}}</h2>
                    <p v-else class='alt'>edit profile</p>
                    <p class="acn">Social</p>
                    <h2 v-if='profileData.fb'>{{profileData.fb}}</h2>
                    <i v-else class="fab fa-facebook-square fa-2x"></i>
                    <h2 v-if='profileData.fb'>{{profileData.gm}}</h2>
                    <i v-else class="fab fa-google-plus-square fa-2x"></i>
                    <h2 v-if='profileData.fb'>{{profileData.tw}}</h2>
                    <i v-else class="fab fa-twitter-square fa-2x"></i>
                    <h2 v-if='profileData.fb'>{{profileData.ins}}</h2>
                    <i v-else class="fab fa-instagram fa-2x"></i>
                </div>
            </div>
            <div id="address">
                <div class="ills">
                    <img src="../../assets/images/address_o.svg">
                </div>
                <div class="info">
                    <p class="acn">Street</p>
                    <h2 v-if='profileData.street'>{{profileData.street}}</h2>
                    <p v-else class='alt'>edit profile</p>
                    <p class="acn">City</p>
                    <h2 v-if='profileData.city'>{{profileData.city}}</h2>
                    <p v-else class='alt'>edit profile</p>
                    <p class="acn">State/District</p>
                    <h2 v-if='profileData.state'>{{profileData.state}}</h2>
                    <p v-else class='alt'>edit profile</p>
                    <p class="acn">Zip/Postal</p>
                    <h2 v-if='profileData.zip'>{{profileData.zip}}</h2>
                    <p v-else class='alt'>edit profile</p>
                    <p class="acn">Country</p>
                    <h2 v-if='profileData.country'>{{profileData.country}}</h2>
                    <p v-else class='alt'>edit profile</p>
                </div>
            </div>
        </div>
        <div class="edit_pro" v-if='edit_pro'>
            <div>
                <label>Firstname</label>
                <input type="text" v-model='updateData.firstName'>
            </div>
            <div>
                <label>Lastname</label>
                <input type="text" v-model='updateData.lastName'>
            </div>
            <div>
                <label>Gender</label>
                <select name="gender" v-model='updateData.gender'>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <!-- <div>
                <label>Date of birth</label>
                <input type="date" v-model='updateData.date_of_birth'>
            </div> -->
            <div>
                <label>Contact number</label>
                <input type="phone" v-model='updateData.phone'>
            </div>
            <div class='col-2'>
                <label>Street/House</label>
                <input type="text" v-model='updateData.street'>
            </div>
            <div>
                <label>City/Sub-district</label>
                <input type="text" v-model='updateData.city'>
            </div>
            <div>
                <label>State/District</label>
                <input type="text" v-model='updateData.state'>
            </div>
            <div>
                <label>Zip/Postal code</label>
                <input type="text" v-model='updateData.zip'>
            </div>
            <div>
                <label>Country</label>
                <input type="text" v-model='updateData.country'>
            </div>
            <div>
                <button class='cl' @click='edit_pro=false'>CANCEL</button>
                <button class='up' @click='updateProfile'>UPDATE</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="pro-pic">
        <input type="file" @change="updateProfileImage" title="">
        <img :src='profileDef'>
    </div>
    <div class="top-info">
        <h2>{{profileData.firstName}} {{profileData.lastName}}</h2>
        <p>@{{profileData.userName}}</p>
    </div>
    <hr class="hr hr-un-to">
    <div class="basic-info">
        <p class="pi-p">Profile</p>
        <div class="info-com birthday">
            <i class="fas fa-birthday-cake fa-lg"></i>
            <h4>Birthday</h4>
            <p>Feb 02 1997</p>
        </div>
        <div class="info-com gender">
            <i class="fas fa-transgender fa-lg"></i>
            <h4>Gender</h4>
            <p>Male</p>
        </div>
    </div>
    <div class="basic-info">
        <p class="pi-p">Contact & security</p>
        <div class="info-com email">
            <i class="fas fa-envelope fa-lg"></i>
            <h4>Email address</h4>
            <p>{{profileData.email}}</p>
        </div>
        <div class="info-com phone">
            <i class="fas fa-phone fa-lg"></i>
            <h4>Phone</h4>
            <p>01703577953</p>
            <p>01987886450</p>
        </div>
        <div class="info-com password">
            <i class="fas fa-unlock-alt fa-lg"></i>
            <h4>Password</h4>
            <p>●●●●●●</p>
        </div>
    </div> -->