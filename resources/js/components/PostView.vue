<template>
    <div class="post-data-div">
      <!-- User and Post Option -->
      <div class="user-and-post-option" v-if="user">
        <div class="user-profile-detail">
          <div class="user-profile">
            <div class="user-profile-div">
              <img :src="user.image" alt="User profile" />
            </div>
            <p class="user-name">
              {{ user.name }} <br />
              <span class="online-type">{{ user.status }}</span>
            </p>
          </div>
        </div>
        <div class="post-option">
          <img v-if="postOptions" :src="postOptions.icon" alt="Options" />
        </div>
      </div>
  
      <!-- Post Images -->
      <div class="post-images" v-if="images && images.length">
        <div class="image-grid">
          <div class="large-image" v-if="images[0]">
            <img :src="images[0]" alt="Large Image" />
          </div>
          <div class="small-images" v-if="images[1] || images[2]">
            <div class="small-image" v-for="(img, index) in images.slice(1)" :key="index">
              <img :src="img" alt="Small Image" />
            </div>
          </div>
        </div>
      </div>
  
      <!-- Post Caption -->
      <div class="post-caption" v-if="caption">
        <p>{{ caption }}</p>
      </div>

      <div class="post-caption post-hashtag" v-if="hashtag">
                <p>
                    {{ hashtag }}
                </p>
            </div>
  
      <!-- Poll Choices -->
      <div class="poll-choices" v-if="poll && poll.choices.length">
        <label v-for="(choice, index) in poll.choices" :key="index">
          <input type="radio" :name="'poll-' + poll.id" />
          <span>{{ choice }}</span>
        </label>
        <div class="poll-footer">
          <div class="votes-info">
            <span>Total Votes: {{ poll.votes }} · {{ poll.daysLeft }} Days Left</span>
          </div>
          <button class="vote-btn">Vote</button>
        </div>
      </div>
  
      <!-- Social Shares -->
      <div class="social-shares" v-if="social">
        <div class="like-and-comments">
          <button class="like-div social-flex">
            <span class="like-icon"><i class="fa-regular fa-thumbs-up"></i></span>
            <span class="like-count">{{ social.likes }}</span>
          </button>
          <button class="comment-div social-flex">
            <span class="comment-icon"><i class="fa-regular fa-comment"></i></span>
            <span class="comment-count">{{ social.comments }}</span>
          </button>
        </div>
        <button class="share-div social-flex">
          <span class="share-icon"><i class="fa-solid fa-share-nodes"></i></span>
          <span class="share-text">Share</span>
        </button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      user: {
        type: Object,
        default: null,
      },
      images: {
        type: Array,
        default: () => [],
      },
      caption: {
        type: String,
        default: null,
      },
      hashtag: {
        type: String,
        default: null,
      },
      poll: {
        type: Object,
        default: null,
      },
      social: {
        type: Object,
        default: null,
      },
      postOptions: {
        type: Object,
        default: null,
      },
    },
  };
  </script>
  
  <style scoped>
  

.post-data-div {
    max-width: 925px;
    width: 100%;
    background-color: #252827;
    padding: 20px;
    border-radius: 16px;
    border: 1px solid #ffffff0f;
    margin-bottom: 48px;
}

.user-and-post-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-profile img {
    border-radius: 50%;
}

.user-name {
    font-size: 12px;
    color: white;
    font-weight: 500;
}

.online-type {
    font-size: 10px;
    font-weight: 400;
    color: #94A3B8;
}

.image-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.large-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.small-images {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 10px;
}

.small-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.post-images {
    margin-bottom: 20px;
}

.post-caption p {
    font-size: 16px;
    color: #E5E7EB;
    margin-bottom: 20px;
}

.social-shares {
    display: flex;
    justify-content: space-between;
    color: white;
}

.like-and-comments {
    display: flex;
    align-items: center;
    gap: 10px;
}

.social-flex {
    display: flex;
    align-items: center;
    gap: 5px;
}

.poll-choices {
color: white;
  margin-bottom: 16px;
}

.poll-choices label {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  cursor: pointer;
}

.poll-choices input[type="radio"] {
  margin-right: 8px;
  accent-color: #00cc99;
}

.poll-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
color: white;
}

.voters-pic {
  /* width: 30px;
  height: 30px;
  border-radius: 50%; */
  object-fit: cover;
  margin-right: 8px;
}

.vote-btn {
  background-color: var(--primary-color);
  color: #000;
  font-weight: 700;
  border: 1px solid var(--primary-color);
  border-radius: 10px;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
  transition: all ease-in-out .3s;
}

.vote-btn:hover {
  background-color: transparent;
  color: #FFF;
}
.votes-info {
    display: flex
;
    align-items: center;
}
</style>