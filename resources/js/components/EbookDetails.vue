<template>
  <div class="ebook-details-page">
    <div v-if="loading" class="loading">Loading...</div>
    <div v-else>
      <div class="page-title">
        <h3>eBooks</h3>
      </div>
      <div class="breadcrumb">
        <span>eBook</span> > <span>{{ detailData.title }}</span>
      </div>

      <div class="details-card">
        <div class="card-main">
          <!-- Cover Section -->
          <div class="cover-section">
            <img :src="detailData.image" alt="EBook Cover" class="cover-image" />
            <div class="icons">
              <i class="fas fa-heart"></i>
              <i class="fas fa-share-alt"></i>
            </div>
          </div>

          <!-- Information Section -->
          <div class="info-section">
            <h1 class="title">{{ detailData.title }}</h1>
            <p class="author">{{ detailData.author }}</p>
            <p class="release-date">Released on {{ detailData.release_date }}</p>

            <!-- <div class="genres">
              <span v-for="genre in detailData.genres" :key="genre" class="genre">{{ genre }}</span>
            </div> -->

            <div class="stats">
              <div class="stat">
                <p>Page</p>
                <span>{{ detailData.number_of_pages }}</span>
              </div>
              <div class="stat">
                <p>Language</p>
                <span>{{ detailData.language }}</span>
              </div>
              <div class="stat">
                <p>Rating</p>
                <span>{{ detailData.rating }}</span>
              </div>
            </div>

            <button class="start-button">Start Reading</button>
          </div>
        </div>

        <!-- Overview Section -->
        <div class="overview-section">
          <h2>Overview</h2>
          <p>{{ detailData.overview }}</p>
        </div>

        <!-- Author Section -->
        <div class="instructor-section">
          <h2>Author</h2>
          <div class="instructor-row">
            <img :src="detailData.instructor_profile_image" alt="Author" class="instructor-image" />
            <div class="instructor-info">
              <p class="instructor-name">{{ detailData.author }}</p>
              <p class="instructor-role">Author</p>
            </div>
            <button class="profile-button">View Profile</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: 'EbookDetails',
  data() {
    return {
      bookDetails: null, // Stores the fetched book data
      loading: true, // Loading state
      token: '', // Store token here
    };
  },
  async created() {
    const bookSlug = this.$route.params.slug; // Get the slug from the route
    this.token = localStorage.getItem('auth_token'); // Retrieve the token from localStorage

    if (!this.token) {
      console.error('No token found. Please log in again.');
      return;
    }

    try {
      const response = await fetch(`http://127.0.0.1:8000/api/ebooks/${bookSlug}`, {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${this.token}`, // Use the token from localStorage
          'Content-Type': 'application/json', // Optional: specify content type
        },
      });

      if (!response.ok) throw new Error('Failed to fetch details');
      
      this.bookDetails = await response.json(); // Save the API response to data
      this.detailData = this.bookDetails.ebook; // Save the book details in detailData
      console.log('Fetched Book Details:', this.bookDetails.ebook); // Show data in the console
    } catch (error) {
      console.error('Error:', error); // Log any errors
    } finally {
      this.loading = false; // Set loading to false
    }
  },
};
</script>



<style scoped>
/* Styles for the details page */
.page-title h3 {
  color: #fff;
  font-weight: 600;
  margin-bottom: 20px;
  font-size: 28px;
}

.ebook-details-page {
  background-color: #222222;
  color: #ffffff;
  padding: 20px;
  max-width: 1000px;
  font-family: Arial, sans-serif;
}

.loading {
  text-align: center;
  font-size: 18px;
  color: #ffffff;
}

.breadcrumb {
  color: #6c757d;
  margin-bottom: 20px;
}

.details-card {
  display: flex;
  flex-direction: column;
  background-color: #1f2625;
  border-radius: 10px;
  padding: 20px;
  gap: 20px;
}

.card-main {
  display: flex;
  gap: 20px;
}

.cover-section {
  position: relative;
  flex-shrink: 0;
}

.cover-image {
  width: 450px;
  height: 300px;
  border-radius: 10px;
  object-fit: cover;
}

.icons {
  position: absolute;
  top: 10px;
  right: 10px;
  display: flex;
  gap: 10px;
}

.icons i {
  color: #ffffff;
  font-size: 18px;
  cursor: pointer;
}

.info-section {
  flex: 1;
}

.title {
  font-size: 24px;
  margin: 0 0 10px;
}

.author {
  color: #6ce5c9;
  font-size: 16px;
  margin: 0 0 10px;
}

.release-date {
  font-size: 14px;
  color: #e5e7eb;
  margin-bottom: 10px;
}

.genres {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.genre {
  background-color: #555555;
  color: #ffffff;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
}

.stats {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
  background: #ffffff1f;
  padding: 20px;
  justify-content: space-between;
  border-radius: 10px;
}

.stat {
  text-align: center;
  color: #fff;
  font-size: 14px;
}

.stat span {
  font-size: 18px;
  color: #6ce5c9;
}

.start-button {
  background-color: #6ce5c9;
  color: #000;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 5px;
  width: 100%;
  cursor: pointer;
}

.overview-section {
  margin-top: 30px;
}

.overview-section h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.overview-section p {
  font-size: 16px;
  line-height: 1.5;
  color: #c1c1c1;
}

.instructor-section {
  margin-top: 30px;
}

.instructor-section h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.instructor-row {
  display: flex;
  align-items: center;
  gap: 15px;
}

.instructor-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.instructor-info {
  flex: 1;
}

.instructor-name {
  font-size: 16px;
  font-weight: bold;
  margin: 0;
}

.instructor-role {
  font-size: 14px;
  color: #c1c1c1;
}

.profile-button {
  background-color: #4fc3f7;
  color: #000;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  border-radius: 5px;
  cursor: pointer;
}
</style>




<!-- <template>
  <div class="ebook-details-page">
     <div class="page-title">
        <h3>eBooks</h3>
      </div>
    <div class="breadcrumb">
      <span>eBook</span> > <span>eBook Details</span>
    </div>

    <div class="details-card">
      <div class="card-main">
<div class="cover-section">
        <img src="../../../public/images/cardd.png" alt="EBook Cover" class="cover-image" />
        <div class="icons">
          <i class="fas fa-heart"></i>
          <i class="fas fa-share-alt"></i>
        </div>
      </div>

      <div class="info-section">
        <h1 class="title">Harry Potter & the Deathly Hallows</h1>
        <p class="author">J.K. Rowling</p>
        <p class="release-date">Released on Dec, 2015</p>

        <div class="genres">
          <span class="genre">Fantasy</span>
          <span class="genre">Fiction</span>
          <span class="genre">Mystery</span>
          <span class="genre">Magic</span>
        </div>

        <div class="stats">
          <div class="stat">
            <p>page</p>
            <span>316</span>
          
          </div>
          <div class="stat">
              <p>Language</p>
            <span>English</span>
          </div>
          <div class="stat">
             <p>Rating</p>
            <span>5.0</span>
          </div>
        </div>

        <button class="start-button">Start Workout</button>
      </div>

      </div>
      

    <div class="overview-section">

      <h2>Overview</h2>
      <p>Harry Potter and the Deathly Hallows is the seventh and final book in J.K. Rowling’s iconic Harry Potter series. In this installment, Harry, Hermione, and Ron embark on a dangerous mission to locate and destroy Voldemort’s Horcruxes, the key to his immortality. As they face powerful dark forces, secrets are uncovered, alliances are tested, and an epic battle unfolds at Hogwarts. Filled with suspense, sacrifice, and the ultimate clash between good and evil, the book concludes the journey of Harry Potter and his fight to save the wizarding world from Voldemort’s reign of terror.</p>
    </div>

    <div class="instructor-section">
      <h2>Overview</h2>
      <div class="instructor-row">
       
      <img src="https://via.placeholder.com/50" alt="Instructor" class="instructor-image" />
      <div class="instructor-info">
        <p class="instructor-name">Adam Smith</p>
        <p class="instructor-role">Author</p>
      </div>
      <button class="profile-button">View Profile</button>

      </div>
    </div>
    </div>


  </div>
</template>

<script>
export default {
  name: "EBookDetails"
};
</script>

<style scoped>
.page-title h3 {
  color: #fff;
  font-weight: 600;
  margin-bottom: 20px;
  font-size: 28px;
}

.ebook-details-page {
  background-color: #222222; 
  color: #ffffff;
  padding: 20px;
  max-width: 1000px;
  font-family: Arial, sans-serif;
}

.breadcrumb {
  color: #6c757d;
  margin-bottom: 20px;
}

.details-card {
  display: flex;
  flex-direction: column;
  background-color: #1F2625;
  border-radius: 10px;
  padding: 20px;
  gap: 20px;
}
.card-main{
  display:flex;
  gap:20px;
}

.cover-section {
  position: relative;
  flex-shrink: 0;
}

.cover-image {
  width: 450px;
  height: 300px;
  border-radius: 10px;
  object-fit: cover;
}

.icons {
  position: absolute;
  top: 10px;
  right: 10px;
  display: flex;
  gap: 10px;
}

.icons i {
  color: #ffffff;
  font-size: 18px;
  cursor: pointer;
}

.info-section {
  flex: 1;
}

.title {
  font-size: 24px;
 
  margin: 0 0 10px;
}

.author {
  color: var(--primary-color);
  font-size: 16px;
  margin: 0 0 10px;
}

.release-date {
  font-size: 14px;
  color:#E5E7EB;
  margin-bottom: 10px;
}

.genres {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.genre {
  background-color: #555555;
  color: #ffffff;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
}

.stats {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
  background: #FFFFFF1F;
  padding:20px;
  justify-content: space-between;
  border-radius:10px;

}

.stat {
  text-align: center;
  display: block;
  color:#fff;
  font-size: 14px;
}

.stat span {
  font-size: 18px;
  
  color: var(--primary-color);
}


.start-button {
  background-color: var(--primary-color);
  color: #000;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 5px;
  width:100%;
  cursor: pointer;
}

.overview-section {
  margin-top: 30px;
}

.overview-section h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.overview-section p {
  font-size: 16px;
  line-height: 1.5;
  color: #c1c1c1;
}

.instructor-section{
   margin-top: 30px;
}

.instructor-section h2 {
  font-size: 20px;
  margin-bottom: 10px;
}
.instructor-row {
  display: flex;
  align-items: center;
  gap: 15px;
 


}

.instructor-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.instructor-info {
  flex: 1;
}

.instructor-name {
  font-size: 16px;
  font-weight: bold;
  margin: 0;
}

.instructor-role {
  font-size: 14px;
  color: #c1c1c1;
}

.profile-button {
  background-color: #4fc3f7;
  color: #000;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  border-radius: 5px;
  cursor: pointer;
}
</style> -->
