<template>
  <div class="ebook-card" :style="{ backgroundImage: `url(${image})` }">
    <div class="rating">
      <span>⭐ {{ rating }}</span>
    </div>
    <div class="ebook-details">
      <div class="card-info">
        <h3 class="title">{{ title }}</h3>
        <p class="author">by {{ author }}</p>
      </div>
      <button @click="$emit('readMore')">Read More</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    author: {
      type: String,
      required: true,
    },
    image: {
      type: String,
      required: true,
    },
    rating: {
      type: String,
      required: true,
    },
  },
};
</script>

<style scoped>
.ebook-card {
  position: relative;
  height: 220px;
  background-size: cover;
  background-position: center;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  align-items: flex-end;
  padding: 20px;
  color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.ebook-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.ebook-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.5); /* Dark overlay */
  z-index: 0;
}

.ebook-details {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  width: 100%;
}

.card-info {
  max-width: 70%;
}

.title {
  font-size: 18px;
  font-weight: 600;
  margin: 0 0 5px;
}

.author {
  font-size: 14px;
  font-style: italic;
  margin: 0;
}

.rating {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 1em;
  z-index: 1;
}

button {
  background-color: #6ce5c9;
  color: #000;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 600;
  font-size: 12px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #5cd2b5;
}
</style>
