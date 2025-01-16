<template>
  <div class="add-course-container">
    <h2>Add New Course</h2>
    <form @submit.prevent="addCourse">
      <div class="form-row">
        <!-- Course Title -->
        <div class="form-group">
          <label for="title">Course Title</label>
          <input type="text" v-model="newCourse.title" id="title" placeholder="Enter course title" required />
        </div>

        <!-- Instructor -->
        <div class="form-group">
          <label for="instructor">Instructor</label>
          <input type="text" v-model="newCourse.instructor" id="instructor" placeholder="Enter instructor name" required />
        </div>
      </div>

      <div class="form-row">
        <!-- Featured Image -->
        <div class="form-group">
          <label for="image">Featured Image URL</label>
          <input type="text" v-model="newCourse.image" id="image" placeholder="Enter image URL" required />
        </div>

        <!-- Number of Assignments -->
        <div class="form-group">
          <label for="num_assignment">Number of Assignments</label>
          <input type="number" v-model="newCourse.num_assignment" id="num_assignment" min="0" required />
        </div>
      </div>

      <!-- Course Description -->
      <div class="form-group">
        <label for="description">Course Description</label>
        <textarea v-model="newCourse.description" id="description" rows="3" placeholder="Enter course description" required></textarea>
      </div>

      <div class="form-row">
        <!-- Modules -->
        <div class="form-group">
          <label for="modules">Modules</label>
          <input type="number" v-model="newCourse.modules" id="modules" min="1" required />
        </div>

        <!-- Duration -->
        <div class="form-group">
          <label for="duration">Duration (hours)</label>
          <input type="number" v-model="newCourse.duration" id="duration" min="1" placeholder="Enter duration" required />
        </div>
      </div>

      <div class="form-row">
        <!-- Language -->
        <div class="form-group">
          <label for="language">Language</label>
          <input type="text" v-model="newCourse.language" id="language" placeholder="Enter language" required />
        </div>

        <!-- Rating -->
        <div class="form-group">
          <label for="rating">Rating</label>
          <input type="number" v-model="newCourse.rating" id="rating" min="0" max="5" step="0.1" placeholder="Enter rating (0-5)" required />
        </div>
      </div>

      <!-- Overview -->
      <div class="form-group">
        <label for="overview">Overview</label>
        <textarea v-model="newCourse.overview" id="overview" rows="3" placeholder="Write a short overview of the course" required></textarea>
      </div>

      <!-- Submit Button -->
      <div class="form-actions">
        <button type="submit" class="btn-submit">Add Course</button>
        <button type="button" class="btn-cancel" @click="cancelAdd">Cancel</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newCourse: {
        title: "",
        image: "",
        instructor: "",
        num_assignment: "",
        description: "",
        modules: "",
        duration: "",
        language: "",
        rating: "",
        overview: "",
      },
    };
  },
  methods: {
    addCourse() {
      if (this.validateForm()) {
        // Emit or handle the new course addition logic
        console.log("New Course:", this.newCourse);
        alert("Course added successfully!");
      } else {
        alert("Please fill out all required fields.");
      }
    },
    cancelAdd() {
      // Reset or navigate away
      this.newCourse = {
        title: "",
        image: "",
        instructor: "",
        num_assignment: "",
        description: "",
        modules: "",
        duration: "",
        language: "",
        rating: "",
        overview: "",
      };
      alert("Course addition cancelled.");
    },
    validateForm() {
      return (
        this.newCourse.title &&
        this.newCourse.image &&
        this.newCourse.instructor &&
        this.newCourse.num_assignment &&
        this.newCourse.description &&
        this.newCourse.modules &&
        this.newCourse.duration > 0 &&
        this.newCourse.language &&
        this.newCourse.rating >= 0 &&
        this.newCourse.rating <= 5 &&
        this.newCourse.overview
      );
    },
  },
};
</script>

<style scoped>
/* Add styling similar to Edit Course */
.add-course-container {
  max-width: 900px;
  padding: 20px;
  background: #1f2625;
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
textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #444;
  border-radius: 5px;
  font-size: 14px;
  background-color: #222;
  color: #6ce5c9;
}

input:focus,
textarea:focus {
  outline: none;
  border-color: #6ce5c9;
  box-shadow: 0 0 4px rgba(153, 247, 227, 0.5);
}

button {
  background-color: #6ce5c9;
  color: #000;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #7cd9c8;
}

.form-actions {
  display: flex;
  justify-content: space-between;
}
</style>
