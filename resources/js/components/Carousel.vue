<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item" v-for='(image, index) in carouselData.carouselImage' v-bind:class="{ active: index==0 }">
                <img class="d-block" :src="image" alt="First slide">
                <div class='carousel-item-text-box'>
                    <p>{{ carouselData.carouselText[index] }}</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

 <script>
import './../../sass/carousel.scss'
export default {
   name: 'carousel',
  props: {
      carouselData: {
        carouselImage: ['String'],
        carouselText: ['String']
      }
  },
  created() {}
};
</script> 