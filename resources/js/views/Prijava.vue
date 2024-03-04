<script setup>
import axios from 'axios';
</script>

<template>

    <div class="container-fluid">
        <div class="login-form  d-flex flex-column justify-content-center align-items-center vh-100">
            <form class="bg-light p-5 col-12 col-lg-4 col-md-10 col-sm-10 shadow-lg" @submit.prevent="prijava()">
                <div class="head-items d-flex gap-2 justify-content-center align-items-center mb-3">
                    <img
                        src="../images/logo.png"
                        alt=""
                        height="30px"
                        width="auto"
                    />
                    <h3>Prijava</h3>
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="Email"
                        v-model="data.email"
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
                        v-model="data.password"
                        :class="{ 'is-invalid': errors.password }"

                    />
                    <div class="invalid-feedback">
                        <p v-if="errors.password" class="text-danger">
                            {{ errors.password[0] }}
                        </p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 shadow-none logBtn">Prijava</button>
                <p class="text-center mt-3">Nemaš račun? <span><router-link class="text-decoration-underline" style="color:#0096B5" to="/register">Registriraj se</router-link></span></p>
                <router-link to="/home" style="color:#0096B5; font-size: 13px;" class="text-center text-decoration-underline" ><p class="text-center">Pogledaj kao gost</p></router-link>
                <div class="mt-3 alert alert-info" v-if="neuspjesnaPrijava">
                    Pogrešan email ili lozinka
                </div>
            </form>
        </div>
    </div>
</template>

<script>

   export default {
        data(){
            return{
                data:{
                    email:'',
                    password:''
                },
                errors:{},
                neuspjesnaPrijava:false,
                poruka:''
            }
        },
       methods: {
           prijava() {
            const Data = {
                email: this.data.email,
                password: this.data.password
            }
               axios.post('/prijava', Data)
                   .then((response) => {
                       this.poruka = response.data.message;
                        console.log(this.poruka)
                       if(this.poruka == "Uspjesna prijava"){
                            this.$router.push("/home");
                       }else{
                            this.neuspjesnaPrijava = true;
                       }
                   })
                   .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.neuspjesnaPrijava = false;
                        console.log(error);
                    }
                });
           }
       }
   }

</script>

<style scoped>


.container-fluid {
    background-image: url("../images/background.jpg");
    height: 100vh;
}

.logBtn{
    background-color: #0096B5;
    border:none;
}

</style>
