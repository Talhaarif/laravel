<template>
  <aside class="sidebar">
    <div class="logo">
      <img src="../../../public/images/logo.png" alt="Logo" />
    </div>
    <nav class="menu">
      <ul>
        <li
          v-for="item in menuItems"
          :key="item.name"
          :class="{ active: route.path === item.route }"
          @click="navigateTo(item.route)"
        >
          <i :class="item.icon"></i>
          <span>{{ item.name }}</span>
        </li>
      </ul>
    </nav>
    <button @click="openModal" class="create-post">
      <i class="fas fa-plus"></i>
      Create Post
    </button>
    <CreatePostView 
      :isModalOpen="isModalOpen" 
      @close="closeModal"
    />
  </aside>

</template>

<script>
import { useRoute, useRouter } from 'vue-router';
import CreatePostView from './createPostView.vue';

export default {
  components: {
    CreatePostView,
  },
  setup() {
    const route = useRoute(); // Access the current route
    const router = useRouter(); // Router instance for navigation

    const menuItems = [
      { name: "Home", icon: "fas fa-home", route: "/" },
      { name: "Greetings", icon: "fas fa-handshake", route: "/dashboard/greetings" },
      { name: "Calendar", icon: "fas fa-calendar", route: "/dashboard/calendar" },
      { name: "Messages", icon: "fas fa-envelope", route: "/dashboard/messages" },
      { name: "Articles", icon: "fas fa-newspaper", route: "/dashboard/articles" },
      { name: "Ebooks", icon: "fas fa-book", route: "/dashboard/ebooks" },
      { name: "Courses", icon: "fas fa-chalkboard-teacher", route: "/dashboard/courses" },
      { name: "Workouts", icon: "fas fa-dumbbell", route: "/dashboard/workouts" },
      { name: "Flavorful Meals", icon: "fas fa-utensils", route: "/dashboard/flavor-meals" },
      { name: "Spiritual", icon: "fas fa-praying-hands", route: "/dashboard/spiritual" },
      { name: "Profiles", icon: "fas fa-user", route: "/dashboard/Profile" },
      { name: "Settings", icon: "fas fa-cog", route: "/dashboard/settings" },
      { name: "Contact Us", icon: "fas fa-phone", route: "/dashboard/contact" },
    ];

    const navigateTo = (path) => {
      router.push(path); // Navigate to the selected route
    };

    return { menuItems, route, navigateTo };
  },
  data() {
    return {
      isModalOpen: false, // Controls modal visibility
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true; // Open modal
    },
    closeModal() {
      this.isModalOpen = false; // Close modal
    },
  },
};
</script>

<style scoped>
.sidebar {
  width: 240px;
  background-color: #1f1f1f;
  color: #ffffff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  min-height: 100%;
}

.logo img {
  width: 55px;
  object-fit: contain;
  margin-bottom: 20px;
}

.menu ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.menu li {
  display: flex;
  align-items: center;
  color: #94a3b8;
  padding: 10px 15px;
  margin-bottom: 12px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.menu li.active,
.menu li:hover {
  background-color: var(--primary-color);
  color: #000;
  border-radius: 6px;
}

.menu i {
  margin-right: 10px;
}

.create-post {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  padding: 10px;
  font-size: 16px;
  color: var(--primary-color);
  background-color: rgba(255, 255, 255, 0.12);
  border: 1px solid var(--primary-color);
  border-radius: 12px;
  margin-top: 15px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}
.create-post i{
  border-radius: 50%;
  font-size: 12px;
  padding: 3px;
  border: 1px solid var(--primary-color);
}

.create-post:hover {
  background-color: var(--primary-color);
  color: #000;
}
.create-post:hover i{
  background-color: var(--primary-color);
  color: #000;
  border: 1px solid #000;
}
</style>
