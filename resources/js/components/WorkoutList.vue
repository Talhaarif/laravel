<template>
    <div class="workout-list-page">
      <div class="header">
        <h1>Workout Listings</h1>
        <button class="create-button" @click="createWorkout">+ Create New Workout</button>
      </div>
  
      <table class="workout-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Calories</th>
            <th>Overview</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="workouts.length === 0">
            <td colspan="6" class="no-data">Loading Workouts...</td>
          </tr>
          <tr v-for="(workout, index) in workouts" :key="workout.id">
            <td>{{ index + 1 }}</td>
            <td>{{ workout.title }}</td>
            <td>{{ workout.duration }}</td>
            <td>{{ workout.kcal }}</td>
            <td>{{ workout.overview }}</td>
            <td class="action-buttons">
              <button class="edit-button" @click="editWorkout(workout.id)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="delete-button" @click="deleteWorkout(workout.id)">
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
    name: "workoutList",
    data() {
      return {
        workouts: [],
        token: '',
      };
    },
    methods: {
      async fetchworkouts() {
        this.token = localStorage.getItem('auth_token');
        try {
          const response = await fetch("http://127.0.0.1:8000/api/workouts", {
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
          this.workouts = data.workouts || []; // Adjusted to use `workouts` from API response
        } catch (error) {
          console.error("Error loading workouts:", error);
        }
      },
      createworkout() {
        this.$router.push({ name: "AddWorkout" }); // Navigate to Create workout page
      },
      editworkout(id) {
        this.$router.push({ name: "WorkoutEdit", params: { id } }); // Navigate to Edit workout page with ID
      },
      deleteworkout(id) {
        const confirmDelete = confirm("Are you sure you want to delete this workout?");
        if (confirmDelete) {
          // Use the stored token here for the DELETE request
          fetch(`http://127.0.0.1:8000/api/workouts/${id}`, {
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
              // Filter out the deleted workout from the local list
              this.workouts = this.workouts.filter((workout) => workout.id !== id);
              alert(`workout with ID: ${id} has been deleted.`);
            })
            .catch((error) => {
              console.error("Error deleting workout:", error);
            });
        }
      },
    },
    mounted() {
      this.fetchworkouts(); // Fetch workouts when component is mounted
    },
  };
</script>

  
  <style scoped>
  .workout-list-page {
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
  
  .workout-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  .workout-table th,
  .workout-table td {
    border: 1px solid #333333;
    padding: 10px;
    text-align: left;
  }
  
  .workout-table th {
    background-color: #333333;
    color: #ffffff;
    font-size: 16px;
  }
  
  .workout-table tr:nth-child(even) {
    background-color: #2a2a2a;
  }
  
  .workout-table tr:nth-child(odd) {
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
  