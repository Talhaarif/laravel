<template>
  <div class="workout-edit-container">
    <h2>Edit Workout Details</h2>
    <form @submit.prevent="updateWorkout">
      <div class="form-row">
        <div class="form-group">
          <label for="title">Workout Title</label>
          <input id="title" v-model="editedWorkout.title" type="text" placeholder="Enter title" required />
        </div>
        <div class="form-group">
          <label for="cal">Calories</label>
          <input id="cal" v-model="editedWorkout.cal" type="text" placeholder="Enter calories" required />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="duration">Duration</label>
          <input id="duration" v-model="editedWorkout.duration" type="text" placeholder="Enter duration" required />
        </div>
        <div class="form-group">
          <label for="kcal">Estimated Kcal</label>
          <input id="kcal" v-model="editedWorkout.kcal" type="text" placeholder="Enter estimated Kcal" required />
        </div>
      </div>
      <div class="form-group">
        <label for="description">Workout Description</label>
        <textarea id="description" v-model="editedWorkout.description" placeholder="Enter description" required></textarea>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="image">Workout Image URL</label>
          <input id="image" v-model="editedWorkout.image" type="text" placeholder="Enter image URL" required />
        </div>
        <div class="form-group">
          <label for="category">Workout Category</label>
          <select id="category" v-model="editedWorkout.category" required>
            <option value="" disabled>Select category</option>
            <option value="bicep">Bicep</option>
            <option value="tricep">Tricep</option>
            <option value="chest">Chest</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="overview">Workout Overview</label>
        <textarea id="overview" v-model="editedWorkout.overview" placeholder="Enter overview" required></textarea>
      </div>
      <button type="submit">Update Workout</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editedWorkout: {
        id: '', // Assume the workout ID is being passed to identify the record.
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
  created() {
    // Fetch the workout details to edit when the component is loaded
    this.getWorkoutDetails();
  },
  methods: {
    async getWorkoutDetails() {
      try {
        this.token = localStorage.getItem('auth_token');
        if (!this.token) throw new Error('No token found. Please log in again.');

        const workoutId = this.$route.params.id; // Assuming workout ID is passed in the route
        const response = await fetch(`http://127.0.0.1:8000/api/workouts/${workoutId}`, {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });

        if (!response.ok) throw new Error('Failed to fetch workout details.');

        const workoutData = await response.json();
        this.editedWorkout = { ...workoutData }; // Populate the form with existing data
      } catch (error) {
        console.error('Error fetching workout details:', error);
        alert(`Error: ${error.message}`);
      }
    },
    async updateWorkout() {
      try {
        if (!this.editedWorkout) throw new Error('Workout object is not initialized.');

        this.token = localStorage.getItem('auth_token');
        if (!this.token) throw new Error('No token found. Please log in again.');

        const response = await fetch(`http://127.0.0.1:8000/api/workouts/${this.editedWorkout.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${this.token}`,
          },
          body: JSON.stringify(this.editedWorkout),
        });

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Failed to update the workout.');
        }

        alert('Workout updated successfully!');
        this.$router.push('/dashboard/workouts-list'); // Redirect to workout list page
      } catch (error) {
        console.error('Error updating workout:', error);
        alert(`Failed to update the workout. ${error.message}`);
      }
    },
  },
};
</script>

<style scoped>
/* Styles are the same as the previous container */
.workout-edit-container {
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
textarea:focus,
select:focus {
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
