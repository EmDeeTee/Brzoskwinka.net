<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';
import Dropdown from './Dropdown.vue';
import { ref } from 'vue';
import { loadLanguageAsync  } from 'laravel-vue-i18n'; 

let lang = ref<string>('en')

function changeLang() {
    if (lang.value === 'en') {
        loadLanguageAsync('pl')
        lang.value = 'pl'
    } else {
        loadLanguageAsync('en')
        lang.value = 'en'
    }
}
</script>

<template>
    <div>
        <button @click="changeLang()" class="items-center  font-semibold text-xs text-white uppercase  hover:ml-1  transition ease-in-out duration-150">{{ lang }}</button>
    </div>
</template>
