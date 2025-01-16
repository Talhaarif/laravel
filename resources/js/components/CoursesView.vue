<template lang="">
    <div>
        <div class="heading-and-btn">
            <h2 class="title-one">Courses</h2>
        <router-link to="/courses-list" class="register-link share-btn">Manage Courses</router-link>
        </div>
        
        <div class="courses-main-div">
            <div class="recent-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <CourseCardView v-for="(course, index) in recentCourses" :key="'recent-' + index" :course="course" />
                </div>
            </div>
            <div class="featured-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <CourseCardView v-for="(course, index) in featuredCourses" :key="'feature-' + index" :course="course" />
                </div>
            </div>
            <div class="best-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Courses</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <CourseCardView v-for="(course, index) in bestCourses" :key="'best-' + index" :course="course" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CourseCardView from './CourseCardView.vue';

export default {
    components: {
        CourseCardView,
    },
    data() {
        return {
            recentCourses: [
                {
                    id:1,
                    title: "UI/UX Design Essentials",
                    admin: "Alima Jazan",
                    date: "Sep 23, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {   id:2,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
            featuredCourses: [
                {
                    id:1,
                    title: "Advanced CSS Techniques",
                    admin: "Jane Smith",
                    date: "Jul 10, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:2,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
            bestCourses: [
                {
                    id:1,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:2,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id:3,
                    title: "Full Stack Development",
                    admin: "Alice Brown",
                    date: "Oct 5, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
        };
    },
}
</script>
<style scoped>
.courses-row{
    border-radius: 16px;
    background-color: #2b2b2b;
    margin-bottom: 24px;
    padding: 20px;
}
.courses-head{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    color: white;
}
.courses-head h3{
    font-size: 20px;
}
.courses-head select{
    background-color: #363f3a;
    padding: 9px 12px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
}
.course-list {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
}
</style>