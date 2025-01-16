<template lang="">
    <div class="pop-article-card">
        <div class="card-content">
            <div class="card-img">
                <img :src="image" alt="Course Image" class="card-img" />
            </div>
            <div class="card-detail">
                <div class="card-title">
                    <h3>{{title}}</h3>
                </div>
                <div class="hours-read">
                    <p class="hours-ago">{{hours_ago}}h ago</p>
                    <p>-</p>
                    <p class="read-count">{{read_count}} Read</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        image: {
        type: Object,
        required: true,
      },
      title: {
        type: Object,
        required: true,
      },
      hours_ago: {
        type: Object,
        required: true,
      },
      read_count: {
        type: Object,
        required: true,
      },
    },
}
</script>
<style scoped>
    .pop-article-card{
        background-color: #1F2625;
    padding: 8px;
    border:1px solid rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    color: white;
    margin-bottom: 16px;
    }
    .card-content{
        display: flex;
        gap: 8px;
        align-items: start;
    }
    .card-img img{
        min-width: 130px;
        width: 100%;
        height: 87px;
        border-radius: 16px;
        object-fit: cover;
    }
    .card-detail{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;

    }
    .card-title h3{
        font-size: 12px;
        font-weight: 600;
        line-height: 18px;
        letter-spacing: -0.02em;
        color: #fff;
    }
    .hours-read{
        display: flex;
        color: #94A3B8;
        gap: 12px;
    }
    .hours-read p{
font-size: 12px;
font-weight: 400;
line-height: 15px;
letter-spacing: -0.02em;

    }
</style>