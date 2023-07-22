<template>
    <carousel :items-to-show="1" :wrap-around="true" :autoplay="2000">
      <slide v-for="slide in carouselItem" :key="slide" >
        <img :src="slide.name" class="object-cover" />
      </slide>

    </carousel>
  </template>

  <script>
  // If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
  import 'vue3-carousel/dist/carousel.css'
  import { Carousel, Slide } from 'vue3-carousel'

  export default {
    name: 'App',
    components: {
      Carousel,
      Slide,
    },
    data(){
        return{
            carouselItem:[
                {name: '/img/masjid (1).jpg'},
                {name: '/img/masjid (2).jpg'},
                // {name: '/img/masjid (3).jpg'},
                {name: '/img/masjid (4).jpg'},
                {name: '/img/masjid (5).jpg'},
            ]
        }
    }
  }
  </script>

<style>
.carousel__item {
  min-height: 200px;
  width: 100%;
  background-color: var(--vc-clr-primary);
  color: var(--vc-clr-white);
  font-size: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 0;
}
.carousel__slide img{
    object-fit: cover;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}
</style>
