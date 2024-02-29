
<script setup>
import Navigacija from "../components/Navigacija.vue";
import Bottom from "../components/Bottom.vue";

</script>

<template>
    <Navigacija/>
    <div>

        <div class="sidebar col-2 bg-light shadow-lg">
            <div>
                <ul>
                    <li >
                        <router-link to="/admin/users">Users</router-link>
                    </li>
                    <li>
                        <router-link to="/admin/books">Books</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <Bottom/>
</template>



<style scoped>
    .sidebar{
        border: 1px solid gray;
        height: calc(100vh - 56px);
    }
</style>
