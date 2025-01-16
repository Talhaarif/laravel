<template>
  <div class="edit-ebook-container">
    <h2>Edit Ebook</h2>
    <form @submit.prevent="editEbook">
      <!-- Image and Title Row -->
      <div class="form-row">
        <div class="form-group">
          <label for="image">Cover Image URL</label>
          <input type="text" v-model="ebook.image" id="image" placeholder="Enter image URL" required />
        </div>

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" v-model="ebook.title" id="title" placeholder="Enter title" required />
        </div>
      </div>

      <!-- Author and Release Date Row -->
      <div class="form-row">
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" v-model="ebook.author" id="author" placeholder="Enter author's name" required />
        </div>

        <div class="form-group">
          <label for="release_date">Release Date</label>
          <input type="date" v-model="ebook.release_date" id="release_date" required />
        </div>
      </div>

      <!-- Categories and Pages Row -->
      <div class="form-row">
        <div class="form-group">
          <label for="categories">Categories (comma-separated)</label>
          <input
            type="text"
            v-model="categoriesInput"
            id="categories"
            placeholder="e.g., Fiction, Thriller, Mystery"
            required
          />
        </div>

        <div class="form-group">
          <label for="number_of_pages">Number of Pages</label>
          <input
            type="number"
            v-model="ebook.number_of_pages"
            id="number_of_pages"
            placeholder="Enter number of pages"
            required
          />
        </div>
      </div>

      <!-- Language and Rating Row -->
      <div class="form-row">
        <div class="form-group">
          <label for="language">Language</label>
          <input type="text" v-model="ebook.language" id="language" placeholder="Enter language" required />
        </div>

        <div class="form-group">
          <label for="rating">Rating</label>
          <input
            type="number"
            v-model="ebook.rating"
            id="rating"
            step="0.1"
            min="0"
            max="5"
            placeholder="Enter rating (0 to 5)"
            required
          />
        </div>
      </div>

      <!-- Overview Field -->
      <div class="form-group">
        <label for="overview">Overview</label>
        <textarea
          v-model="ebook.overview"
          id="overview"
          rows="3"
          placeholder="Provide a brief overview of the ebook"
          required
        ></textarea>
      </div>

      <!-- Instructor Details -->
      <h3>Instructor Details</h3>
      <div class="form-row">
        <div class="form-group">
          <label for="instructor_name">Instructor Name</label>
          <input
            type="text"
            v-model="ebook.instructor_name"
            id="instructor_name"
            placeholder="Enter instructor's name"
            required
          />
        </div>

        <div class="form-group">
          <label for="instructor_bio">Instructor Bio</label>
          <textarea
            v-model="ebook.instructor_bio"
            id="instructor_bio"
            rows="3"
            placeholder="Provide a short bio for the instructor"
            required
          ></textarea>
        </div>
      </div>

      <div class="form-group">
        <label for="instructor_image">Instructor Profile Image URL</label>
        <input
          type="text"
          v-model="ebook.instructor_profile_image"
          id="instructor_image"
          placeholder="Enter profile image URL"
          required
        />
      </div>

      <!-- Submit Button -->
      <button type="submit">Save Changes</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ebook: {
        image: '',
        title: '',
        author: '',
        release_date: '',
        categories: [],
        number_of_pages: null,
        language: '',
        rating: null,
        overview: '',
        instructor_name: '',
        instructor_bio: '',
        instructor_profile_image: '',
      },
      categoriesInput: '', // For comma-separated categories
    };
  },
  created() {
    this.fetchEbookData();
  },
  methods: {
    async fetchEbookData() {
      const ebookId = this.$route.params.id; // Get the ebook ID from the route params

      try {
        const token = localStorage.getItem('auth_token'); // Retrieve token from localStorage

        if (!token) {
          console.error('No token found. Please log in again.');
          return;
        }

        const response = await fetch(`http://127.0.0.1:8000/api/ebooks/${ebookId}`, {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });

        if (!response.ok) throw new Error('Failed to fetch ebook data.');

        const data = await response.json();
        this.ebook = { ...data, categoriesInput: data.categories.join(', ') }; // Map categories to the input field
      } catch (error) {
        alert('Failed to load ebook data.');
      }
    },

    async editEbook() {
      try {
        const token = localStorage.getItem('auth_token'); // Retrieve token from localStorage

        if (!token) {
          console.error('No token found. Please log in again.');
          return;
        }

        // Prepare the updated eBook data
        const updatedEbook = {
          ...this.ebook,
          categories: this.categoriesInput.split(',').map((cat) => cat.trim()), // Split categories input into an array
          updated_at: new Date().toISOString(),
        };

        const ebookId = this.$route.params.id; // Get the ebook ID from the route params

        // Send the updated data to the API
        const response = await fetch(`http://127.0.0.1:8000/api/ebooks/${ebookId}`, {
          method: 'PUT', // PUT for updating the eBook
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
          },
          body: JSON.stringify(updatedEbook), // Send the updated eBook data
        });

        if (!response.ok) throw new Error('Failed to update the ebook.');

        alert('Ebook updated successfully!');
        this.$router.push('/dashboard/ebook-list'); // Redirect to the eBooks list page
      } catch (error) {
        console.error('Error updating ebook:', error);
        alert('Failed to update the ebook. Please check your input and try again.');
      }
    },
  },
};
</script>


<style scoped>
.edit-ebook-container {
  max-width: 900px;
  padding: 20px;
  background: #1F2625;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  color: #fff;
}

h2, h3 {
  color: #fff;
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
  font-weight: bold;
}

input, textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #222;
  color: #fff;
}

input:focus, textarea:focus {
  outline: none;
  border-color: #00c9a7;
}

button {
  background-color: #00c9a7;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #00997c;
}
</style>
