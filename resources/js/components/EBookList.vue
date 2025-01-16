<template>
  <div class="ebook-list-page">
    <div class="header">
      <h1>EBook Listings</h1>
      <button class="create-button" @click="createEBook">+ Create New EBook</button>
    </div>

    <table class="ebook-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Author</th>
          <th>Categories</th>
          <th>Pages</th>
          <th>Language</th>
          <th>Rating</th>
          <th>Release Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="ebooks.length === 0">
          <td colspan="9" class="no-data">Loading eBooks...</td>
        </tr>
        <tr v-for="(ebook, index) in ebooks" :key="ebook.id">
          <td>{{ index + 1 }}</td>
          <td>{{ ebook.title }}</td>
          <td>{{ ebook.author }}</td>
          <td>
            <ul>
              <li v-for="category in ebook.categories" :key="category">{{ category }}</li>
            </ul>
          </td>
          <td>{{ ebook.number_of_pages }}</td>
          <td>{{ ebook.language }}</td>
          <td>{{ ebook.rating }}</td>
          <td>{{ ebook.release_date }}</td>
          <td class="action-buttons">
            <button class="edit-button" @click="editEBook(ebook.id)">
              <i class="fas fa-edit"></i>
            </button>
            <button class="delete-button" @click="deleteEBook(ebook.id)">
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
  name: "EBookList",
  data() {
    return {
      ebooks: [], // Store fetched eBooks
      token: '',  // Initialize token property
    };
  },
  methods: {
    async fetchEBooks() {
      try {
        this.token = localStorage.getItem('auth_token'); // Retrieve token from localStorage

        if (!this.token) {
          console.error('No token found. Please log in again.');
          return;
        }

        const response = await fetch("http://127.0.0.1:8000/api/ebooks", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${this.token}`, // Add the Bearer token dynamically
          },
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        this.ebooks = data.ebooks || []; // Use `ebooks` from API response
      } catch (error) {
        console.error("Error loading eBooks:", error);
      }
    },
    createEBook() {
      this.$router.push({ name: "CreateEBook" }); // Navigate to Create EBook page
    },
    editEBook(id) {
      this.$router.push({ name: "EditEbook", params: { id } }); // Navigate to Edit EBook page with ID
    },
    deleteEBook(id) {
      const confirmDelete = confirm("Are you sure you want to delete this eBook?");
      if (confirmDelete) {
        this.token = localStorage.getItem('auth_token'); // Retrieve token again for delete

        if (!this.token) {
          console.error('No token found. Please log in again.');
          return;
        }

        // Send a DELETE request to the API
        fetch(`http://127.0.0.1:8000/api/ebooks/${id}`, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${this.token}`, // Add the Bearer token
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
            }
            // Filter out the deleted ebook from the local list
            this.ebooks = this.ebooks.filter((ebook) => ebook.id !== id);
            alert(`eBook with ID: ${id} has been deleted.`);
          })
          .catch((error) => {
            console.error("Error deleting eBook:", error);
          });
      }
    }
  },
  mounted() {
    this.fetchEBooks(); // Fetch eBooks when the component is mounted
  },
};
</script>


<style scoped>
.ebook-list-page {
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

.ebook-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.ebook-table th,
.ebook-table td {
  border: 1px solid #333333;
  padding: 10px;
  text-align: left;
}

.ebook-table th {
  background-color: #333333;
  color: #ffffff;
  font-size: 16px;
}

.ebook-table tr:nth-child(even) {
  background-color: #2a2a2a;
}

.ebook-table tr:nth-child(odd) {
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
