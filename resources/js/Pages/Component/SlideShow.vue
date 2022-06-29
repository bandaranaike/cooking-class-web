<template>
    <div class="slideshow bg-gray-100">
        <div class="slideshow-container">
            <div
                class="my-slides fade"
                v-for="(slide, ind) in slides"
                :style="ind === slideIndex ? { display: 'block' } : { display: 'none' }"
                :key="slide.title"
            >
                <div class="number-text" v-if="numberText">{{ ind + 1 }} / {{ slides.length }}</div>
                <img :src="slide.src" style="width: 100%"/>
                <div class="text">{{ slide?.title }}</div>
            </div>

            <a class="prev" @click="plusSlides(-1)">&#10094;</a>
            <a class="next" @click="plusSlides(1)">&#10095;</a>
        </div>
        <div class="dots">
      <span
          class="dot"
          @click="currentSlide(ind)"
          v-for="(slide, ind) in slides"
          :key="'dot -' + slide.title"
          :class="{ active: ind === slideIndex }"
      ></span>
        </div>
    </div>
</template>
<script>
import {ref} from "@vue/reactivity";

export default {
    props: {
        slides: Array,
        numberText: {
            default: true,
            type: Boolean
        }
    },
    setup(props) {
        let slideIndex = ref(0);
        let slides;
        if (!props.slides) {
            slides = [
                {
                    src: "/images/one.jpg",
                    title: "Caption one",
                },
                {
                    src: "/images/two.jpg",
                    title: "Caption two",
                },
                {
                    src: "/images/three.jpg",
                    title: "Caption three",
                },
                {
                    src: "/images/four.jpg",
                    title: "Caption three",
                },
            ];
        } else {
            slides = props.slides
        }


        function plusSlides(n) {
            showSlides((slideIndex.value += n));
        }

        let currentSlide = (n) => {
            showSlides((slideIndex.value = n));
        };

        let showSlides = (n) => {

            if (n > slides.length - 1) {
                slideIndex.value = 0;
            }
            if (n < 0) {
                slideIndex.value = slides.length - 1;
            }
        };

        showSlides(slideIndex.value);

        return {
            plusSlides,
            currentSlide,
            slides,
            slideIndex,
        };
    },
};
</script>
