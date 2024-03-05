<script setup>
import axios from "axios";
</script>

<template>
    <div class="container-fluid">
        <div
            class="login-form d-flex flex-column justify-content-center align-items-center vh-100"
        >
            <form
                class="bg-light p-5 col-12 col-lg-4 col-md-10 col-sm-10 shadow-lg"
                @submit.prevent="registracija()"
            >
                <div
                    class="head-items d-flex gap-2 justify-content-center align-items-center mb-3"
                >
                    <img
                        src="../images/logo.png"
                        alt=""
                        height="30px"
                        width="auto"
                    />
                    <h3>Registracija</h3>
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Ime"
                        aria-describedby="emailHelp"
                        autocomplete="off"
                        v-model="register.ime"
                        :class="{ 'is-invalid': errors.ime }"
                    />

                    <div class="invalid-feedback">
                        <p v-if="errors.ime" class="text-danger">
                            {{ errors.ime[0] }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Prezime"
                        aria-describedby="emailHelp"
                        autocomplete="off"
                        v-model="register.prezime"
                        :class="{ 'is-invalid': errors.prezime }"
                    />
                    <div class="invalid-feedback">
                        <p v-if="errors.prezime" class="text-danger">
                            {{ errors.prezime[0] }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Email"
                        autocomplete="off"
                        v-model="register.email"
                        :class="{ 'is-invalid': errors.email }"
                    />

                    <div class="invalid-feedback">
                        <p v-if="errors.email" class="text-danger">
                            {{ errors.email[0] }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword1"
                        placeholder="Lozinka"
                        autocomplete="off"
                        v-model="register.password"
                        :class="{ 'is-invalid': errors.password }"
                    />
                    <div class="invalid-feedback">
                        <p v-if="errors.password" class="text-danger">
                            {{ errors.password[0] }}
                        </p>
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary w-100 shadow-none regBtn"
                >
                    Registracija
                </button>
                <p class="text-center mt-3">
                    Imaš račun?
                    <span
                        ><router-link
                            class="text-decoration-underline"
                            style="color: #0096b5"
                            to="/"
                            >Prijava</router-link
                        ></span
                    >
                </p>
                <div class="mt-3 alert alert-info text-center" v-if="uspjesnaPrijava">
                    Registracija je uspješna
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            register: {
                ime: "",
                prezime: "",
                email: "",
                password: "",
            },
            errors: {},
            uspjesnaPrijava: false,
        };
    },
    methods: {
        registracija() {
            const Data = {
                ime: this.register.ime,
                prezime: this.register.prezime,
                email: this.register.email,
                password: this.register.password,
            };

            axios
                .post("/registracija", Data)
                .then((response) => {
                    this.uspjesnaPrijava = true;
                    this.errors = {};
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
    },
};
</script>

<style scoped>
.container-fluid {
    background-image: url("../images/background.jpg");
    height: 100vh;
}

.regBtn {
    background-color: #0096b5;
    border: none;
}
</style>
