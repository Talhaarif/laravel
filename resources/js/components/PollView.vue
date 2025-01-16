<template>
  <div>
    <h2 class="title-one">Edit Poll</h2>
    <div class="poll-options">
      <div class="poll-option-1 poll-option">
        <h3>What do you want to ask?</h3>
        <div v-for="(option, index) in pollOptions" :key="index" class="poll-option-list-items">
          <input type="text" :placeholder="'Add option ' + (index + 1)" v-model="pollOptions[index]" />
        </div>

        <!-- Button to add another option -->
        <div class="add-option poll-option-list-items" @click="addOption">
          <p>Add another option</p>
          <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
      </div>
      <div class="poll-option-2 poll-option">
        <h3>Popular Articles</h3>
        <div class="settings-panel">
          <!-- People Added Section -->
          <div class="setting-item">
            <div class="setting-title">
              <div class="setting-title-left">
                <span>People Added</span>
                <p class="setting-description">Invite people to answer</p>
              </div>
              <div class="avatars">
                <img v-for="(avatar, index) in avatars" :key="index" :src="avatar" alt="Avatar" />
                <span class="more-count">13+</span>
              </div>
            </div>

          </div>

          <!-- Privacy Section -->
          <div class="setting-item">
            <div class="setting-title">
              <div class="setting-title-left">
                <span>Privacy</span>
                <p class="setting-description">Let users answer anonymously</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" v-model="privacy" />
                <span class="slider"></span>
              </label>
            </div>

          </div>

          <!-- Responses Section -->
          <div class="setting-item">
            <div class="setting-title">
              <div class="setting-title-left">
                <span>Responses</span>
                <p class="setting-description">Send users a copy of response</p>
              </div>

              <label class="toggle-switch">
                <input type="checkbox" v-model="responses" />
                <span class="slider"></span>
              </label>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="create-buttons-div">
          <button class="draft-btn">Save Draft</button>
          <button class="share-btn">Share</button>
        </div>
  </div>
</template>

<script>


export default {
  components: {

  },
  data() {
    return {
      avatars: [
        "https://via.placeholder.com/40", // Replace with actual avatar URLs
        "https://via.placeholder.com/40",
        "https://via.placeholder.com/40",
      ],
      pollOptions: [""],
      privacy: true,
      responses: false,
    };
  },
  methods: {
    // Add a new option
    addOption() {
      this.pollOptions.push(""); // Add an empty option to the array
    }
  },
};
</script>

<style scoped>
.poll-options {
  display: flex;
  align-items: start;
  gap: 30px;
}

.poll-option {
  padding: 24px;
  border-radius: 16px;
  border: 1px solid #ffffff0f;
  width: 100%;
}

.poll-option-1 {
  background-color: #1F2625;
}

.poll-option-2 {
  background-color: #2b2b2b;
}

.poll-option h3 {
  font-size: 20px;
  font-weight: 500;
  color: white;
  margin-bottom: 16px;
}

.poll-option-list-items {
  padding: 26px 16px;
  background-color: #191D1C;
  border: 1px solid #ffffff1a;
  margin-bottom: 16px;
  border-radius: 16px;
  color: white;
  font-size: 16px;
}

.poll-option-list-items input {
  background-color: transparent;
  width: 100%;
}

.poll-option-list-items input:active,
.poll-option-list-items input:focus {
  outline: none;
  border: none;
}

.poll-option-list-items input::placeholder {
  color: #fff;
}

.add-option {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  margin-bottom: 0;
}

.add-option i {
  border-radius: 50%;
  color: #000;
  background-color: #99F7E3;
  width: 17px;
  height: 17px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 12px;
}

.settings-panel {
  border-radius: 10px;
  width: 100%;
  color: white;
  font-family: Arial, sans-serif;
}

.setting-item {
  padding: 16px;
  background-color: #191D1C;
  border: 1px solid #ffffff1a;
  margin-bottom: 16px;
  border-radius: 16px;
  color: white;
  font-size: 16px;
}

.setting-item:nth-of-type(3) {
  margin-bottom: 0;
}

.setting-title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 5px;
}

.setting-title span {
  font-size: 16px;
  font-weight: 600;
}

.setting-description {
  font-size: 14px;
  color: #fff;
}

.avatars {
  display: flex;
  align-items: center;
}

.avatars img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: -10px;
  border: 2px solid #1e1e1e;
}

.avatars .more-count {
  font-size: 12px;
  width: 28px;
  height: 28px;
  color: black;
  background: #99F7E3;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 12px;
  margin-left: 5px;
}

.toggle-switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 51px;
  height: 28px;
  background-color: #444;
  border-radius: 20px;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 50%;
  transition: 0.4s;
}

input:checked+.slider {
  background-color: #32D74B;
}

input:checked+.slider:before {
  transform: translateX(24px);
}

.create-buttons-div {
  margin-top: 40px;
  display: flex;
  align-items: center;
  gap: 20px;
  justify-content: end;
}
</style>