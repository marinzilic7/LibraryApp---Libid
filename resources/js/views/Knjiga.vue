<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <Navigacija />
    <div
        v-if="jelDodano"
        class="alert alert-light col-12 col-lg-3 col-md-3 col-sm-4 text-dark shadow-lg text-center end-0 me-3 mt-3 position-absolute z-1"
    >
        Ova knjiga je već dodana u vašu košaricu.
    </div>

    <div
        v-if="uspjesno"
        class="alert alert-light col-12 col-lg-3 col-md-3 col-sm-4 text-dark shadow-lg text-center end-0 me-3 mt-3 position-absolute z-1"
    >
        Knjiga dodana u kosaricu
    </div>

    <div class="ms-5 mt-5 d-flex gap-5 flex-wrap" style="margin-bottom: 100px !important;">
        <div v-for="knjiga in knjige" class="card shadow-lg" style="width: 15rem; ">
            <img
                :src="'/images/' + knjiga.image"
                class="card-img-top"
                alt="Image description"
                width="18rem"
                height="200px"
            />
            <div class="card-body">
                <h5 class="card-title text-dark fs-6 text-center">
                    {{ knjiga.ime }}
                </h5>
            </div>
            <ul class="list-group list-group-flush">
                <li id="book_name" class="list-group-item text-dark">
                    {{ knjiga.autor }}
                </li>
                <li id="book_name" class="list-group-item text-dark">
                    {{ knjiga.category.ime }}
                </li>
            </ul>
            <div
                class="card-body d-flex justify-content-between align-items-center"
            >
                <a
                    id="book_name"
                    href="#"
                    class="card-link text-decoration-none text-dark fw-bold"
                    >{{ knjiga.cijena }}</a
                >
                <button class="btn btn-sm bg-transparent">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="25"
                        fill="currentColor"
                        class="bi bi-cart-check text-success"
                        viewBox="0 0 16 16"
                        v-if="isLogged"
                        @click="dodajKosaricu(knjiga.id)"
                    >
                        <path
                            d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"
                        />
                        <path
                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <Bottom />
</template>

<script>
export default {
    data() {
        return {
            knjige: [],
            jelDodano: false,
            user: [],
            isLogged: false,
            uspjesno:false,
        };
    },
    created() {
        this.dohvatiKnjige();
        this.jelPrijavljen();
    },
    methods: {
        dohvatiKnjige() {
            axios
                .get("/dohvatiKnjige")
                .then((response) => {
                    this.knjige = response.data.knjige;
                    console.log("Ovo su knjige", this.knjige);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dodajKosaricu(id) {
            axios
                .post(`/dodajKosaricu/${id}`)
                .then((response) => {
                    this.uspjesno = true;
                    setTimeout(() => {
                        this.uspjesno = false;
                    }, 2000);
                    console.log(response);
                })
                .catch((error) => {
                    this.poruka = error.response.data.poruka;
                    this.jelDodano = true;
                    setTimeout(() => {
                        this.jelDodano = false;
                    }, 2000);
                    console.log(this.poruka);
                });
        },
        jelPrijavljen() {
            axios
                .get("/prijavljen")
                .then((response) => {
                    this.user = response.data.user;

                    if (this.user === null) {
                        this.isLogged = false;
                    } else {
                        this.isLogged = true;
                    }

                    console.log("PRIJAVLJEN JE KORISNIK", this.user);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
#book_name {
    font-size: 14px;
}
</style>
