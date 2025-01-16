import axios from 'axios';
import router from './router';

// Set Axios defaults
axios.defaults.baseURL = '/api'; // Update the base URL if necessary
axios.defaults.headers.common['Accept'] = 'application/json';

// Add an Authorization header if a token exists
const token = localStorage.getItem('auth_token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

// Handle CSRF token if applicable
const csrfToken = document.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
}

// Intercept requests to include the Authorization header dynamically
axios.interceptors.request.use(
    (config) => {
        const authToken = localStorage.getItem('auth_token');
        if (authToken) {
            config.headers['Authorization'] = `Bearer ${authToken}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Handle response errors globally
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            // Token expired or unauthorized, handle accordingly
            alert('Unauthorized! Please login again.');
            localStorage.removeItem('auth_token');
            router.push('/');
        }
        return Promise.reject(error);
    }
);

export default axios;
