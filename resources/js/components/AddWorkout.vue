<template>
  <div class="workout-add-container">
    <h2>Add Workout Details</h2>
    <form @submit.prevent="addWorkout">
      <div class="form-row">
        <div class="form-group">
          <label for="title">Workout Title</label>
          <input id="title" v-model="newWorkout.title" type="text" placeholder="Enter title" required />
        </div>
        <div class="form-group">
          <label for="cal">Calories</label>
          <input id="cal" v-model="newWorkout.cal" type="number" placeholder="Enter calories" required />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="duration">Duration</label>
          <input id="duration" v-model="newWorkout.duration" type="text" placeholder="Enter duration" required />
        </div>
        <div class="form-group">
          <label for="kcal">Estimated Kcal</label>
          <input id="kcal" v-model="newWorkout.kcal" type="number" placeholder="Enter estimated Kcal" required />
        </div>
      </div>
      <div class="form-group">
        <label for="description">Workout Description</label>
        <textarea id="description" v-model="newWorkout.description" placeholder="Enter description" required></textarea>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="image">Workout Image URL</label>
          <input id="image" v-model="newWorkout.image" type="url" placeholder="Enter image URL" required />
        </div>
        <div class="form-group">
          <label for="category">Workout Category</label>
          <select id="category" v-model="newWorkout.category" required>
            <option value="" disabled>Select category</option>
            <option value="bicep">Bicep</option>
            <option value="tricep">Tricep</option>
            <option value="chest">Chest</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="overview">Workout Overview</label>
        <textarea id="overview" v-model="newWorkout.overview" placeholder="Enter overview" required></textarea>
      </div>
      <button type="submit">Add Workout</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newWorkout: {
        image: '',
        title: '',
        description: '',
        cal: '',
        duration: '',
        overview: '',
        kcal: '',
        category: '',
      },
      token: '',
    };
  },
  methods: {
    async addWorkout() {
      try {
        if (!this.newWorkout.title || !this.newWorkout.description) {
          alert('Please fill in all required fields.');
          return;
        }

        this.token = localStorage.getItem('auth_token');
        if (!this.token) {
          throw new Error('No token found. Please log in again.');
        }

        const workoutData = {
          ...this.newWorkout,
          created_at: new Date().toISOString(),
          updated_at: new Date().toISOString(),
        };

        console.log('Sending data:', workoutData);

        const response = await fetch(`http://127.0.0.1:8000/api/workouts`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${this.token}`,
          },
          body: JSON.stringify(workoutData),
        });

        const result = await response.json();
        if (!response.ok) {
          console.error('API Error:', result);
          throw new Error(result.message || 'Failed to add the workout.');
        }

        alert('Workout added successfully!');
        this.$router.push('/dashboard/workouts-list');
      } catch (error) {
        console.error('Error adding workout:', error);
        alert(error.message || 'An error occurred while adding the workout.');
      }
    },
  },
};
</script>
 
  <style scoped>
  .workout-add-container {
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
  textarea,
  select {
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
  