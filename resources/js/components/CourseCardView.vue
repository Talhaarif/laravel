<template>
    <div class="course-card" @click="goToDetailPage">
      <div class="course-feature-img">
        <img :src="course.featureImg" alt="Course Image" class="card-img" />
      </div>
      <h3 class="course-title">
        {{ course.title }}
      </h3>
      <div class="course-admin">
        <div class="admin-profile">
          <img :src="course.adminImg" alt="Admin Image" class="admin-img" />
        </div>
        <div class="admin-profile-name-date">
          <span class="profile-name">{{ course.admin }}</span> <br />
          <span class="profile-date">{{ course.date }}</span>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      course: {
        type: Object,
        required: true,
      },
    },
    methods: {
        goToDetailPage() {
            this.$router.push(`/courses/${this.course.id}`);
        },
    },
  };
  </script>
  
<style scoped>
.course-card{
    background-color: #1F2625;
    padding: 12px;
    border:1px solid rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    color: white;
}
.course-title{
    font-size: 16px;
    font-weight: 600;
    padding-bottom: 12px;
    margin-bottom: 12px;
    border-bottom:1px solid rgba(255, 255, 255, 0.05);
}
.course-admin{
    display: flex;
    align-items: center;
    gap: 8px;
}
.course-feature-img{
    margin-bottom: 20px;
}
.course-feature-img img{
    border-radius: 16px;
    object-fit: cover;
    width: 100%;
    /* height: 200px; */
}
.profile-name{
    font-size: 12px;
}
.profile-date{
    font-size: 10px;
}
</style>