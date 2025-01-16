<template>
    <div class="course-list-page">
      <div class="header">
        <h1>Course Listings</h1>
        <button class="create-button" @click="createCourse">+ Create New Course</button>
      </div>
  
      <table class="course-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Instructor</th>
            <th>Categories</th>
            <th>Duration</th>
            <th>Language</th>
            <th>Rating</th>
            <th>Release Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="courses.length === 0">
            <td colspan="9" class="no-data">Loading Courses...</td>
          </tr>
          <tr v-for="(course, index) in courses" :key="course.id">
            <td>{{ index + 1 }}</td>
            <td>{{ course.title }}</td>
            <td>{{ course.instructor }}</td>
            <td>
              <ul>
                <li v-for="category in course.categories" :key="category">{{ category }}</li>
              </ul>
            </td>
            <td>{{ course.duration }}</td>
            <td>{{ course.language }}</td>
            <td>{{ course.rating }}</td>
            <td>{{ course.release_date }}</td>
            <td class="action-buttons">
              <button class="edit-button" @click="editCourse(course.id)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="delete-button" @click="deleteCourse(course.id)">
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
    name: "CourseList",
    data() {
      return {
        courses: [],
      };
    },
    methods: {
      async fetchCourses() {
        try {
          const response = await fetch("/courses.json"); // Adjust the path if needed
          const data = await response.json();
          this.courses = data;
        } catch (error) {
          console.error("Error loading courses:", error);
        }
      },
      createCourse() {
        this.$router.push({ name: "AddCourse" });
      },
      editCourse(id) {
        this.$router.push({ name: "EditCourse", params: { id } });
      },
      deleteCourse(id) {
        const confirmDelete = confirm("Are you sure you want to delete this course?");
        if (confirmDelete) {
          this.courses = this.courses.filter((course) => course.id !== id);
          alert(`Course with ID: ${id} has been deleted.`);
        }
      },
    },
    mounted() {
      this.fetchCourses();
    },
  };
  </script>
  
  <style scoped>
  .course-list-page {
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
  
  .course-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  .course-table th,
  .course-table td {
    border: 1px solid #333333;
    padding: 10px;
    text-align: left;
  }
  
  .course-table th {
    background-color: #333333;
    color: #ffffff;
    font-size: 16px;
  }
  
  .course-table tr:nth-child(even) {
    background-color: #2a2a2a;
  }
  
  .course-table tr:nth-child(odd) {
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
  