<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";
</script>

<template>
    <Navigacija />
    <div class="contact">
        <h1 class="text-center mt-5">Kontaktiraj nas</h1>
        <p class="text-center mt-3">
            Imate pitanja? Kontaktirajte nas putem e-maila ili društvenih mreža.
        </p>
        <div
            class="login-form d-flex flex-column justify-content-center align-items-center mt-5"
        >
            <form
                class="bg-light p-5 col-12 col-lg-4 col-md-10 col-sm-10 shadow-lg"
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
                    <h3>Kontakt</h3>
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Ime"
                        aria-describedby="emailHelp"
                        required
                    />
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Email"
                        autocomplete="off"
                        required
                    />
                </div>
                <div class="form-floating">
                    <textarea
                        class="form-control"
                        placeholder="Leave a comment here"
                        id="floatingTextarea"
                        required
                    ></textarea>
                    <label for="floatingTextarea">Comments</label>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary w-100 shadow-none regBtn mt-3"
                >
                    Pošalji
                </button>
            </form>
        </div>
    </div>
    <Bottom />
</template>

<script></script>

<style scoped>
.contact {
    background-image: url("../images/mountains.png");

    background-size: cover;
    background-repeat: no-repeat;
    height: 900px;
}

.regBtn {
    background-color: #0096b5;
    border: none;
}
</style>
