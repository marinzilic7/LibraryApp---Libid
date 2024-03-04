<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <Navigacija />
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-12">
            <ol class="list-group list-group-numbered">
                <li
                    class="list-group-item d-flex justify-content-between align-items-start"
                >
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Korisnici</div>
                        Pregled svih korisnika, brisanje...
                    </div>

                    <button
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo"
                        class="btn btn-outline-dark btn-sm mt-2"
                    >
                        Pregled
                    </button>
                </li>
                <li
                    class="list-group-item d-flex justify-content-between align-items-start"
                >
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Kategorije</div>
                        Pregled kategorija, dodavanje, brisanje
                    </div>
                    <button
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalCategories"
                        data-bs-whatever="@mdo"
                        class="btn btn-outline-dark btn-sm mt-2"
                    >
                        Pregled
                    </button>
                </li>
                <li
                    class="list-group-item d-flex justify-content-between align-items-start"
                >
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Knjige</div>
                        Pregled svih knjiga, dodavanje, uređivanje, brisanje...
                    </div>
                    <button class="btn btn-outline-dark btn-sm mt-2">
                        Pregled
                    </button>
                </li>
            </ol>
        </div>

        <!-- MODAL ZA KORISNIKE -->

        <div
            class="modal fade modal-fullscreen"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Svi korisnici registrirani na sustav
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Ime</th>
                                        <th scope="col">Prezime</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Uloga</th>
                                        <th scope="col">Datum reigstracije</th>
                                        <th scope="col">Izbrisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in allUsers">
                                        <th scope="row">{{ user.id }}</th>
                                        <td>{{ user.ime }}</td>
                                        <td>{{ user.prezime }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.uloga }}</td>
                                        <td>
                                            {{
                                                formatirajDatum(user.created_at)
                                            }}
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-outline-danger btn-sm"
                                                @click="
                                                    izbrisiKorisnika(user.id)
                                                "
                                            >
                                                Izbrisi
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ZA KATEGORIJE -->

    <div
        class="modal fade modal-fullscreen"
        id="exampleModalCategories"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Pregled svih kategorija
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Ime</th>
                                        <th scope="col">Opis</th>
                                        <th scope="col">Dodao</th>
                                        <th scope="col">Datum dodavanja</th>
                                        <th scope="col">Izbrisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="kategorija in kategorije">
                                        <th scope="row">{{ kategorija.id }}</th>
                                        <td>{{ kategorija.ime }}</td>
                                        <td>{{ kategorija.opis }}</td>
                                        <td>{{ kategorija.user.ime}} {{ kategorija.user.prezime }}</td>
                                        <td>{{ formatirajDatum(kategorija.created_at) }}</td>
                                        <td>
                                            <button
                                                class="btn btn-outline-danger btn-sm"
                                                @click="
                                                    izbrisiKategoriju(kategorija.id)
                                                "
                                            >
                                                Izbrisi
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mt-3 mb-3 fw-bold">
                    <div
                        class="accordion accordion-flush"
                        id="accordionFlushExample"
                    >
                        <div class="accordion-item border">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne"
                                    aria-expanded="false"
                                    aria-controls="flush-collapseOne"
                                >
                                    Dodaj kategoriju
                                </button>
                            </h2>
                            <div
                                id="flush-collapseOne"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample"
                            >
                                <div class="accordion-body">
                                    <form @submit.prevent="dodajKategoriju()">
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Ime kategorije</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm"
                                                v-model="kategorija.ime"
                                                :class="{
                                                    'is-invalid': errors.ime,
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.ime"
                                                    class="text-danger"
                                                >
                                                    {{ errors.ime[0] }}
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Opis kategorije</span
                                            >
                                            <textarea
                                                class="form-control"
                                                placeholder="Ovdje dodajte opis kategorije..."
                                                v-model="kategorija.opis"
                                                :class="{
                                                    'is-invalid': errors.opis,
                                                }"
                                            ></textarea>
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.opis"
                                                    class="text-danger"
                                                >
                                                    {{ errors.opis[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-success"
                                        >
                                            Potvrdi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <Bottom />
</template>

<script>
import moment from "moment";

export default {
    data() {
        return {
            allUsers: [],
            kategorije: [],
            kategorija: {
                ime: "",
                opis: "",
            },
            errors: {},
        };
    },
    created() {
        this.getAllUsers();
        this.dohvatiKategorije();
    },
    methods: {
        getAllUsers() {
            axios
                .get("/svikorisnici")
                .then((response) => {
                    this.allUsers = response.data.allUsers;
                    console.log("Ovo su svi korisnici", this.allUsers);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        izbrisiKorisnika(id) {
            axios
                .post(`/izbrisiKorisnika/${id}`)
                .then((response) => {
                    this.poruka = response.data.poruka;
                    this.getAllUsers();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dohvatiKategorije() {
            axios
                .get("/kategorije")
                .then((response) => {
                    this.kategorije = response.data.kategorije;
                    console.log("Ovo su kategorije", this.kategorije);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        formatirajDatum(datum) {
            return moment(datum).format("DD.MM.YYYY HH:mm:ss");
        },

        dodajKategoriju() {
            const Kategorija = {
                ime: this.kategorija.ime,
                opis: this.kategorija.opis,
            };
            axios
                .post("/dodajKategoriju", Kategorija)
                .then((response) => {
                    console.log(response.data);
                    this.errors = {};

                    this.dohvatiKategorije();
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
        izbrisiKategoriju(id){
            axios.post(`/izbrisiKategoriju/${id}`).then((response) => {
                this.poruka = response.data.poruka;
                this.dohvatiKategorije();
            }).catch((error) => {
                console.log(error);
            });
        }
    },
};
</script>

<style scoped>
.container {
    height: 400px;
}
</style>
