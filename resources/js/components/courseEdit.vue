<template>
    <div class="edit-course-form">
        <h2>Edit Course</h2>
        <form @submit.prevent="handleSubmit">
            <div class="form-row">
                <!-- Course Title -->
                <div class="form-group">
                    <label for="title">Course Title</label>
                    <input type="text" id="title" v-model.trim="formData.title" placeholder="Enter course title"
                        required />
                </div>

                <!-- Instructor -->
                <div class="form-group">
                    <label for="instructor">Instructor</label>
                    <input type="text" id="instructor" v-model.trim="formData.instructor"
                        placeholder="Enter instructor name" required />
                </div>
            </div>

            <div class="form-row">
                <!-- Featured Image -->
                <div class="form-group">
                    <label for="featuredImage">Featured Image</label>
                    <input type="text" v-model="formData.image" id="image" placeholder="Enter image URL" required />
                    <!-- <input type="file" id="featuredImage" @change="handleImageUpload" accept="image/*" />
                    <div v-if="formData.featuredImagePreview" class="image-preview">
                        <img :src="formData.featuredImagePreview" alt="Featured Preview" />
                    </div> -->
                </div>

                <div class="form-group">
                <label for="overview">Number of assignment</label>
                <input type="text" id="num_assignment" v-model.trim="formData.num_assignment" required />
            </div>

                <!-- Start Date -->
               
            </div>

            <div class="form-group">
                    <div class="form-group">
                    <label for="discription">Course Description</label>
                    <textarea type="text" id="discription" v-model="formData.discription" required></textarea>
                </div>
                </div>

            <div class="form-row">
                <!-- Categories -->
                <div class="form-group">
                    <label for="modules">Modules</label>
                    <input type="number" id="modules" v-model="formData.modules" required />
                </div>

                <!-- Duration -->
                <div class="form-group">
                    <label for="duration">Duration (hours)</label>
                    <input type="number" id="duration" v-model.number="formData.duration" min="1"
                        placeholder="Enter course duration" required />
                </div>
            </div>

            <div class="form-row">
                <!-- Language -->
                <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" id="language" v-model.trim="formData.language" placeholder="Enter language"
                        required />
                </div>

                <!-- Rating -->
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" id="rating" v-model.number="formData.rating" min="0" max="5" step="0.1"
                        placeholder="Enter rating (0-5)" required />
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="overview">Overview</label>
                <textarea id="overview" v-model.trim="formData.overview"
                    placeholder="Write a short overview of the course" rows="5" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">Save Changes</button>
                <button type="button" class="btn-cancel" @click="cancelEdit">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</template>
  
  <script>
export default {
    props: {
        courseData: {
            type: Object,
            required: true,
        },
        categories: {
            type: Array,
            default: () => [
                "Development",
                "Design",
                "Marketing",
                "Business",
                "Photography",
                "Health & Fitness",
            ],
        },
    },
    data() {
        return {
            formData: {
                title: "",
                image:"",
                // featuredImage: null,
                // featuredImagePreview: "",
                instructor: "",
                modules: "",
                discription: "",
                duration: "",
                language: "",
                rating: "",
                num_assignment: "",
                overview: "",
            },
        };
    },
    watch: {
        courseData: {
            immediate: true,
            handler(newValue) {
                if (newValue) {
                    this.formData = {
                        title: newValue.title || "",
                        image: newValue.image || "",
                        // featuredImage: null,
                        // featuredImagePreview: newValue.featuredImage || "",
                        instructor: newValue.instructor || "",
                        modules: newValue.modules || "",
                        discription: newValue.discription || "",
                        duration: newValue.duration || "",
                        language: newValue.language || "",
                        rating: newValue.rating || "",
                        overview: newValue.overview || "",
                        num_assignment: newValue.num_assignment || "",
                    };
                }
            },
        },
    },
    methods: {
        // handleImageUpload(event) {
        //     const file = event.target.files[0];
        //     if (file) {
        //         this.formData.featuredImage = file;
        //         this.formData.featuredImagePreview = URL.createObjectURL(file);
        //     }
        // },
        handleSubmit() {
            if (this.validateForm()) {
                this.$emit("update-course", this.formData);
            } else {
                alert("Please fill all required fields correctly.");
            }
        },
        cancelEdit() {
            this.$emit("cancel-edit");
        },
        validateForm() {
            return (
                this.formData.title &&
                this.formData.instructor &&
                this.formData.modules &&
                this.formData.description &&
                this.formData.duration > 0 &&
                this.formData.language &&
                this.formData.rating >= 0 &&
                this.formData.rating <= 5 &&
                this.formData.overview
            );
        },
    },
};
</script>
  
  <style scoped>
/* Root Variables for Color Scheme */
:root {
    --primary-color: #6ce5c9;
    /* Light teal */
    --secondary-color: #444;
    /* Darker gray for borders */
    --background-color: #282c34;
    /* Dark background */
    --text-color: #fff;
    /* White text */
    --hover-color: #7cd9c8;
    /* Lighter teal for hover */
}

/* Overall Page Styling */
.edit-course-form {
    max-width: 900px;
    padding: 20px;
    background: #1F2625;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

h2 {
    margin-bottom: 20px;
    font-size: 34px;
    color: #fff;
}

/* Form Row Layout */
.form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

/* Form Group Styling */
.form-group {
    flex: 1;
    min-width: 300px;
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    color: #fff;
    margin-bottom: 5px;
}

/* Input & Textarea Styling */
input,
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--secondary-color);
    border-radius: 5px;
    font-size: 14px;
    background-color: #222;
    color: var(--primary-color);
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 4px rgba(153, 247, 227, 0.5);
}

/* Image Preview */
.image-preview img {
    display: block;
    max-width: 100%;
    margin-top: 10px;
    border-radius: 5px;
}

/* Button Styling */
button {
    background-color: var(--primary-color);
    color: #000;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: var(--hover-color);
}

button:disabled {
    background-color: #7cd9c8;
    cursor: not-allowed;
}

/* Help Text Styling */
.help-text {
    font-size: 12px;
    color: #aaa;
}

/* Form Action Buttons (Submit/Cancel) */
.form-actions {
    display: flex;
    justify-content: space-between;
}

.btn-submit {
    background: var(--primary-color);
    color: black;
}
</style>