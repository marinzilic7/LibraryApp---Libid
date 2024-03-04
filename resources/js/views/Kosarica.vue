<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <Navigacija />
    <div class="container d-flex justify-content-center mt-5 flex-wrap">
        <div
            v-for="cart in kosarica"
            class="card shadow-lg mb-3 col-8"

        >
            <div class="row g-0">
                <div class="col-md-4">
                    <img
                        :src="'/images/' + cart.book.image"
                        class="card-img-top"
                        alt="Image description"


                    />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Ime knjige: {{cart.book.ime}}</h5>
                        <hr>
                        <p class="card-text">
                          Opis:  {{ cart.book.opis }}
                        </p>
                        <hr>
                        <p class="card-text">
                            <small class="text-muted"
                                >Autor: {{cart.book.autor}}</small
                            >
                        </p>
                        <hr>
                    </div>
                    <div>
                        <p class="fs-3 text-end me-3 ">{{ cart.book.cijena }}</p>
                        <button @click="izbrisiKosaricu(cart.id)" class="btn btn-outline-danger btn-sm float-end me-3 mb-2">Izbrisi</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <Bottom />
</template>

<script>
export default {
    data() {
        return {
            kosarica: [],
        };
    },
    created() {
        this.dohvatiKosaricu();
    },
    methods: {
        dohvatiKosaricu() {
            axios
                .get("/dohvatiKosaricu")
                .then((response) => {
                    this.kosarica = response.data.kosarica;
                    console.log("Ovo su knjige u kosarici", this.kosarica);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        izbrisiKosaricu(id){
            axios
                .post(`/izbrisiKosaricu/${id}`)
                .then((response) => {
                    console.log(response);
                    this.dohvatiKosaricu();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

    },
};
</script>

<style scoped>

.card-img-top{
    width:200px !important;
    object-fit: cover;
    height: 300px;
}

</style>
