<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowDownIcon, CheckCircle, Gem, Sword } from "lucide-vue-next";
import { loadLanguageAsync  } from 'laravel-vue-i18n'; 
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    peachImg: string;
}>();
</script>

<template>
  <GuestLayout>
    <div className="py-20 mx-auto text-center flex flex-col items-center max-w-3xl">
      <img :src="props.peachImg" alt="peach" width=40 height=30 />
      <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl ">
        {{$t('lp.header')}}
        <span className="text-orange-600">Brzoskwinka.Net</span>
      </h1>
      <div className="flex flex-col sm:flex-row gap-4 mt-6">
        <Link href='/products' class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">{{$t('lp.store.button')}}</Link>
      </div>
    </div>
  </GuestLayout>
</template>

