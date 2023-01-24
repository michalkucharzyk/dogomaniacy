<template>
    <div class="main-image-wrapper">
        <div class="main-image" @click="showImage()" :style="'background-image: url('+this.mainImage.src+')'"></div>
        <button class="button button-preview" @click="preview(this.mainImage)">
            <font-awesome-icon icon="fa-solid fa-chevron-left"/>
        </button>
        <button class="button button-next" @click="next(this.mainImage)">
            <font-awesome-icon icon="fa-solid fa-chevron-right"/>
        </button>
    </div>
    <div class="thumbnails-image-container">
        <div v-for="(image, index) in this.imagesList" class="thumbnail-image-wrapper">
            <div @click="changeImage(image, $event)" class="thumbnail-image"
                 :style="'background-image: url('+image.src+')'"></div>
        </div>
    </div>

    <vue-easy-lightbox
        escDisabled
        moveDisabled
        :visible="visible"
        :imgs="imagesList"
        :index="index"
        @hide="handleHide"
    ></vue-easy-lightbox>
</template>

<script>

import VueEasyLightbox from 'vue-easy-lightbox'

export default {
    props: ['slidesList', 'imagesList'],
    components: {
        VueEasyLightbox
    },

    data: () => ({
        slides: [],
        images: '',
        visible: false,
        index: 0,
        mainImage: ''
    }),

    mounted() {
        this.imagesList.forEach((value, index) => {
            if (value.main_image === 1) {
                this.mainImage = value
            }
        });
    },

    methods: {
        handleHide() {
            this.visible = false
        },
        changeImage(image, event) {
            this.mainImage = image
            const thumbnails = document.getElementsByClassName('thumbnail-image')
            Array.from(thumbnails).forEach(function (element) {
                element.classList.remove('active');
                if (event.target === element) {
                    element.classList.add('active');
                }
            });
        },

        showImage() {
            this.index = this.mainImage.index
            this.visible = true
        },

        next(image) {
            let indexImage = image.index + 1;
            if (indexImage >= this.imagesList.length) {
                indexImage = 0
            }

            this.imagesList.forEach((value, index) => {
                if (value.index === indexImage) {
                    this.mainImage = value
                }
            });
        },
        preview(image) {
            let indexImage = image.index - 1;
            if (indexImage < 0) {
                indexImage = this.imagesList.length - 1
            }

            this.imagesList.forEach((value, index) => {
                if (value.index === indexImage) {
                    this.mainImage = value
                }
            });
        }
    }
}
</script>
<style lang="scss" scoped>
.thumbnails-image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 15px;
    gap: 10px;

    .thumbnail-image-wrapper {
        padding: 5px;
    }

    .thumbnail-image {
        height: 100px;
        width: 75px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        opacity: 0.8;
        transition: all 1s ease;

        @media screen and (max-width: 768px) {
            height: 50px;
            width: 30px;
        }

        &.active {
            opacity: 1;
            box-shadow: 5px 5px 10px #dac9c2;
        }
    }
}

.main-image-wrapper {
    position: relative;

    .button {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent;
        border: none;
        font-size: 30px;
        font-weight: 300;
        color: #dac9c2;
        transition: all 1s ease;

        &:hover {
            transform: scale(1.3);
        }

        &.button-preview {
            left: 2%;
        }

        &.button-next {
            right: 2%;
        }
    }

    .main-image {
        height: 400px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        transition: all 0.5s ease;

        @media screen and (max-width: 768px) {
            height: 300px;
        }

        &:hover {
            opacity: 0.9;
            cursor: pointer;
        }
    }

}


</style>