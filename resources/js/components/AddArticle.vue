<template>
    <div class="meal-add-container">
        <h2>Add New Meal</h2>
        <form @submit.prevent="addMeal">
          <div class="form-row">
            <div class="form-group">
                <label for="category">Category</label>
                <input id="category" v-model="NewMeal.category" type="text" placeholder="Enter category" required />
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" v-model="NewMeal.title" type="text" placeholder="Enter title" required />
            </div>
          </div>
            <div class="form-group">
                <label for="image">Image URL</label>
                <input id="image" v-model="NewMeal.image" type="text" placeholder="Enter image URL" required />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="rating">Rating</label>
                <input id="rating" v-model="NewMeal.rating" type="number" step="0.1" min="0" max="5" placeholder="Enter rating" required />
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input id="duration" v-model="NewMeal.duration" type="text" placeholder="Enter duration" required />
            </div>
            </div>
           
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" v-model="NewMeal.description" placeholder="Enter description" required></textarea>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="language">Language</label>
                <input id="language" v-model="NewMeal.language" type="text" placeholder="Enter language" required />
            </div>
            <div class="form-group">
                <label for="modules">Modules</label>
                <input id="modules" v-model="NewMeal.modules" type="number" min="0" placeholder="Enter modules count" required />
            </div>
            </div>
           
            <div class="form-group">
                <label for="overview">Overview</label>
                <textarea id="overview" v-model="NewMeal.overview" placeholder="Enter overview" required></textarea>
            </div>
            <h2>Chef Details</h2>
            <div class="form-row">
              <div class="form-group">
                <label for="adminName">Admin Name</label>
                <input id="adminName" v-model="NewMeal.admin_name" type="text" placeholder="Enter admin name" required />
            </div>
            <div class="form-group">
                <label for="adminRole">Admin Role</label>
                <input id="adminRole" v-model="NewMeal.admin_role" type="text" placeholder="Enter admin role" required />
            </div>
            </div>
           
            <div class="form-group">
                <label for="adminImage">Admin Image URL</label>
                <input id="adminImage" v-model="NewMeal.admin_image" type="text" placeholder="Enter admin image URL" required />
            </div>
            <button type="submit">Add Meal</button>
        </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        NewMeal: {
          category: '',
          title: '',
          image: '',
          rating: '',
          duration: '',
          description: '',
          overview: '',
          language: '',
          modules: '',
          admin_name: '',
          admin_role: '',
          admin_image: '',
        },
        token: '',
      };
    },
    methods: {
      async addMeal() {
        try {
          // Ensure `NewMeal` exists
          if (!this.NewMeal) {
            throw new Error('NewMeal object is not initialized.');
          }
          
          // Get token from localStorage
          this.token = localStorage.getItem('auth_token');
          console.log(this.token);
  
          if (!this.token) {
            throw new Error('No token found. Please log in again.');
          }
  
          // Prepare the new meal data
          const NewMeal = {
            ...this.NewMeal,
            created_at: new Date().toISOString(),
            updated_at: new Date().toISOString(),
          };
  
          // Send the data to the API
          const response = await fetch(`http://127.0.0.1:8000/api/meals`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              Authorization: `Bearer ${this.token}`, // Use `this.token` here
            },
            body: JSON.stringify(NewMeal),
          });
  
          if (!response.ok) {
            const errorData = await response.json(); // Parse error details
            throw new Error(
              errorData.message || 'Failed to add the meal. Please try again.'
            );
          }
  
          alert('Meal added successfully!');
          this.$router.push('/dashboard/meal-list'); // Redirect to the meals list page
        } catch (error) {
          console.error('Error adding meal:', error);
          alert(
            `Failed to add the meal. ${
              error.message || 'Please check your input and try again.'
            }`
          );
        }
      },
    },
  };
  </script>
  
  
  
  
  
  <style scoped>
  .meal-add-container {
    max-width: 900px;
    padding: 20px;
    background: #1F2625;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
  
  h2 {
    font-size: 34px;
    color: #fff;
    margin-bottom: 20px;
  }
  
  h3 {
    margin-top: 30px;
    color: #fff;
    text-decoration: underline;
  }
  
  .form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }
  
  .form-group {
    flex: 1;
    min-width: 300px;
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    font-weight: bold;
    color: #fff;
    margin-bottom: 5px;
  }
  
  input,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--secondary-color);
    border-radius: 5px;
    font-size: 14px;
    background-color: #222;
    color: var(--primary-color);
  }
  
  input:focus,
  textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 4px rgba(153, 247, 227, 0.5);
  }
  
  button {
    background-color: var(--primary-color);
    color: #000;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  button:hover {
    background-color: #7cd9c8;
  }
  </style>
  