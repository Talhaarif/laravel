<template>
    <div class="course-detail-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">Courses > {{ course.category }}</div>

        <!-- Course Header -->
        <div class="course-header">
            <div class="course-image">
                <img :src="course.image" :alt="course.title">
            </div>
            <div class="course-info">
                <div class="course-meta">
                    <span class="rating">⭐ {{ course.rating }}</span>
                    <span class="duration">⏰ {{ course.duration }}</span>
                </div>
                <h2 class="course-title">{{ course.title }}</h2>
                <p>{{ course.description }}</p>
                <div class="course-progress">{{ course.progress }} assignment complete</div>
                <button class="enroll-button">Enroll Now</button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab" :class="{ active: activeTab === 'Information' }" @click="setActiveTab('Information')">
                Information
            </button>
            <button class="tab" :class="{ active: activeTab === 'Curriculum' }" @click="setActiveTab('Curriculum')">
                Curriculum
            </button>
            <button class="tab" :class="{ active: activeTab === 'Questions' }" @click="setActiveTab('Questions')">
                Questions
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div v-if="activeTab === 'Information'">
                <h2 class="sub-title">Overview</h2>
                <p class="overview-para">{{ course.overview }}</p>
                <h3 class="sub-title">Instructor</h3>
                <div class="instructor-info">
                    <img :src="course.admin.image" :alt="course.admin.name">
                    <div>
                        <h3>{{ course.admin.name }}</h3>
                        <p>{{ course.admin.role }}</p>
                    </div>
                </div>
                <h2 class="sub-title">Course Details</h2>
                <div class="course-details">
                    <p><strong>Language:</strong> {{ course.language }}</p>
                    <p><strong>Modules:</strong> {{ course.modules }} Total</p>
                </div>
            </div>
            <div v-else-if="activeTab === 'Curriculum'">
                <h2>Curriculum</h2>
                <p>Details about the course curriculum will go here.</p>
            </div>
            <div v-else-if="activeTab === 'Questions'">
                <h2>Questions</h2>
                <p>FAQs and student questions will be displayed here.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
            course: null,
            activeTab: 'Information',
        };
    },
    created() {
        this.fetchCourseData();
    },
    methods: {
        fetchCourseData() {
            const courseId = this.id;
            // Simulating a fetch. Replace this with actual API call.
            const allCourses = [
                {
                    id: 1,
                    category: "UI/UX Design Essentials",
                    title: "UX/UI Design Foundations: Master Core Concepts and Skills",
                    image: "/images/detailcourse.png",
                    rating: "5.0",
                    duration: "9h 15m",
                    description: "The UX/UI Design Foundations course equips you with essential skills in user experience and interface design, focusing on creating intuitive, user-centered digital products. Through hands-on projects, you'll master key design principles and industry tools.",
                    progress: "0/20 assignment complete",
                    overview: "The Google UX Design Professional Certificate offers a deep dive into the fundamentals of user experience and interface design. This course is designed to help learners develop a strong foundation in UX principles, wireframing, prototyping, and usability testing. With hands-on projects and real-world applications, students will gain practical skills to design user-centered digital products. Whether you’re new to the field or looking to enhance your design knowledge, this course equips you with the tools and strategies needed to succeed in the growing field of UX/UI design.",
                    admin: {
                        name: "Razib Ara Kamal",
                        role: "Senior UI/UX Designer",
                        image: "/images/course-admin.png",
                    },
                    language: "English",
                    modules: 5,
                },
                // Other courses...
            ];
            this.course = allCourses.find((course) => course.id == courseId);
        },
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>

<style scoped>
.course-detail-container {
    color: #fff;
    background-color: rgba(31, 38, 37, 1);
    padding: 20px;
}

.breadcrumb {
    font-size: 14px;
    color: #bbb;
    margin-bottom: 20px;
}

.course-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
}

.overview-para {
    margin-bottom: 32px;
}

.course-header {
    display: flex;
    gap: 28px;
    border-radius: 16px;
}

.course-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
}

.course-info {
    flex-basis: 40%;
}

.course-image {
    flex-basis: 60%;
}

.course-info h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.course-meta {
    display: flex;
    gap: 10px;
    font-size: 16px;
    color: #fff;
    margin-bottom: 8px;
    background-color: #000;
    width: fit-content;
    padding: 8px 20px;
    border-radius: 16px;
}

.course-info p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 8px;
    color: rgba(209, 213, 219, 1);
}

.course-progress {
    color: #fff;
    font-size: 14px;
    margin-bottom: 20px;
}

.enroll-button {
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: #000;
    border: none;
    width: 100%;
    border-radius: 12px;
    cursor: pointer;
}

.tabs {
    display: flex;
    gap: 10px;
    margin: 40px 0;
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
}

.tab {
    padding: 10px 20px;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 20px;

}

.tab.active {
    font-weight: 600;
    border-bottom: 2px solid var(--primary-color);
}

.sub-title {
    margin-bottom: 16px;
    font-size: 20px;
}

.tab-content p {
    line-height: 1.6;
    font-size: 16px;
}

.instructor-info {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
}

.instructor-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.course-details p {
    margin: 5px 0;
}
</style>