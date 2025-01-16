<template>
  <div class="home-content">
    <div class="title-dropdown-field">
      <h1 class="page-title">FEED</h1>
      <select class="selector-tag" name="feed" id="feed-type">
        <option value="latest">Latest feed</option>
        <option value="latest">Latest feed</option>
        <option value="latest">Latest feed</option>
      </select>
    </div>
    <!-- dynamic post -->
    <div>
      <Post :user="post1.user" :images="post1.images" :caption="post1.caption" :social="post1.social" />
      <Post :user="post2.user" :caption="post2.caption" :poll="post2.poll" />
      <Post :user="post3.user" :caption="post3.caption" :hashtag="post3.hashtag" :social="post3.social" />
    </div>
    <!-- dynamic post end -->

    <!-- <div class="votes-info">
                    <img src="../../../public/images/voters.png" alt="Voters" class="voters-pic">
                    <span>Total Votes: 24 · 5 Days Left</span>
                </div> -->
                

  </div>

</template>
<style scoped>
.title-dropdown-field {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.page-title {
  font-size: 28px;
  font-weight: bold;
  color: #ffffff;
}

.selector-tag {
  border-radius: 10px;
  padding: 8px 12px;
  font-size: 14px;
  color: #ffffff;
  background-color: #303030;
  border: 1px solid #ffffff0f;

}
</style>
<script>
import Post from "../components/PostView.vue";

export default {
  components: {
    Post,
  },
  data() {
    return {
      post1: {
        user: {
          name: "John Smith",
          image: "https://via.placeholder.com/40",
          status: "Just Now",
        },
        images: [
          "/images/post-img1.png",
          "/images/post-img2.png",
          "/images/post-img3.png",
        ],
        caption:
          "Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new!",
        social: {
          likes: "2.4K",
          comments: "120",
        },
      },
      post2: {
        user: {
          name: "John Smith",
          image: "https://via.placeholder.com/40",
          status: "Just Now",
        },
        caption:
          "Excited to announce that our design team just wrapped up a major project! We’ve been working tirelessly on a new app feature that will revolutionize how users interact with their profiles. Can't wait to share more details soon! Stay tuned for updates.",
        poll: {
          id: 1,
          choices: [
            "User-friendly navigation",
            "Attractive design",
            "Easy checkout process",
            "Responsive design",
          ],
          votes: 24,
          daysLeft: 5,
        },
      },
      post3: {
        user: {
          name: "John Smith",
          image: "https://via.placeholder.com/40",
          status: "Just Now",
        },
        caption:
          "Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new Can anyone recommend the best excuse for leaving an awkward first date? My go-to is the family emergency but looking for something new!",
        hashtag:
          "#AppDesign #UserExperience #BigNews",
        social: {
          likes: "2.4K",
          comments: "120",
        },
      },
    };
  },
};
</script>