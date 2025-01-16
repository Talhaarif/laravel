<template lang="">
    <div class="workout-card-main" @click="$emit('readMore')">
        <div class="card-img-main">
            <img :src="image" alt="Course Image" class="card-img" />
        </div>
        <div class="workout-body">
            <h2>{{title}}</h2>
            <p><b>|</b> {{description}}</p>
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
        }
    },
}
</script>
<style scoped>
.workout-card-main{
    padding: 16px;
    background-color: rgba(31, 38, 37, 1);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}
.workout-card-main{
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
    width: 100%;
}
.workout-body{
position: absolute;
bottom: 32px;
left: 32px;
}

.workout-body h2{
font-size: 16px;
font-weight: 600;
line-height: 21.79px;
letter-spacing: -0.02em;

}
.workout-body p{
font-size: 14px;
font-weight: 400;
line-height: 16px;
letter-spacing: -0.01em;
color: #99F7E3;
}


</style>