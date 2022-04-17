<template>
  <div class="slideshow border bg-gray-100">
    <div class="slideshow-container">
      <div
        class="my-slides fade"
        v-for="(slide, ind) in slides"
        :style="
          ind == slideIndex
            ? { display: 'block', background: slide.color }
            : { display: 'none', background: slide.color }
        "
        :key="slide.title"
      >
        <div class="numbertext">{{ ind + 1 }} / {{ slides.length }}</div>
        <img :src="slide.src" style="width: 100%" />
        <div class="text">{{ slide.title }}</div>
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
        :class="{ active: ind == slideIndex }"
      ></span>
    </div>
  </div>
</template>
<script>
import { ref } from "@vue/reactivity";
export default {
  setup() {
    let slideIndex = ref(0);
    const slides = [
      {
        src: "https://dummyimage.com/1400x480/abc/123.jpg",
        title: "Caption one",
        color: "#fe5426",
      },
      {
        src: "https://dummyimage.com/1400x480/cba/234.jpg",
        title: "Caption two",
        color: "#54fe26",
      },
      {
        src: "https://dummyimage.com/1400x480/acb/312.jpg",
        title: "Caption three",
        color: "#5426fe",
      },
    ];

    function plusSlides(n) {
      showSlides((slideIndex.value += n));
    }

    let currentSlide = (n) => {
      showSlides((slideIndex.value = n));
    };

    let showSlides = (n) => {
      console.log("n", n);
      console.log("slideIndex", slideIndex.value);

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