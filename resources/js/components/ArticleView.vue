<template lang="">
    <div>
        <div class="heading-and-btn">
            <h2 class="title-one">Articles</h2>
        <router-link to="/courses-list" class="register-link share-btn">Manage Articles</router-link>
        </div>
        
        <div class="courses-main-div">
            <div class="recent-courses courses-row">
                <div class="courses-head">
                    <h3>Recent Articles</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="course-list">
                    <ArticleCard v-for="(course, index) in recentCourses" :key="'recent-' + index" :course="course" />
                </div>
            </div>
            <div class="popular-article courses-row">
                <div class="courses-head">
                    <h3>Recent Articles</h3>
                    <select>
                        <option>Sort by</option>
                    </select>
                </div>
                <div class="pop-card-div">
                    <PopularArticleCard 
                    v-for="(course, index) in PopularArticle" 
                    :key="'recent-' + index" 
                    :image="course.image"
                    :title="course.title"
                    :hours_ago="course.hours_ago"
                    :read_count="course.read_count"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ArticleCard from './ArticleCard.vue';
import PopularArticleCard from './PopularArticleCard.vue';

export default {
    components: {
        ArticleCard,
        PopularArticleCard
    },
    data() {
        return {
            recentCourses: [
                {
                    id: 1,
                    title: "UI/UX Design Essentials",
                    admin: "Alima Jazan",
                    date: "Sep 23, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id: 2,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
                {
                    id: 3,
                    title: "JavaScript for Beginners",
                    admin: "John Doe",
                    date: "Aug 15, 2024",
                    featureImg: "/images/card-img.png",
                    adminImg: "/images/course-admin.png",
                },
            ],
            PopularArticle: [
                {
                    id: 1,
                    title: "Advanced CSS Techniques",
                    read_count: "8k",
                    hours_ago: "2",
                    image: "/images/card-img.png",
                },
                {
                    id: 2,
                    title: "Full Stack Development",
                    read_count: "8k",
                    hours_ago: "2",
                    image: "/images/card-img.png",
                },
                {
                    id: 3,
                    title: "Full Stack Development",
                    read_count: "8k",
                    hours_ago: "2",
                    image: "/images/card-img.png",
                },
            ],
        };
    },
}
</script>
<style scoped>
.courses-main-div{
    display: flex;
    gap: 30px;
    align-items: start;
}
.popular-article{
    max-width: 350px;
}
.courses-row {
    border-radius: 16px;
    background-color: #2b2b2b;
    margin-bottom: 24px;
    padding: 20px;
    width: 100%;
}

.courses-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    color: white;
}

.courses-head h3 {
    font-size: 20px;
}

.courses-head select {
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