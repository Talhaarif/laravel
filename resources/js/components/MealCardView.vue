<template lang="">
    <div class="meal-card-main" @click="$emit('readMore')">
        <div class="card-vid-main">
            <div class="video-div">
                <div class="play-button">
                        <i class="fa fa-play" aria-hidden="true"></i>
                </div>
                <img :src="image" alt="Course Image" class="card-img" />
            </div>
            <div class="rating-div same-bg">
                <i class="fa fa-star" aria-hidden="true"></i>{{review}}
            </div>
            <div class="time-and-kcal-div">
                <div class="vid-time-div same-bg">{{duration}}</div>
                <div class="kcal-div same-bg"><i class="fa fa-fire" aria-hidden="true"></i> {{kcal}}</div>
            </div>
        </div>
        <div class="vid-body">
            <h2>{{title}}</h2>
            <p>{{discription}}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        image: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
        duration: {
            type: String,
            required: true,
        },
        kcal: {
            type: Number,
            required: true,
        },
        review: {
            type: Number,
            required: true,
        },
    },
}
</script>
<style scoped>
.meal-card-main{
    padding: 16px;
    background-color: rgba(31, 38, 37, 1);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}
.video-div,
.card-vid-main{
    position: relative;
}
.video-div img{
    width: 100%;
}
.card-img{
    height: 196px;
    object-fit: cover;
    border-radius: 20px;
    max-width: 100%;
}
.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 32px;
  height: 32px;
  background: var(--primary-color);
  border-radius: 50%; /* Circular shape */
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.play-button i{
color: rgba(24, 24, 27, 1);
}
.same-bg{
    background-color: rgba(48, 48, 48, 0.3);
    padding: 4px 8px;
    width: fit-content;
    backdrop-filter: blur(5px); 
  -webkit-backdrop-filter: blur(5px); 
  border-radius: 8px;
}
.time-and-kcal-div{
    display: flex;
    gap: 8px;
    position: absolute;
    bottom: 12px;
    left: 12px;
}
.rating-div{
    position: absolute;
    top: 12px;
    right: 12px;
}
.vid-body{
    margin-top: 20px;
}
.card-vid-main .fa-fire,
.card-vid-main .fa-star{
    padding-right: 4px;
    color: rgba(250, 204, 21, 1);
}
.vid-body h2{
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}
.vid-body p{
    font-size: 12px;
    font-weight: 400;
    color: rgba(209, 213, 219, 1);
}


</style>