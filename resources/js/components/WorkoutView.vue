<template lang="">
    <div>
        <div class="heading-and-btn">
            <h2 class="title-one">Workouts</h2>
        <router-link to="/dashboard/workouts-list" class="register-link share-btn">Manage workouts</router-link>
        </div>
        <div class="courses-main-div">
            <div class="recent-courses courses-row">
                <div class="courses-head">
                    <h3>Chest Workouts</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    
                </div>
            </div>
            <div class="featured-courses courses-row">
                <div class="courses-head">
                    <h3>Bicep Workouts</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <WorkoutCard
                    v-for="data in bicep"
                    :key="data.id"
                    :image="data.featureImg"
                    :title="data.title"
                    :description="data.discription"
                    @readMore="navigateToDetails(data.slug)"
                    />
                    
                </div>
            </div>
            <div class="best-courses courses-row">
                <div class="courses-head">
                    <h3>Tricep Workouts</h3>
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
<script>
import axios from 'axios';
import WorkoutCard from './WorkoutCard.vue';

export default {
  components: {
    WorkoutCard,
  },
  data() {
    return {
      RecentData: [],
      loading: true,
      error: null,
      token: '',

      chest: [
        {
          id: 1,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
        {
          id: 2,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
        {
          id: 3,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
      ],
      bicep: [
        {
          id: 1,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
        {
          id: 2,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
        {
          id: 3,
          featureImg: "/images/dish-vid.png",
          review: "4.0",
          videoTime: "15:00",
          kcal: "12kcal",
          title: "Spicy Chicken Tacos",
          discription: "Zesty chicken with fresh salsa and avocado",
        },
      ],
    
    };
    
  },
  created() {
        // Retrieve data from localStorage when the component is created
        this.token = localStorage.getItem('auth_token');
    },
  mounted() {
    this.fetchData(); // Correct method invocation
  },
  name: 'MealDetail',
  computed: {
    slug() {
      return this.$route.params.slug;
    }
  },
  methods: {
    navigateToDetails(slug) {
    console.log('Navigating to:', { name: 'MealDetail', params: { slug } });
    this.$router.push(`Meal-deatil/${slug}`);
  },
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/meals/recent', {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
        this.RecentData = response.data.meals;
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