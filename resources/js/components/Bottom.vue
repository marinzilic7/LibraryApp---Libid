<template>
    <div>
        <div class="position-fixed shadow-lg  bottom-0 w-100" style="background-color: #03151E;" >
            <div class="d-flex justify-content-center text-light align-items-center gap-5 footer-items shadow-lg" >
                <p class="text-center mt-3  ">
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


@media screen and (min-width: 576px) and (max-width: 767.98px) {

}


@media screen and (min-width: 768px) and (max-width: 991.98px) {

}

@media screen and (min-width: 992px) and (max-width: 1199.98px) {

}


@media screen and (min-width: 1200px) {

}


</style>
