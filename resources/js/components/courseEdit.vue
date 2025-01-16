<template>
    <div class="course-edit-container">
        <h2>Edit Course</h2>
        <form @submit.prevent="editCourse">
            <div class="form-row">
                <div class="form-group">
                <label for="category">Category</label>
                <input id="category" v-model="course.category" type="text" required />
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" v-model="course.title" type="text" required />
            </div>
            </div>
           
            <div class="form-group">
                <label for="image">Image URL</label>
                <input id="image" v-model="course.image" type="text" required />
            </div>
            <div class="form-row">
                <div class="form-group">
                <label for="rating">Rating</label>
                <input id="rating" v-model="course.rating" type="number" step="0.1" min="0" max="5" required />
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input id="duration" v-model="course.duration" type="text" required />
            </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" v-model="course.description" required></textarea>
            </div>
            <div class="form-row"></div>
            <div class="form-row">
                <div class="form-group">
                <label for="language">Language</label>
                <input id="language" v-model="course.language" type="text" required />
            </div>
            <div class="form-group">
                <label for="modules">Modules</label>
                <input id="modules" v-model="course.modules" type="number" min="0" required />
            </div>
            </div>
            
            <div class="form-group">
                <label for="overview">Overview</label>
                <textarea id="overview" v-model="course.overview" required></textarea>
            </div>
            <h2>Chef Details</h2>
            <div class="form-row">
                <div class="form-group">
                <label for="adminName">Admin Name</label>
                <input id="adminName" v-model="course.admin_name" type="text" required />
            </div>
            <div class="form-group">
                <label for="adminRole">Admin Role</label>
                <input id="adminRole" v-model="course.admin_role" type="text" required />
            </div>
            </div>
           
            <div class="form-group">
                <label for="adminImage">Admin Image URL</label>
                <input id="adminImage" v-model="course.admin_image" type="text" required />
            </div>
            <button type="submit">Update Course</button>
        </form>
    </div>
  </template>
  
  <script>
  export default {
    props: ['course'],
    data() {
      return {
        course: {
          category: '',
          title: '',
          image: '',
          rating: null,
          duration: '',
          description: '',
          overview: '',
          language: '',
          modules: null,
          admin_name: '',
          admin_role: '',
          admin_image: '',
        },
        token: '',
      };
    },
    created() {
      this.token = localStorage.getItem('auth_token'); // Fetch the token when the component is created
      this.fetchCourseData();
    },
    methods: {
      async fetchCourseData() {
        const courseId = this.$route.params.id;
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/courses/${courseId}`, {
            method: 'GET',
            headers: { Authorization: `Bearer ${this.token}` }, // Pass the token correctly
          });
          if (!response.ok) throw new Error('Failed to fetch course data.');
          const data = await response.json();
          this.course = { ...data };
        } catch (error) {
          alert('Failed to load course data.');
        }
      },
      async editCourse() {
        const courseId = this.$route.params.id;
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/courses/${courseId}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
              Authorization: `Bearer ${this.token}`, // Use the token from the data property
            },
            body: JSON.stringify(this.course),
          });
          if (!response.ok) throw new Error('Failed to update the course.');
          alert('Course updated successfully!');
          this.$router.push('/dashboard/courses-list');
        } catch (error) {
          alert('Failed to update the course.');
        }
      },
    },
  };
  </script>
  
  
  
  
    
    <style scoped>
    .course-edit-container {
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
    