<template>
    <div class="workout-edit-container">
      <h2>Edit Workout</h2>
      <form @submit.prevent="editWorkout">
        <div class="form-group">
          <label for="title">Title</label>
          <input id="title" v-model="workout.title" type="text" required />
        </div>
        <div class="form-group">
          <label for="duration">Duration</label>
          <input id="duration" v-model="workout.duration" type="text" required />
        </div>
        <div class="form-group">
          <label for="cal">Calories</label>
          <input id="cal" v-model="workout.cal" type="number" min="0" required />
        </div>
        <div class="form-group">
          <label for="kcal">Kcal</label>
          <input id="kcal" v-model="workout.kcal" type="number" min="0" required />
        </div>
        <div class="form-group">
          <label for="overview">Overview</label>
          <textarea id="overview" v-model="workout.overview" required></textarea>
        </div>
        <button type="submit">Update Workout</button>
      </form>
    </div>
  </template>
  
  
  
    <style scoped>
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
    