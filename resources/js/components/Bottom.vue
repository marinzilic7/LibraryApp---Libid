<template>
    <div>
        <div class="position-fixed bg-light shadow-lg bottom-0 w-100">
            <div class="d-flex justify-content-center align-items-center gap-5 footer-items">
                <p class="text-center mt-3 ">
                    Copyright © Ime prezime & Ime Prezime | 2024
                </p>
                <div class="d-flex gap-3 footer-icons">
                    <Facebook class="icon"/>
                    <Instagram  class="icon"/>
                    <TikTok class="icon" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Facebook from "../../icons/Facebook.vue";
import TikTok from "../../icons/TikTok.vue";
import Instagram from "../../icons/Instagram.vue";

export default {
    components: {
        Facebook,
        TikTok,
        Instagram,
    },
};
</script>

<style scoped>


/* Ekran manji od 576 piksela */
@media screen and (max-width: 575.98px) {
    p{
        font-size: 0.7rem;
    };
    .icon{
        height: 18px;
    }



    .footer-items{
        display:flex !important;
        margin: 0px 10px 0px 10px;
        gap:1 !important;
    }
}

/* Ekran između 576 i 767 piksela */
@media screen and (min-width: 576px) and (max-width: 767.98px) {
  /* Vaši stilovi ovdje */
}

/* Ekran između 768 i 991 piksela */
@media screen and (min-width: 768px) and (max-width: 991.98px) {
  /* Vaši stilovi ovdje */
}

/* Ekran između 992 i 1199 piksela */
@media screen and (min-width: 992px) and (max-width: 1199.98px) {
  /* Vaši stilovi ovdje */
}

/* Ekran veći ili jednak 1200 piksela */
@media screen and (min-width: 1200px) {
  /* Vaši stilovi ovdje */
}


</style>
