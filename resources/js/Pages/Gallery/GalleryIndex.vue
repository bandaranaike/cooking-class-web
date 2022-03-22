<template>
    <section class="gallery white-bg page-section-ptb">
        <div class="px-72 mx-auto">
            <div class="isotope-filters">
                <button data-filter="" class="active">All</button>
                <button data-filter=".vegetarian"> Vegetarian</button>
                <button data-filter=".chinese">Chinese</button>
                <button data-filter=".italian">Italian</button>
                <button data-filter=".mexican">Mexican</button>
            </div>
        </div>
        <div class="px-36 mx-auto">
            <div class="isotope popup-gallery grid grid-cols-3">
                <div class="grid-item chinese mexican" v-for="gallery in galleries">
                    <a :href="`/gallery/show/${gallery.slug}`" class="gallery-item">
                        <span v-if="gallery.images[0]?.image"><img class="img-fluid" :src="`/storage/${gallery.images[0].image}`" alt=""></span>
                        <div class="overlay">
                            <div class="overlay-content">
                                <h3><a href="#"> {{ gallery.title }} </a></h3>
                                <a class="portfolio-img" :href="gallery.image"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "GalleryIndex",
    props: {
        galleries: Array
    }
}
</script>

<style>
.galllery-item {
    border: 1px solid #ddd;
    min-height: 200px;
    margin: 0 24px 24px 0;
}
</style>
