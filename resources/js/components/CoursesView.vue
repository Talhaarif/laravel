<template lang="">
    <div>
        <div class="heading-and-btn">
            <h2 class="title-one">Courses</h2>
        <router-link to="courses-list" class="register-link share-btn">Manage Courses</router-link>
        </div>
        
        <div class="courses-main-div">
            <div class="recent-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <CourseCardView 
                    v-for="course in RecentData"
                    :key="course.id"
                    :featureImg="course.image"
                    :title="course.title"
                    :admin_name="course.admin_name"
                    :adminImg="course.admin_image"
                    :admin_role="course.admin_role"
                    @readMore="navigateToDetails(course.slug)"
                    />
                </div>
            </div>
            <div class="featured-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                </div>
            </div>
            <div class="best-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
               
                </div>
            </div>
        </div>
    </div>
</template>
<!-- <script>
import CourseCardView from './CourseCardView.vue';

export default {
    components: {
        CourseCardView,
    },
    data() {
        return {
            recentCourses: [
                {
                    id:1,
                    title: "UI/UX Design Essentials",
                    admin: "Alima Jazan",
                    date: "Sep 23, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {   id:2,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
            featuredCourses: [
                {
                    id:1,
                    title: "Advanced CSS Techniques",
                    admin: "Jane Smith",
                    date: "Jul 10, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:2,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
            bestCourses: [
                {
                    id:1,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:2,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
        };
    },
}
</script> -->

<script>
import axios from 'axios';
import CourseCardView from './CourseCardView.vue';

export default {
  components: {
    CourseCardView,
  },
  data() {
    return {
      RecentData: [],
      loading: true,
      error: null,
      token: '',
    };
    
  },
  created() {
        // Retrieve data from localStorage when the component is created
        this.token = localStorage.getItem('auth_token');
    },
  mounted() {
    this.fetchData(); // Correct method invocation
  },
  name: 'DetailCourse',
  computed: {
    slug() {
      return this.$route.params.slug;
    }
  },
  methods: {
    navigateToDetails(slug) {
    console.log('Navigating to:', { name: 'DetailCourse', params: { slug } });
    this.$router.push(`courses-details/${slug}`);
  },
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/courses', {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
        this.RecentData = response.data.courses;
        console.log(this.RecentData); // Logs the fetched array to the console
      } catch (err) {
        this.error = 'Failed to fetch data.';
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
<style scoped>
.courses-row{
    border-radius: 16px;
    background-color: #2b2b2b;
    margin-bottom: 24px;
    padding: 20px;
}
.courses-head{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    color: white;
}
.courses-head h3{
    font-size: 20px;
}
.courses-head select{
    background-color: #363f3a;
    padding: 9px 12px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
}
.course-list {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
}
</style>