<template>
  <div class="course-card" @click="$emit('readMore')">
    <div class="course-feature-img">
      <img :src="featureImg" alt="Course Image" class="card-img" />
    </div>
    <h3 class="course-title">
      {{ title }}
    </h3>
    <div class="course-admin">
      <div class="admin-profile">
        <img :src="adminImg" alt="Admin Image" class="admin-img" />
      </div>
      <div class="admin-profile-name-date">
        <span class="profile-name">{{ admin_name }}</span> <br />
        <span class="profile-date">{{ admin_role }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    featureImg: {
      type: Object,
      required: true,
    },
    title: {
      type: Object,
      required: true,
    },
    adminImg: {
      type: Object,
      required: true,
    },
    admin_name: {
      type: Object,
      required: true,
    },
    admin_role: {
      type: Object,
      required: true,
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
  cursor: pointer;
}
.admin-profile img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 50%;
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
  height: 200px;
}
.profile-name{
  font-size: 12px;
}
.profile-date{
  font-size: 10px;
}
</style>