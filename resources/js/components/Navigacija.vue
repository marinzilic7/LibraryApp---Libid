<template>
    <div>
        <nav
            class="navbar navbar-expand-lg shadow-sm"
            style="background-color: #f0f2f5"
        >
            <div class="container-fluid">
                <a class="navbar-brand" href="#"
                    ><img src="../images/logo.png" height="25px" alt=""
                /></a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link text-dark" to="/home"
                                >Libid</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link text-dark" to="/books"
                                >Knjige</router-link
                            >
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button class="btn btn-sm bg-transparent">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="25"
                                height="25"
                                fill="currentColor"
                                class="bi bi-cart2 me-2"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"
                                />
                            </svg>
                            </button>
                        </li>
                    </ul>

                    <form class="d-flex" role="search">
                        <input
                            class="form-control me-2 text-dark shadow-none searchBar"
                            type="search"
                            placeholder="Pretrazi knjige..."
                            aria-label="Search"
                        />
                        <button class="btn btn-outline-dark" type="submit">
                            Search
                        </button>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown" v-if="isLogged">
                            <a
                                class="nav-link dropdown-toggle text-dark"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{ user.ime }}
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown"
                            >
                                <li
                                    v-if="user.uloga === 'admin'"
                                    class="dropdown-item text-center"
                                >
                                    <router-link
                                        class="nav-link text-dark"
                                        to="/admin"
                                        >Administracija</router-link
                                    >
                                </li>
                                <li class="dropdown-item">
                                    <a
                                        @click="odjava()"
                                        class="dropdown-item text-center"
                                        href="#"
                                    >
                                        Odjava
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            isLogged: false,
            user: [],
        };
    },
    created() {
        this.jelPrijavljen();
    },
    methods: {
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
                });
        },
        odjava() {
            axios
                .post("/odjava")
                .then((response) => {
                    this.isLogged = false;
                    this.$router.push("/");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.searchBar:focus {
    color: #fff;
    border-color: #000;
    box-shadow: none;
}

.searchBar::placeholder {
    font-size: 14px;
}
</style>
