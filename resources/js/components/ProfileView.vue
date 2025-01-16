<template>
    <div class="profile-container">
      <h2 class="title-one">Profile</h2>
  
      <!-- Cover Image -->
      <div class="cover-image">
        <img :src="profile.coverImage" alt="Cover Image" />
      </div>
  
      <!-- Profile Information -->
      <div class="profile-info">
        <img
          class="profile-pic"
          :src="profile.profilePic"
          alt="Profile Picture"
        />
        <h1 class="username">{{ profile.name }}</h1>
        <p class="handle">{{ profile.handle }}</p>
        <p class="bio">{{ profile.bio }}</p>
        <button class="follow-btn">Follow</button>
      </div>
  
      <!-- Tabs -->
      <div class="tabs">
        <button
          v-for="(tab, index) in tabs"
          :key="index"
          class="tab"
          :class="{ active: activeTab === tab.name }"
          @click="setTab(tab.name)"
        >
          {{ tab.name }}
        </button>
      </div>
  
      <!-- Tab Content -->
      <div class="tab-content">
        <div v-if="activeTab === 'Interests'">
          <h2 class="tab-title">{{ tabs[0].title }}</h2>
        </div>
        <div v-if="activeTab === 'Recent Posts'">
          <h2 class="tab-title">{{ tabs[1].title }}</h2>
          <div class="news-grid">
            <div
              class="news-item"
              v-for="(news, index) in tabs[1].content"
              :key="index"
            >
              <img :src="news.image" :alt="news.alt" />
            </div>
          </div>
        </div>
        <div v-if="activeTab === 'Activities'">
          <h2 class="tab-title">{{ tabs[2].title }}</h2>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        // Profile Data
        profile: {
          coverImage: "/images/cover-photo.png",
          profilePic: "/images/girl-profile.png",
          name: "Musiani Wanda",
          handle: "@Musia_Wan25",
          bio: "Creative coder with a passion for design, always seeking new ideas and outdoor adventures.",
        },
  
        // Tabs and Content
        tabs: [
          {
            name: "Interests",
            title: "Interests News",
            content: [], // Add any content for Interests here if needed
          },
          {
            name: "Recent Posts",
            title: "Latest News",
            content: [
              { image: "/images/profile-post.png", alt: "News Image 1" },
              { image: "/images/profile-post-2.png", alt: "News Image 2" },
              { image: "/images/profile-post-2.png", alt: "News Image 3" },
              { image: "/images/profile-post-2.png", alt: "News Image 4" },
              { image: "/images/profile-post-2.png", alt: "News Image 5" },
            ],
          },
          {
            name: "Activities",
            title: "Activities News",
            content: [], // Add any content for Activities here if needed
          },
        ],
  
        // Default active tab
        activeTab: "Recent Posts",
      };
    },
    methods: {
      setTab(tabName) {
        this.activeTab = tabName;
      },
    },
  };
  </script>
  
  <style scoped>
  /* Cover Image */
  .cover-image img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 12px;
    opacity: 0.5;
  }
  
  /* Profile Info */
  .profile-info {
    text-align: center;
    padding: 20px;
    position: relative;
  }
  
  .tab-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 15px;
    letter-spacing: -0.02em;
    text-align: left;
    margin-bottom: 20px;
  }
  
  .profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #1e1e1e;
  }
  
  .username {
    margin-top: 40px;
    font-size: 1.8rem;
  }
  
  .handle {
    color: #aaa;
    font-size: 0.9rem;
  }
  
  .bio {
    margin: 8px auto 16px auto;
    color: #ccc;
    font-size: 1rem;
    max-width: 346px;
  }
  
  .follow-btn {
    background-color: rgba(255, 255, 255, 0.1);
    color: #1e1e1e;
    padding: 8px 24px;
    border: 1px solid rgba(255, 255, 255, 0.56);
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    margin-top: 10px;
    color: white;
  }
  
  /* Tabs */
  .tabs {
    display: flex;
    justify-content: center;
    border-top: 1px solid #444;
    padding-top: 32px;
    margin: 20px 0;
    gap: 12px;
  }
  
  .tab {
    background: none;
    color: #ccc;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 12px;
    transition: all 0.3s ease-in-out;
  }
  
  .tab.active,
  .tab:hover {
    background-color: var(--primary-color);
    color: #000;
  }
  
  /* Tab Content */
  .tab-content {
    text-align: center;
    color: #ccc;
    padding: 10px;
  }
  
  .news-grid {
    display: flex;
    gap: 16px;
    flex-wrap: nowrap;
    overflow-x: auto;
  }
  
  .news-item {
    min-width: 172px;
    background-color: #333;
    border-radius: 8px;
    overflow: hidden;
    flex: 0 0 auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  }
  
  .news-item img {
    width: 100%;
    height: 140px;
    object-fit: cover;
  }
  </style>
  