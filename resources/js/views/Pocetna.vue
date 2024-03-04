<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <div
        v-if="spinner"
        class="spinner-border position-absolute top-50 end-50 text-dark"
        role="status"
    >
        <span class="sr-only">Loading...</span>
    </div>

    <div v-else>
        <Navigacija />
        <div class="container">
            <div class="d-flex gap-3 flex-column align-items-center mt-5">
                <h1 class="fs-1">Cloud Cataloging</h1>
                <p class="fs-4">
                    Vaša knjižnica nikada nije izgledala bolje. Knjige, filmovi,
                    glazba i video igre.
                </p>
                <button class="btn Btn p-2 fs-6 col-12 col-lg-1 text-light">
                    Kreni
                </button>
            </div>
        </div>
        <div class="d-flex gap-4 flex-column justify-content-center align-items-center mt-5" style="background-color: #EAF3F4; margin-top: 200px !important;">
            <img class="libidImg" src="../images/pocetna.png" alt="" />
            <h1 class="text-desc">Stvarajte i dijelite svoje kolekcije</h1>
            <p class="col-lg-5 col-md-5  col-12 col-sm-8  text-desc">
                Naša usluga upravljanja knjižnicom prilagođena je knjižnicama,
                školama, organizacijama i kućnim katalozima. Naša internetska
                softver omogućuje vam stvaranje više kolekcija, katalogizaciju
                knjiga, filmova, glazbe i videoigara, stvaranje oznaka,
                ostavljanje bilješki, uvoz/izvoz, dijeljenje vaših kolekcija i
                još mnogo toga. Nudimo dvije različite opcije pretplate koje
                najbolje odgovaraju vašim potrebama. Libib je najbolje mjesto za
                katalogizaciju i upravljanje vašim medijima dostupno na mreži.
                Sada, koja verzija je najbolja za vas?
            </p>
            <button class="btn Btnn text-light p-3"  style=" margin-bottom: 100px !important;">Usporedi planove</button>

        </div>

        <Bottom class="footer" />
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            isLogged: false,
            user: [],
            spinner: false,
        };
    },
    created() {
        this.jelPrijavljen();
    },
    methods: {
        jelPrijavljen() {
            this.spinner = true;
            axios
                .get("/prijavljen")
                .then((response) => {
                    this.user = response.data.user;
                    this.isLogged = true;
                    this.spinner = false;
                    if (this.isLogged == true) {
                        console.log("PRIJAVLJEN JE KORISNIK", this.user);
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.spinner = false;
                });
        },
    },
};
</script>

<style scoped>
.footer{
  position: relative !important;
}

.Btn {
    background-color: #0096b5;
    border: none;
    border-radius: 20px;
}

.Btnn{
    background-color: #0096b5;
    border: none;
    border-radius: 20px;
    position: relative;
    bottom:100px;
}

.text-desc{
    line-height: 30px;
    letter-spacing: 0.6px;
    position:relative;
    bottom:100px;
}

.libidImg{
    position:relative;
    bottom:17vh;
    overflow: hidden;
}
</style>
