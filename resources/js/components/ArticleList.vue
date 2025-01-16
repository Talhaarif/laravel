<template>
    <div class="meal-list-page">
      <div class="header">
        <h1>Meal Listings</h1>
        <button class="create-button" @click="createMeal">+ Create New Meal</button>
      </div>
  
      <table class="meal-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Chef</th>
            <th>Preparation Time</th>
            <th>Cuisine</th>
            <th>Calories</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="meals.length === 0">
            <td colspan="8" class="no-data">Loading Meals...</td>
          </tr>
          <tr v-for="(meal, index) in meals" :key="meal.id">
            <td>{{ index + 1 }}</td>
            <td>{{ meal.title }}</td>
            <td>{{ meal.chef_name }}</td>
            <td>{{ meal.duration }}</td>
            <td>{{ meal.cuisine }}</td>
            <td>{{ meal.module }}</td>
            <td class="action-buttons">
              <button class="edit-button" @click="editMeal(meal.id)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="delete-button" @click="deleteMeal(meal.id)">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: "MealList",
    data() {
      return {
        meals: [],
        token: '',
      };
    },
    methods: {
      async fetchMeals() {
        this.token = localStorage.getItem('auth_token');
        try {
          const response = await fetch("http://127.0.0.1:8000/api/meals", {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
              Authorization: `Bearer ${this.token}`, // Use `this.token` here
            },
          });

          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }

          const data = await response.json();
          this.meals = data.meals || []; // Adjusted to use `meals` from API response
        } catch (error) {
          console.error("Error loading meals:", error);
        }
      },
      createMeal() {
        this.$router.push({ name: "AddMeal" }); // Navigate to Create Meal page
      },
      editMeal(id) {
        this.$router.push({ name: "EditMeal", params: { id } }); // Navigate to Edit Meal page with ID
      },
      deleteMeal(id) {
        const confirmDelete = confirm("Are you sure you want to delete this meal?");
        if (confirmDelete) {
          // Use the stored token here for the DELETE request
          fetch(`http://127.0.0.1:8000/api/meals/${id}`, {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
              Authorization: `Bearer ${this.token}`, // Use `this.token` here
            },
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }
              // Filter out the deleted meal from the local list
              this.meals = this.meals.filter((meal) => meal.id !== id);
              alert(`Meal with ID: ${id} has been deleted.`);
            })
            .catch((error) => {
              console.error("Error deleting meal:", error);
            });
        }
      },
    },
    mounted() {
      this.fetchMeals(); // Fetch meals when component is mounted
    },
  };
</script>

  
  <style scoped>
  .meal-list-page {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    background-color: #1e1e1e;
    color: #ffffff;
  }
  
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  h1 {
    margin: 0;
    font-size: 24px;
  }
  
  .create-button {
    background-color: #6ce5c9;
    color: #000;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .create-button:hover {
    background-color: #58d0b1;
  }
  
  .meal-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  .meal-table th,
  .meal-table td {
    border: 1px solid #333333;
    padding: 10px;
    text-align: left;
  }
  
  .meal-table th {
    background-color: #333333;
    color: #ffffff;
    font-size: 16px;
  }
  
  .meal-table tr:nth-child(even) {
    background-color: #2a2a2a;
  }
  
  .meal-table tr:nth-child(odd) {
    background-color: #252525;
  }
  
  ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }
  
  .action-buttons {
    display: flex;
    gap: 10px;
  }
  
  .edit-button,
  .delete-button {
    border: none;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .edit-button {
    background-color: #4fc3f7;
    color: #000;
  }
  
  .edit-button:hover {
    background-color: #3fb1e4;
  }
  
  .delete-button {
    background-color: #ff6b6b;
    color: #000;
  }
  
  .delete-button:hover {
    background-color: #e65a5a;
  }
  
  .no-data {
    text-align: center;
    font-size: 16px;
    color: #ccc;
    font-style: italic;
  }
  </style>
  