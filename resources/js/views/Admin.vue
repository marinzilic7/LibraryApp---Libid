<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <Navigacija />

    <div  v-if="spinner" class="container d-flex justify-content-center">
        <div

            class="spinner-border text-dark position-absolute top-50"
            role="status"
        >
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>



    <div  v-if="user.uloga === 'admin'" class="container d-flex justify-content-center align-items-center">
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
                    <button
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalBooks"
                        data-bs-whatever="@mdo"
                        class="btn btn-outline-dark btn-sm mt-2"
                    >
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

    <div class="mt-5 d-flex justify-content-center" v-else>
        <div v-if="!spinner" class="alert alert-dark text-dark text-center col-12 col-lg-4 col-md-5 col-sm-5">Stranica nije pronadjena</div>
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
                                    <td>
                                        {{ kategorija.user.ime }}
                                        {{ kategorija.user.prezime }}
                                    </td>
                                    <td>
                                        {{
                                            formatirajDatum(
                                                kategorija.created_at
                                            )
                                        }}
                                    </td>
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
                    <hr class="mt-3 mb-3 fw-bold" />
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
    <!-- MODAL ZA KNJIGE -->

    <div
        class="modal fade modal-fullscreen"
        id="exampleModalBooks"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Pregled svih knjiga
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
                                    <th scope="col">Autor</th>
                                    <th scope="col">Godina</th>
                                    <th scope="col">Cijena</th>
                                    <th scope="col">Kategorija</th>
                                    <th scope="col">Slika</th>
                                    <th scope="col">Dodao</th>
                                    <th scope="col">Datum i vr. dodavanja</th>
                                    <th scope="col">Izbrisi</th>
                                    <th scope="col">Uredi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="knjiga in knjige">
                                    <th class="centered-content" scope="row">
                                        {{ knjiga.id }}
                                    </th>
                                    <td class="centered-content">
                                        {{ knjiga.ime }}
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.opis }}
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.autor }}
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.godina_izdanja }}
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.cijena }}
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.category.ime }}
                                    </td>
                                    <td class="centered-content">
                                        <img
                                            :src="'/images/' + knjiga.image"
                                            alt=""
                                            class="img-thumbnail"
                                            style="width: 50px"
                                        />
                                    </td>
                                    <td class="centered-content">
                                        {{ knjiga.user.ime }}
                                        {{ knjiga.user.prezime }}
                                    </td>
                                    <td class="centered-content">
                                        {{ formatirajDatum(knjiga.created_at) }}
                                    </td>
                                    <td class="">
                                        <button
                                            class="btn btn-outline-danger btn-sm"
                                            @click="izbrisiKnjigu(knjiga.id)"
                                        >
                                            Izbrisi
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-outline-primary btn-sm"
                                            type="button"
                                            data-bs-toggle="offcanvas"
                                            :data-bs-target="
                                                '#offcanvasExample' + knjiga.id
                                            "
                                            aria-controls="offcanvasExample"
                                            @click="urediKnjigu(knjiga)"
                                        >
                                            Uredi knjigu
                                        </button>
                                    </td>

                                    <div
                                        class="offcanvas offcanvas-start"
                                        tabindex="-1"
                                        :id="'offcanvasExample' + knjiga.id"
                                        aria-labelledby="offcanvasExampleLabel"
                                    >
                                        <div class="offcanvas-header">
                                            <h5
                                                class="offcanvas-title"
                                                id="offcanvasExampleLabel"
                                            >
                                                Uredi knjigu
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form
                                                @submit.prevent="
                                                    potvrdiUredjivanje(
                                                        knjiga.id
                                                    )
                                                "
                                            >
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Ime</span
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="recipient-name"
                                                        v-model="
                                                            urediKnjige.ime
                                                        "
                                                         :class="{
                                                            'is-invalid':
                                                                errors.ime,
                                                        }"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.ime"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.ime[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Opis</span
                                                    >
                                                    <textarea
                                                        class="form-control"
                                                        id="message-text"
                                                        v-model="
                                                            urediKnjige.opis
                                                        "
                                                         :class="{
                                                            'is-invalid':
                                                                errors.opis,
                                                        }"
                                                    ></textarea>
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.opis"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.opis[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Autor</span
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="recipient-name"
                                                        v-model="
                                                            urediKnjige.autor
                                                        "
                                                         :class="{
                                                            'is-invalid':
                                                                errors.autor,
                                                        }"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.autor"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.autor[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Godina</span
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="recipient-name"
                                                        v-model="
                                                            urediKnjige.godina_izdanja
                                                        "
                                                         :class="{
                                                            'is-invalid':
                                                                errors.godina_izdanja,
                                                        }"

                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.godina_izdanja"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.godina_izdanja[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Cijena</span
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="recipient-name"
                                                        :class="{
                                                            'is-invalid':
                                                                errors.cijena,
                                                        }"
                                                        v-model="
                                                            urediKnjige.cijena
                                                        "

                                                    />

                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.cijena"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.cijena[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Kategorija</span
                                                    >
                                                    <select
                                                        class="form-select"
                                                        id="trainSelect"
                                                        aria-label="Default select example"
                                                        v-model="
                                                            urediKnjige.category_id
                                                        "
                                                         :class="{
                                                            'is-invalid':
                                                                errors.category_id,
                                                        }"
                                                    >
                                                        <option
                                                            disabled
                                                            value=""
                                                        >
                                                            Kategorija
                                                        </option>
                                                        <option
                                                            v-for="kategorija in kategorije"
                                                            :value="
                                                                kategorija.id
                                                            "
                                                        >
                                                            {{ kategorija.ime }}
                                                        </option>
                                                    </select>
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.category_id"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.category_id[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="input-group input-group-sm mb-3"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        id="inputGroup-sizing-sm"
                                                        >Slika</span
                                                    >
                                                    <input
                                                        class="form-control form-control-sm"
                                                        id="formFileSm"
                                                        :class="{
                                                            'is-invalid':
                                                                errors.image,
                                                        }"
                                                        type="file"
                                                        @change="
                                                            urediKnjiguSlika
                                                        "
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        <p
                                                            v-if="errors.image"
                                                            class="text-danger"
                                                        >
                                                            {{
                                                                errors.image[0]
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <button
                                                    class="btn btn-outline-success w-100 btn-sm"
                                                >
                                                    Potrvrdi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="mt-3 mb-3 fw-bold" />
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
                                    Dodaj Knjigu
                                </button>
                            </h2>
                            <div
                                id="flush-collapseOne"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample"
                            >
                                <div class="accordion-body">
                                    <form @submit.prevent="dodajKnjigu()">
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Ime Knjige</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm"
                                                v-model="book.ime"
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
                                                >Opis knjige</span
                                            >
                                            <textarea
                                                class="form-control"
                                                placeholder="Ovdje dodajte opis kategorije..."
                                                v-model="book.opis"
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
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Autor</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm"
                                                v-model="book.autor"
                                                :class="{
                                                    'is-invalid': errors.autor,
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.autor"
                                                    class="text-danger"
                                                >
                                                    {{ errors.autor[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Godina izdanja</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm"
                                                v-model="book.godina_izdanja"
                                                :class="{
                                                    'is-invalid':
                                                        errors.godina_izdanja,
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.godina_izdanja"
                                                    class="text-danger"
                                                >
                                                    {{
                                                        errors.godina_izdanja[0]
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Cijena</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm"
                                                v-model="book.cijena"
                                                :class="{
                                                    'is-invalid': errors.cijena,
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.cijena"
                                                    class="text-danger"
                                                >
                                                    {{ errors.cijena[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Kategorija</span
                                            >
                                            <select
                                                class="form-select"
                                                id="trainSelect"
                                                aria-label="Default select example"
                                                v-model="book.category_id"
                                                :class="{
                                                    'is-invalid':
                                                        errors.category_id,
                                                }"
                                            >
                                                <option disabled value="">
                                                    <p class="text-muted">
                                                        Odaberite kategoriju
                                                        knjige...
                                                    </p>
                                                </option>
                                                <option
                                                    v-for="kategorija in kategorije"
                                                    :value="kategorija.id"
                                                >
                                                    {{ kategorija.ime }}
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.category_id"
                                                    class="text-danger"
                                                >
                                                    {{ errors.category_id[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="input-group input-group-sm mb-3"
                                        >
                                            <span
                                                class="input-group-text"
                                                id="inputGroup-sizing-sm"
                                                >Slika</span
                                            >
                                            <input
                                                class="form-control form-control-sm"
                                                id="formFileSm"
                                                type="file"
                                                ref="fileInput"
                                                :class="{
                                                    'is-invalid': errors.image,
                                                }"
                                                @change="slikaKnjige"
                                            />
                                            <div class="invalid-feedback">
                                                <p
                                                    v-if="errors.image"
                                                    class="text-danger"
                                                >
                                                    {{ errors.image[0] }}
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
import axios from "axios";

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
            book: {
                ime: "",
                opis: "",
                autor: "",
                godina_izdanja: "",
                category_id: "",
                image: "",
                cijena: "",
            },
            knjige: [],
            urediKnjige: {
                ime: "",
                opis: "",
                autor: "",
                godina_izdanja: "",
                category_id: "",
                image: "",
                cijena: "",
            },
            knjigaId: "",
            user:[],
            spinner: true
        };
    },
    created() {
        this.getAllUsers();
        this.dohvatiKategorije();
        this.dohvatiKnjige();
        this.jelPrijavljen();
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
                    this.kategorija.ime = "";
                    this.kategorija.opis = "";
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
        izbrisiKategoriju(id) {
            axios
                .post(`/izbrisiKategoriju/${id}`)
                .then((response) => {
                    this.poruka = response.data.poruka;
                    this.dohvatiKategorije();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        slikaKnjige(event) {
            this.book.image = event.target.files[0];
        },
        urediKnjiguSlika(event) {
            this.urediKnjige.image = event.target.files[0];
        },
        dodajKnjigu() {
            const Knjiga = new FormData();
            Knjiga.append("ime", this.book.ime);
            Knjiga.append("opis", this.book.opis);
            Knjiga.append("autor", this.book.autor);
            Knjiga.append("godina_izdanja", this.book.godina_izdanja);
            Knjiga.append("category_id", this.book.category_id);
            Knjiga.append("image", this.book.image);
            Knjiga.append("cijena", this.book.cijena);

            axios
                .post("/dodajKnjigu", Knjiga)
                .then((response) => {
                    console.log(response.data);
                    this.book.ime = "";
                    this.book.opis = "";
                    this.book.autor = "";
                    this.book.godina_izdanja = "";
                    this.book.category_id = "";
                    this.$refs.fileInput.value = "";
                    this.book.cijena = "";
                    this.errors = {};
                    this.dohvatiKnjige();
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
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
        izbrisiKnjigu(id) {
            axios
                .post(`/izbrisiKnjigu/${id}`)
                .then((response) => {
                    this.poruka = response.data.poruka;
                    this.dohvatiKnjige();
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        urediKnjigu(knjiga) {
            this.knjigaId = knjiga.id;
            this.urediKnjige.ime = knjiga.ime;
            this.urediKnjige.opis = knjiga.opis;
            this.urediKnjige.autor = knjiga.autor;
            this.urediKnjige.godina_izdanja = knjiga.godina_izdanja;
            this.urediKnjige.category_id = knjiga.category_id;
            this.urediKnjige.cijena = knjiga.cijena;
            this.urediKnjigeimage = knjiga.image;
            $("#exampleModalUredjivanje" + knjiga.id).modal("show");
        },

        potvrdiUredjivanje(id) {
            let Knjiga = new FormData();
            Knjiga.append("ime", this.urediKnjige.ime);
            Knjiga.append("opis", this.urediKnjige.opis);
            Knjiga.append("autor", this.urediKnjige.autor);
            Knjiga.append("godina_izdanja", this.urediKnjige.godina_izdanja);
            Knjiga.append("category_id", this.urediKnjige.category_id);
            Knjiga.append("image", this.urediKnjige.image);
            Knjiga.append("cijena", this.urediKnjige.cijena);

            axios
                .post(`/urediKnjigu/${id}`, Knjiga)
                .then((response) => {
                    this.poruka = response.data.poruka;

                    const knjiga = response.data.knjiga;
                    const index = this.knjige.findIndex(
                        (knjiga) => knjiga.id === this.knjigaId
                    );
                    if (index !== -1) {
                        this.knjige[index].ime = knjiga.ime;
                        this.knjige[index].opis = knjiga.opis;
                        this.knjige[index].autor = knjiga.autor;
                        this.knjige[index].cijena = knjiga.cijena;
                        this.knjige[index].category_id = knjiga.category_id;
                        this.knjige[index].godina_izdanja =
                            knjiga.godina_izdanja;
                        this.knjige[index].image = knjiga.image;
                    }
                    this.dohvatiKnjige();
                    $("#offcanvasExample" + this.knjigaId).offcanvas("hide");
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
        jelPrijavljen() {
            axios
                .get("/prijavljen")
                .then((response) => {
                    this.user = response.data.user;
                    this.isLogged = true;
                    if (this.isLogged == true) {
                        console.log("PRIJAVLJEN JE KORISNIK", this.user);
                    }
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.spinner = false;
                });
        },
    },
};
</script>

<style scoped>
.container {
    height: 400px;
}

.centered-content {
    vertical-align: middle;
}
</style>
