<template>
    <vueper-slides
        class="no-shadow"
        ref="vueperslides1"
        :touchable="false"
        fade
        :autoplay="false"
        :bullets="false"
        slide-image-inside
        @slide="$refs.vueperslides2.goToSlide($event.currentSlide.index, { emit: false })"
        fixed-height="400px">
        <vueper-slide
            v-for="(slide, i) in slides"
            :key="i"
            :image="slide.image">
        </vueper-slide>
    </vueper-slides>

    <vueper-slides
        class="no-shadow thumbnails"
        ref="vueperslides2"
        @slide="$refs.vueperslides1.goToSlide($event.currentSlide.index, { emit: false })"
        :visible-slides="slides.length"
        fixed-height="75px"
        :bullets="false"
        :touchable="false"
        slide-image-inside
        :gap="2.5"
        :arrows="false">
        <vueper-slide
            v-for="(slide, i) in slides"
            :key="i"
            :image="slide.image"
            @click.native="$refs.vueperslides2.goToSlide(i)">
        </vueper-slide>
    </vueper-slides>
</template>

<script>
import 'vueperslides/dist/vueperslides.css'
import {VueperSlides, VueperSlide} from 'vueperslides'

export default {
    props: ['slidesList'],
    components: {
        VueperSlides, VueperSlide
    },
    data: () => ({
        slides: []
    }),
    mounted() {
        // console.log(this.slidesList);
        this.slides = this.slidesList
    }
}
</script>
<style lang="scss" scoped>
.thumbnails {
    margin: 15px auto 25px auto;
    max-width: 50%;
}

.thumbnails .vueperslide {
    box-sizing: border-box;
    border: 1px solid #fff;
    transition: 0.3s ease-in-out;
    opacity: 0.7;
    cursor: pointer;
}

.thumbnails .vueperslide--active {
    box-shadow: 0 0 6px #dac9c2;
    opacity: 1;
    border-color: #dac9c2;
}

</style>