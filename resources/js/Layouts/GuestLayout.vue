<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import LangButtons from '@/Components/LangButtons.vue';
</script>

<template>
    <div>
        <div class="fixed w-full h-9 text-white space-x-4 justify-end flex flex-grow-0" style="background-color: #88527F;">
            <LangButtons class="justify-start flex flex-grow pl-2" />

            <PrimaryButton class="mt-1 mb-1"><Link href="/login">{{$t('l.login')}}</Link></PrimaryButton>
            <PrimaryButton class="mt-1 mb-1"><Link href="/register">{{$t('l.register')}}</Link></PrimaryButton>
        </div>

        <div>
            <slot />
        </div>
    </div>
</template>
