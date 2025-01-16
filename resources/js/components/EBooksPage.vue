<template>
  <div class="ebook-page">
    <div class="ebook-sections">
      <div class="page-title">
        <h3>eBooks</h3>
        <router-link to="/dashboard/ebook-list" class="register-link">Manage Ebooks</router-link>
      </div>

      <!-- Recent eBooks Section -->
      <div class="section">
        <h2 class="section-title">Recent eBooks</h2>
        <div class="ebook-list">
      
          <EBookCard
            v-for="ebook in data"
            :key="ebook.id"
            :title="ebook.title"
            :author="ebook.author"
            :image="ebook.image"
            :rating="ebook.rating"
            @readMore="navigateToDetails(ebook.slug)"
          />
        </div>
      </div>

      <!-- Popular eBooks Section -->
      <div class="section">
        <h2 class="section-title">Popular eBooks</h2>
        <div class="ebook-list">
          <EBookCard
            v-for="ebook in popularEBooks"
            :key="ebook.id"
            :title="ebook.title"
            :author="ebook.author"
            :image="cardImage"
            :rating="ebook.rating"
            @readMore="navigateToDetails(ebook.id)"
          />
        </div>
      </div>

      <!-- Best eBooks Section -->
      <div class="section">
        <h2 class="section-title">Best eBooks</h2>
        <div class="ebook-list">
          <EBookCard
            v-for="ebook in bestEBooks"
            :key="ebook.id"
            :title="ebook.title"
            :author="ebook.author"
            :image="cardImage"
            :rating="ebook.rating"
            @readMore="navigateToDetails(ebook.slug)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import EBookCard from '@/components/EBookCard.vue';
import CardImage from '../../../public/images/cardd.png';

export default {
  components: {
    Header,
    Sidebar,
    EBookCard,
  },
  data() {
    return {
      data: [],
      loading: true,
      error: null,
      token: '', // Initialize as an empty string, will be fetched from localStorage
    };
  },
  mounted() {
    this.token = localStorage.getItem('auth_token');
    if (!this.token) {
      console.error('No token found. Please log in again.');
      return;
    }
    this.fetchData(); // Fetch data after getting the token
  },
  name: 'EbookDetail',
  computed: {
    slug() {
      return this.$route.params.slug;
    }
  },

  methods: {
    navigateToDetails(slug) {
      console.log('Navigating to:', { name: 'EbookDetail', params: { slug } });
      this.$router.push(`ebook-details/${slug}`);
    },
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/ebooks', {
          headers: {
            Authorization: `Bearer ${this.token}`, // Use the token from localStorage
          },
        });
        this.data = response.data.ebooks;
        console.log(this.data);
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
.page-title h3 {
  color: #fff;
  font-weight: 600;
  margin-bottom: 20px;
  font-size: 28px;
}

.section {
  margin-bottom: 20px;
  padding: 20px;
  border-radius: 15px;
  background: #494949;
}

.section-title {
  font-size: 20px;
  margin-bottom: 20px;
  color: #fff;
}
.page-title{
      display: flex;
    align-items: center;
    justify-content: space-between;
}
.page-title a{
  background:#fff;
  color:#000;
  padding: 5px 10px;
  font-weight: bold;
  border-radius:5px;
}
.ebook-list {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 10px;
}

.ebook-card {
  flex: 1 1 calc(33.333% - 16px); /* 33.333% width minus gap */
  box-sizing: border-box; /* Ensure padding and borders don't affect width */
}

.ebook-sections {
  padding: 30px;
}
</style>
