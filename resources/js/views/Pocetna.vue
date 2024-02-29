<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <div v-if="spinner" class="spinner-border position-absolute top-50 end-50 text-dark" role="status">
        <span class="sr-only">Loading...</span>
    </div>

    <div v-else>
        <Navigacija />
        <div>Pocetna</div>
        <Bottom />
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
                })

        },
    },
};
</script>

<style scoped></style>
