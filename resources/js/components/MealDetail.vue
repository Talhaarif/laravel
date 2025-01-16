<template>
    <div class="meal-detail-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">Meal > {{ mealsData.category }}</div>

        <!-- Course Header -->
        <div class="meal-header">
            <div class="meal-image">
                <img :src="mealsData.image" :alt="mealsData.title">
            </div>
            <div class="meal-info">
                <div class="meal-meta">
                    <span class="rating">⭐ {{ mealsData.rating }}</span>
                    <span class="duration">⏰ {{ mealsData.duration }}</span>
                </div>
                <h2 class="meal-title">{{ mealsData.title }}</h2>
                <p>{{ mealsData.description }}</p>
                <div class="meal-progress">{{ mealsData.progress }} assignment complete</div>
                <button class="enroll-button">Start Now</button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
                Information
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <h2 class="sub-title">Overview</h2>
                <p class="overview-para">{{ mealsData.overview }}</p>
                <h3 class="sub-title">Chef</h3>
                <div class="instructor-info">
                    <img :src="mealsData.admin_image" :alt="mealsData.admin_name">
                    <div>
                        <h3>{{ mealsData.admin_name }}</h3>
                        <p>{{ mealsData.admin_role }}</p>
                    </div>
                </div>
                <h2 class="sub-title">Meal Details</h2>
                <div class="meal-details">
                    <p><strong>Language:</strong> {{ mealsData.language }}</p>
                    <p><strong>Kcal:</strong> {{ mealsData.modules }} kcal</p>
                </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'MealDetail',
  data() {
    return {
      MealDetails: null,
      mealsData: {}, 
      loading: true, // Loading state
      token: '', // Store token in data
    };
  },
  async created() {
    const MealSlug = this.$route.params.slug; // Get the slug from the route
    this.token = localStorage.getItem('auth_token'); // Retrieve the token from localStorage

    if (!this.token) {
      console.error('No token found. Please log in again.');
      return;
    }

    try {
      const response = await fetch(`http://127.0.0.1:8000/api/meals/${MealSlug}`, {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${this.token}`, // Use the token from the component's data
          'Content-Type': 'application/json', // Optional: specify content type
        },
      });

      if (!response.ok) throw new Error('Failed to fetch details');

      this.MealDetails = await response.json(); // Save the API response to data
      this.mealsData = this.MealDetails.meal || {}; // Use fallback to avoid undefined
      console.log('Fetched Meal Details:', this.mealsData); // Show data in the console
    } catch (error) {
      console.error('Error:', error); // Log any errors
    } finally {
      this.loading = false; // Set loading to false
    }
  },
};
</script>



<style scoped>
.meal-detail-container {
    color: #fff;
    background-color: rgba(31, 38, 37, 1);
    padding: 20px;
}

.breadcrumb {
    font-size: 14px;
    color: #bbb;
    margin-bottom: 20px;
}

.meal-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
}

.overview-para {
    margin-bottom: 32px;
}

.meal-header {
    display: flex;
    gap: 28px;
    border-radius: 16px;
}

.meal-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
}

.meal-info {
    flex-basis: 40%;
}

.meal-image {
    flex-basis: 60%;
}

.meal-info h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.meal-meta {
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

.meal-info p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 8px;
    color: rgba(209, 213, 219, 1);
}

.meal-progress {
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

.meal-details p {
    margin: 5px 0;
}
</style>