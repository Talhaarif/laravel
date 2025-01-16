<template>
    <div class="auth-container">
        <div class="auth-left">
            <div class="form-header">
                <div class="logo">
                    <img src="../../../public/images/logo.png" alt="Logo" />
                </div>
                <h2>Hello, Welcome Back!</h2>
                <p>Enter your information below</p>
            </div>
            <form @submit.prevent="submitLogin">
                <div class="form-group">
                    <label>Email</label>
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
                <div class="form-group password-group">
                    <label>Password</label>
                    <input
                        v-model="password"
                        :type="passwordVisible ? 'text' : 'password'"
                        placeholder="Password"
                        class="form-control"
                        required
                        @blur="validatePasswordOnBlur"
                    />
                    <i
                        :class="passwordVisible ? 'fas fa-eye' : 'fas fa-eye-slash'"
                        class="toggle-password"
                        @click="togglePasswordVisibility"
                    ></i>
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
                </div>
                <div class="form-group form-check">
                    <div>
                        <input type="checkbox" class="form-check-input" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <router-link to="/forgot-password" class="forgot-password">Forgot Password?</router-link>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <p class="or-text">Or Login with</p>
                <div class="social-buttons">
                    <button class="social-btn google"> <i class="fa-brands fa-google"></i></button>
                    <button class="social-btn apple"><i class="fa-brands fa-apple"></i></button>
                    <button class="social-btn facebook"><i class="fa-brands fa-facebook-f"></i></button>
                </div>
                <div class="register-text">
                    Don’t have an account? <router-link to="/register" class="register-link">Register Now</router-link>
                </div>
            </form>
        </div>
        <div class="auth-right">
            <img src="../../../public/images/login_image.png" alt="Illustration" />
        </div>
    </div>
</template>

<script>
import axios from '../axios';

export default {
    data() {
        return {
            email: '',
            password: '',
            passwordVisible: false, // Track password visibility
            errors: {
                email: '',
                password: ''
            }
        };
    },
    methods: {

        async submitLogin() {
            try {
                const response = await axios.post('/login_user', {
                    email: this.email,
                    password: this.password,
                });

                alert('Login successful!');
                console.log(response.data.message);

                // Store token and redirect
                localStorage.setItem('auth_token', response.data.token);
                localStorage.setItem('user_name', response.data.user.username);
                localStorage.setItem('user_id', response.data.user.id);
                localStorage.setItem('user_email', response.data.user.email);
                localStorage.setItem('name', response.data.user.name);
                localStorage.setItem('user_profile', response.data.user.profile_image);
                this.$router.push('/dashboard');
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Unexpected error:', error);
                    alert('An unexpected error occurred.');
                }
            }
        },

        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
        },
        validateEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        },
        validateEmailOnBlur() {
            if (!this.email) {
                this.errors.email = 'Email is required';
            } else if (!this.validateEmail(this.email)) {
                this.errors.email = 'Enter a valid email address';
            } else {
                this.errors.email = '';
            }
        },
        validatePasswordOnBlur() {
            if (!this.password) {
                this.errors.password = 'Password is required';
            } else if (this.password.length < 6) {
                this.errors.password = 'Password must be at least 6 characters';
            } else {
                this.errors.password = '';
            }
        },
        
    }
};

</script>

<style scoped>
.auth-container {
    display: flex;
    min-height: 100vh;
    overflow-y: auto;
    font-family: Arial, sans-serif;
    color: #fff;
}

.auth-left {
    width: 50%;
    padding: 40px;
    box-sizing: border-box;
    background: url(../../../public/images/gradient.png);
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
    max-width:500px;
    object-fit: contain;
}
.form-header {
    text-align: left;
    width: 100%;
    max-width: 400px;
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
    font-size: 16px;
    margin-bottom: 20px;
}

.form-group {
    width: 400px;
    max-width: 400px;
    margin-bottom: 15px;
    position: relative;
}

.form-control {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #475569;
    border-radius: 7px;
    background-color: transparent;
    color: #fff;
    box-sizing: border-box;
}

.password-group {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 67%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #fff;
}

.form-check-label {
    font-size: 16px;
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

.register-text {
    display: flex;
    justify-content: center;
    gap: 5px;
    font-size: 16px;
    margin-top: 10px;
}

.error {
    color: #ff4d4d;
    font-size: 14px;
    margin-top: 5px;
    min-height: 18px;
}
</style>
