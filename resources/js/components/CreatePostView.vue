<template>
  <div v-if="isModalOpen" class="create-post-modal" @click.self="closeModal">
    <div class="create-post-content">
      <div class="create-post-header">
        <h2>Create a post</h2>
        <span @click="closeModal" class="close-icon">
          <i class="fa fa-close"></i>
        </span>
      </div>
      <div class="create-post-user-profile">
        <div class="create-user-profile-div">
          <img :src="userProfile.image" alt="User profile" />
        </div>
        <p class="create-user-name">
          {{ userProfile.name }}
        </p>
      </div>



      <div class="create-post-content-options">
        <div class="create-caption">
          <textarea v-model="postContent.caption" placeholder="What do you want to talk about?"></textarea>
        </div>
        <div v-if="previews.length > 0" class="preview-section">
          <div v-for="(file, index) in previews" :key="index" class="preview-item">
            <img v-if="file.type.startsWith('image/')" :src="file.url" alt="Image Preview" />
            <video v-else-if="file.type.startsWith('video/')" controls :src="file.url"></video>
            <button @click="removeFile(index)" class="remove-btn">✕</button>
          </div>
        </div>
        <div class="poll-preview">
          
        </div>
        <div class="create-type-option-button">
          <div class="create-type-option-div">
            <i class="fa fa-camera" aria-hidden="true" @click="openCamera"></i>
            <i class="fa-regular fa-image" @click="openGallery"></i>
            <router-link @click="closeModal" to="/polls"><i class="fa fa-bars" aria-hidden="true"></i></router-link>
            <!-- Hidden inputs -->
            <input ref="cameraInput" type="file" accept="image/*,video/*;capture=camera" style="display: none"
              @change="handleFileUpload" />
            <input ref="galleryInput" type="file" accept="image/*,video/*" multiple style="display: none"
              @change="handleFileUpload" />
          </div>
          <div class="create-buttons-div">
            <button @click="saveDraft" class="draft-btn">Save Draft</button>
            <button @click="sharePost" class="share-btn">Share</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isModalOpen: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      userProfile: {
        name: "Suhana Khan",
        image: "https://via.placeholder.com/40",
      },
      postContent: {
        caption: "",
        uploadedFiles: [], // Store selected files
      },
      previews: [], // Store file previews
    };
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
    saveDraft() {
      console.log("Draft saved:", this.postContent);
      this.closeModal();
    },
    sharePost() {
      console.log("Post shared:", this.postContent);
      this.closeModal();
    },
    openCamera() {
      this.$refs.cameraInput.click();
    },
    openGallery() {
      this.$refs.galleryInput.click();
    },
    handleFileUpload(event) {
      const files = Array.from(event.target.files);
      const currentImages = this.previews.filter((f) =>
        f.type.startsWith("image/")
      ).length;
      const hasVideo = this.previews.some((f) =>
        f.type.startsWith("video/")
      );

      for (const file of files) {
        if (file.type.startsWith("image/")) {
          if (currentImages >= 3) {
            alert("You can only upload up to 3 images.");
            continue;
          }
        } else if (file.type.startsWith("video/")) {
          if (hasVideo) {
            alert("You can only upload 1 video.");
            continue;
          }
        } else {
          alert("Unsupported file type.");
          continue;
        }

        // Add file preview
        const url = URL.createObjectURL(file);
        this.previews.push({ type: file.type, url });
        this.postContent.uploadedFiles.push(file);

        // Update image count and video existence
        if (file.type.startsWith("image/")) currentImages++;
        if (file.type.startsWith("video/")) hasVideo = true;
      }
    },
    removeFile(index) {
      const removedFile = this.previews[index];
      this.previews.splice(index, 1);
      this.postContent.uploadedFiles.splice(index, 1);

      // Cleanup memory
      if (removedFile.url) {
        URL.revokeObjectURL(removedFile.url);
      }
    },
  },
};
</script>

<style scoped>
/* Modal Styles (same as before) */
.create-post-modal {
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  position: fixed;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.5);
}

.create-post-content {
  width: 500px;
  background-color: #27272a;
  padding: 32px;
  border-radius: 24px;
  color: white;
}

.close-icon {
  cursor: pointer;
}

.create-post-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 12px;
  margin-bottom: 24px;
  border-bottom: 1px solid #4B5563;
}

.create-post-header h2 {
  font-size: 20px;
}

.create-post-user-profile {
  display: flex;
  gap: 12px;
  align-items: center;
}

.create-post-user-profile img {
  border-radius: 50%;
}

.create-caption {
  position: relative;
  margin: 20px 0;
}

.create-caption textarea {
  background-color: transparent;
  width: 100%;
  min-height: 100px;
  height: auto;
  resize: vertical;
  padding: 5px;
  /* Space between text and border */
  box-sizing: border-box;
  text-align: left;
  /* Ensure text aligns to the left */
  vertical-align: start;
  /* Align input content to the top */
  line-height: 1.2;
  /* Set a line height that prevents vertical centering */
  font-size: 16px;
  /* Adjust font size as needed */
}

.create-caption textarea::placeholder {
  color: #888;
  /* Optional: Style placeholder color */
  font-size: 14px;
  /* Match placeholder font size to input text size */
  text-align: left;
}

.create-type-option-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.create-type-option-div,
.create-buttons-div {
  display: flex;
  align-items: center;
  gap: 12px;
}

.preview-section {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* 2 items per row */
  gap: 12px;
  /* Space between items */
  grid-template-rows: repeat(2, auto);
  margin-bottom: 20px;
}

.preview-item {
  position: relative;
  overflow: hidden;
  border-radius: 8px;

}

.preview-item:nth-child(1) {
  grid-row: span 2;
}

.preview-item img,
.preview-item video {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 8px;
}

.remove-btn {
  position: absolute;
  top: 5px;
  right: 5px;
  background-color: rgba(0, 0, 0, 0.6);
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  padding: 5px;
}
</style>