<!-- Header.vue -->
<template>
  <header class="header">
    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search..." />
    </div>
    <div class="header-icons">
     
        <div class="icon-div"><i class="fas fa-envelope"></i></div>
      <div class="icon-div"><i class="fas fa-calendar"></i></div>
      <div class="icon-div">
        <span>25</span>
        <i class="fas fa-bell"></i></div>
      
      <div class="line-divider">|</div>
      <div class="user-profile">
        <div class="user-profile-div">
          <div class="online-dot">
            <span></span>
          </div>
          <img :src="userProfile" alt="User profile" />
        </div>
        <p class="user-name">{{userName}} <br>
        <span class="user-type">@{{userUniqueName}}</span>
        </p>
        <div class="drop-down-arrow-div">
          <i class="fa-solid fa-circle-chevron-down"></i>
          <div class="drop-down-menu">
            <ul>
              <li>Profile</li>
              <li>Setting</li>
              <li>Privacy Policy</li>
              <li @click="logout">Log Out</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import axios from '../axios';  // Make sure to import axios

export default {
    data() {
        return {
            userName: '',
            userUniqueName: '',
            userProfile: '',
        };
    },
    created() {
        // Retrieve data from localStorage when the component is created
        this.userName = localStorage.getItem('name');
        this.userUniqueName = localStorage.getItem('user_name');
        this.userProfile = localStorage.getItem('user_profile');
    },
    methods: {
        async logout() {
            try {
                await axios.post('http://127.0.0.1:8000/api/logout_user', {}, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('auth_token')}`
                    }
                    
                });

                // Clear token and redirect to login
                localStorage.removeItem('auth_token');
                this.$router.push('/');
               
            } catch (error) {
                console.error('Logout error:', error);
                alert('Logout failed.');
            }
        }
    }
};
</script>


<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  background-color: #1F1F1F;
  color: #fff;
}
.drop-down-arrow-div{
  position: relative;
  cursor: pointer;
}
.drop-down-arrow-div:hover .drop-down-menu{
  opacity: 1;
  visibility: visible;
}
.drop-down-menu{
  opacity: 0;
  visibility: hidden;
  position: absolute;
  background-color: #1F2625;
  padding: 20px 25px;
  min-width: 170px;
  left: -135px;
  transition: all ease-in-out .3s;
}
.drop-down-menu ul li{
  padding: 7px 0;
  cursor: pointer;
}

.header-icons {
  display: flex;
  align-items: center;
  gap: 20px;
}
.header-icons i{
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  line-height: 0;
  font-size: 20px;
  background-color: #1F2625;
  border-radius:50%;
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 8px;
}

.user-profile img {
  border-radius: 50%;
}
/* Container for the search bar */
.search-bar {
  display: flex;
  align-items: center;
  background-color: #1F2625; /* Dark gray background */
  border-radius: 8px; /* Rounded corners */
  padding: 8px 12px; /* Padding around the content */
 max-width: 400px;
 width: 100%;
}
.user-profile-div{
  width: 38px;
  height: 38px;
  position: relative;
}
.online-dot{
  background-color: white;
  right: 0;
  width: 12px;
  height: 12px;
  display: flex;
  justify-content: center;
  align-items: center;
  bottom: -2px;
  position: absolute;
  border-radius: 50%;
}
.online-dot span{
  background-color: #14CB74;
  right: 0;
  width: 60%;
  height: 60%;
  border-radius: 50%;

}

/* Font Awesome search icon */
.search-bar i {
  color: #a0a0a0; /* Light gray color for the icon */
  margin-right: 8px; /* Space between icon and input field */
  font-size: 16px; /* Icon size */
}

/* Search input field */
.search-bar input {
  border: none; /* Remove default border */
  background: none; /* Remove default background */
  color: #ffffff; /* White text color */
  outline: none; /* Remove focus outline */
  font-size: 16px; /* Font size */
  width: 100%; /* Take the remaining space */
}
.user-name{
  font-size: 12px;
  font-weight: 500;
}
.user-type{
  font-size: 10px;
  font-weight: 400;
  color: #94A3B8;
}
.icon-div span {
    position: absolute;
    font-size: 10px;
    background-color: #99F7E3;
    color: black;
    width: 24px;
    text-align: center;
    border-radius: 50px;
    right: 0;
}
.icon-div {
    position: relative;
}

</style>
