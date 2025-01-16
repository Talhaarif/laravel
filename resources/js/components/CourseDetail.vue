<template>
    <div class="course-detail-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">Courses > {{ CompleteData.category }}</div>

        <!-- Course Header -->
        <div class="course-header">
            <div class="course-image">
                <img class="single-feature-img" :src="CompleteData.image" :alt="CompleteData.title">
            </div>
            <div class="course-info">
                <div class="course-meta">
                    <span class="rating">⭐ {{ CompleteData.rating }}</span>
                    <span class="duration">⏰ {{ CompleteData.duration }}</span>
                </div>
                <h2 class="course-title">{{ CompleteData.title }}</h2>
                <p>{{ CompleteData.description }}</p>
                <div class="course-progress">{{ CompleteData.progress }} assignment complete</div>
                <button class="enroll-button">Enroll Now</button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab" :class="{ active: activeTab === 'Information' }" @click="setActiveTab('Information')">
                Information
            </button>
            <button class="tab" :class="{ active: activeTab === 'Curriculum' }" @click="setActiveTab('Curriculum')">
                Curriculum
            </button>
            <button class="tab" :class="{ active: activeTab === 'Questions' }" @click="setActiveTab('Questions')">
                Questions
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div v-if="activeTab === 'Information'">
                <h2 class="sub-title">Overview</h2>
                <p class="overview-para">{{ CompleteData.overview }}</p>
                <h3 class="sub-title">Instructor</h3>
                <div class="instructor-info">
                    <img :src="CompleteData.admin_image" :alt="CompleteData.admin_image">
                    <div>
                        <h3>{{ CompleteData.admin_name }}</h3>
                        <p>{{ CompleteData.admin_role }}</p>
                    </div>
                </div>
                <h2 class="sub-title">Course Details</h2>
                <div class="course-details">
                    <p><strong>Language:</strong> {{ CompleteData.language }}</p>
                    <p><strong>Modules:</strong> {{ CompleteData.modules }} Total</p>
                </div>
            </div>
            <div v-else-if="activeTab === 'Curriculum'">
                <h2>Curriculum</h2>
                <p>Details about the course curriculum will go here.</p>
            </div>
            <div v-else-if="activeTab === 'Questions'">
                <h2>Questions</h2>
                <p>FAQs and student questions will be displayed here.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'DetailCourse',
  name: 'CourseTabs',
  data() {
    return {
        activeTab: 'Information',
      CourseDetails: null, // Holds the full course details
      CompleteData: {}, // Extracted data for the course
      loading: true, // Loading state for the API call
      token: '', // Token retrieved from localStorage
      error: null, // To handle and display error messages
    };
  },
  async created() {
    // Get the slug from the route parameters
    const CourseSlug = this.$route.params.slug;

    // Retrieve the token from localStorage
    this.token = localStorage.getItem('auth_token');

    // If token is missing, log an error and stop execution
    if (!this.token) {
      this.error = 'No authentication token found. Please log in again.';
      console.error(this.error);
      return;
    }

    try {
      // Make the API request to fetch course details
      const response = await fetch(`http://127.0.0.1:8000/api/courses/${CourseSlug}`, {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${this.token}`, // Include the token in the headers
          'Content-Type': 'application/json', // Specify content type
        },
      });

      // Check if the response status is not OK
      if (!response.ok) {
        throw new Error(`Failed to fetch details: ${response.statusText}`);
      }

      // Parse the JSON response
      const data = await response.json();

      // Set the retrieved course details to the component's data
      this.CourseDetails = data;
      this.CompleteData = data.course || {}; // Use fallback to handle undefined values

      // Debugging: Log the fetched data
      console.log('Fetched course details:', this.CompleteData);
    } catch (error) {
      // Handle and display any errors
      this.error = error.message || 'An unknown error occurred.';
      console.error('Error:', error);
    } finally {
      // Stop the loading indicator
      this.loading = false;
    }
  },
  methods: {
    setActiveTab(tab) {
      this.activeTab = tab;
    },
  },
};
</script>


<style scoped>
.course-detail-container {
    color: #fff;
    background-color: rgba(31, 38, 37, 1);
    padding: 20px;
}

.breadcrumb {
    font-size: 14px;
    color: #bbb;
    margin-bottom: 20px;
}

.course-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
}

.overview-para {
    margin-bottom: 32px;
}

.course-header {
    display: flex;
    gap: 28px;
    border-radius: 16px;
}

.course-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
}

.course-info {
    flex-basis: 40%;
}

.course-image {
    flex-basis: 60%;
}

.course-info h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.course-meta {
    display: flex;
    gap: 10px;
    font-size: 16px;
    color: #fff;
    margin-bottom: 8px;
    background-color: #000;
    width: fit-content;
    padding: 8px 20px;
    border-radius: 16px;
}

.course-info p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 8px;
    color: rgba(209, 213, 219, 1);
}

.course-progress {
    color: #fff;
    font-size: 14px;
    margin-bottom: 20px;
}

.enroll-button {
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: #000;
    border: none;
    width: 100%;
    border-radius: 12px;
    cursor: pointer;
}

.tabs {
    display: flex;
    gap: 10px;
    margin: 40px 0;
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
}

.tab {
    padding: 10px 20px;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 20px;

}

.tab.active {
    font-weight: 600;
    border-bottom: 2px solid var(--primary-color);
}

.sub-title {
    margin-bottom: 16px;
    font-size: 20px;
}

.tab-content p {
    line-height: 1.6;
    font-size: 16px;
}

.instructor-info {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
}

.instructor-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.course-details p {
    margin: 5px 0;
}
</style>