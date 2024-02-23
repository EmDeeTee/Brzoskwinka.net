<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Login from './Login.vue';
import Register from './Register.vue';
import NavLink from '@/Components/NavLink.vue';


</script>

<template>

    <GuestLayout>
        <div class="flex flex-row">
            <div class="w-1/2">
                <Login />
            </div>
            <div class="w-1/2 flex flex-col border-l-slate-500 border-2 items-center justify-center" style="background-color: #c2c2c2;">
                <h1 class="font-bold upper text-2xl">Don't have an account yet?</h1>
                <NavLink class="text-white text-xl" href="register">Register</NavLink>
            </div>
        </div>
    </GuestLayout>    
</template>