<template>
    <div class="auth-container">
        <div class="auth-left">
            <div class="form-header">
                <div class="logo">
                    <img src="../../../public/images/logo.png" alt="Logo" />
                </div>
                <h2>Create Account!</h2>
                <p>Enter your information below</p>
            </div>
            <form @submit.prevent="submitRegister">
                <div class="form-group">
                    <input
                        v-model="name"
                        type="text"
                        placeholder="Name"
                        class="form-control"
                        required
                        @blur="validateNameOnBlur"
                    />
                    <span v-if="errors.name" class="error">{{ errors.name }}</span>
                </div>
                <div class="form-group">
                    <input
                        v-model="username"
                        type="text"
                        placeholder="Username"
                        class="form-control"
                        required
                        @blur="validateUsernameOnBlur"
                    />
                    <span v-if="errors.username" class="error">{{ errors.username }}</span>
                </div>
                <div class="form-group">
                    <input
                        v-model="email"
                        type="email"
                        placeholder="Email"
                        class="form-control"
                        required
                        @blur="validateEmailOnBlur"
                    />
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>
                <div class="form-group">
                    <input type="file" @change="onFileChange" class="form-control-file" />
                </div>
                <div class="form-group password-group">
                    <input
                        v-model="password"
                        :type="showPassword ? 'text' : 'password'"
                        placeholder="Password"
                        class="form-control"
                        required
                        @blur="validatePasswordOnBlur"
                    />
                    <i :class="showPassword ? 'fa fa-eye' : 'fa fa-eye-slash'" @click="togglePasswordVisibility"></i>
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
                </div>
                <div class="form-group password-group">
                    <input
                        v-model="confirmPassword"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        placeholder="Confirm Password"
                        class="form-control"
                        required
                        @blur="validateConfirmPasswordOnBlur"
                    />
                    <i :class="showConfirmPassword ? 'fa fa-eye' : 'fa fa-eye-slash'" @click="toggleConfirmPasswordVisibility"></i>
                    <span v-if="errors.confirmPassword" class="error">{{ errors.confirmPassword }}</span>
                </div>
                <div class="form-group form-check">
                    <span>
                        <input type="checkbox" class="form-check-input" id="terms" v-model="isNotARobot" required />
                        <label class="form-check-label" for="terms">I'm not a robot</label>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <p class="or-text">Or Register with</p>
                <div class="social-buttons">
                    <button class="social-btn google"><i class="fa-brands fa-google"></i></button>
                    <button class="social-btn apple"><i class="fa-brands fa-apple"></i></button>
                    <button class="social-btn facebook"><i class="fa-brands fa-facebook-f"></i></button>
                </div>
                <router-link to="/" class="register-link">Already have an account? Sign In</router-link>
            </form>
        </div>
        <div class="auth-right">
            <img src="../../../public/images/illustration.png" alt="Illustration" />
        </div>
    </div>
</template>

<script>
import axios from '../axios';

export default {
    data() {
        return {
            name: '',
            username: '',
            email: '',
            password: '',
            confirmPassword: '',
            errors: {},
            file: null
        };
    },
    methods: {
        
    async submitRegister() {
            try {
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('username', this.username);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('password_confirmation', this.confirmPassword);
                if (this.file) {
                    formData.append('profile_image', this.file);
                }

                const response = await axios.post('/register_user', formData);

                alert('Registration successful!');
                console.log(response.data.message);

                // Optionally store the token and redirect
                if (response.data.token) {
                    localStorage.setItem('auth_token', response.data.token);
                    localStorage.setItem('user_name', response.data.user.username);
                    localStorage.setItem('user_id', response.data.user.id);
                    localStorage.setItem('user_email', response.data.user.email);
                    localStorage.setItem('name', response.data.user.name);
                    localStorage.setItem('user_profile', response.data.user.profile_image);
                    this.$router.push('/dashboard');
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Unexpected error:', error);
                }
            }
        },
        validateNameOnBlur() {
            this.errors.name = this.name ? '' : 'Name is required.';
        },
        validateUsernameOnBlur() {
            this.errors.username = this.username ? '' : 'Username is required.';
        },
        validateEmailOnBlur() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.email) {
                this.errors.email = 'Email is required.';
            } else if (!emailPattern.test(this.email)) {
                this.errors.email = 'Invalid email format.';
            }
        },
        validatePasswordOnBlur() {
            if (!this.password) {
                this.errors.password = 'Password is required.';
            } else if (this.password.length < 6) {
                this.errors.password = 'Password must be at least 6 characters.';
            }
        },
        validateConfirmPasswordOnBlur() {
            if (this.confirmPassword !== this.password) {
                this.errors.confirmPassword = 'Passwords do not match.';
            }
        },
        onFileChange(event) {
            this.file = event.target.files[0];
        }
    }
};
</script>

<style scoped>
/* Style similar to your login form */
.password-group {
    position: relative;
}
.password-group i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>

<style scoped>
.auth-container {
    display: flex;
     /* Set max-height to 100vh */
    min-height: 100vh;
    overflow-y: auto; /* Add vertical scroll if content exceeds 100vh */
    font-family: Arial, sans-serif;
    color: #fff;
}

.auth-left {
    width: 50%;
    padding: 40px;
    box-sizing: border-box;
}
.form-header{
    text-align: left;
    width: 100%;
    max-width: 400px;
}
.auth-right {
    width: 50%;
    background-color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-right img {
    width: 100%;
    max-width:400px;
    object-fit: cover;
}
.auth-left {
    background: url(../../../public/images/gradient.png);
    background-size:cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.logo img {
    width: 80px;
    margin-bottom: 20px;
}

.form-header h2 {
    font-size: 32px;
    margin-bottom: 10px;
    font-weight: 600;
}

.form-header p {
    color: #fff;
    font-size:16px;
    margin-bottom: 20px;
}

.form-group {
    width: 400px;
    max-width: 400px; /* Set a max-width to ensure consistent width */
    margin-bottom: 15px;
    position: relative; /* For consistent spacing of error messages */
}

.form-control {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #475569;
    border-radius: 7px;
    background-color: transparent;
    color: #fff;
    box-sizing: border-box; /* Prevents padding from affecting width */
}
.form-check-label{
    font-size:16px;
}
.form-check {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    font-size: 14px;
    max-width: 400px;
    color: #fff;
    margin-bottom: 20px;
}

.form-check-input {
    margin-right: 10px;
}

.forgot-password {
    color: var(--primary-color);
    font-size: 14px;
    text-decoration: none;
}

.btn-primary {
    width: 100%;
    max-width: 400px;
    background-color: var(--primary-color);
    color: #000;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    box-sizing: border-box;
}

.or-text {
    color: #fff;
    margin: 20px 0;
    font-size: 14px;
    text-align: center;
}

.social-buttons {
    display: flex;
    justify-content: space-between;
    max-width: 400px;
    width: 100%;
    margin-bottom: 20px;
}

.social-btn {
    width: 100px;
    height: 70px;
    border-radius: 8px;
    border: 1px solid #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    
    font-size: 45px;
}



.register-link {
    color: var(--primary-color);
    text-align: center;
    display: block;
    
    font-size: 14px;
    text-decoration: none;
}
.register-text{
    display: flex;
    justify-content: center;
    gap:5px;
    font-size:16px;
    margin-top:10px;
}
.auth-right {
    background-color: #a0ffee;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-right img {
    width: 100%;
    max-height:100vh;
    object-fit: cover;
}

.error {
    color: #ff4d4d;
    font-size: 14px;
    margin-top: 5px;
    min-height: 18px; /* Maintain spacing even when no error */
}

</style>
