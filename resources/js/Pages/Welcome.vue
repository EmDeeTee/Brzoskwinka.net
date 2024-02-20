<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowDownIcon, CheckCircle, Gem, Sword } from "lucide-vue-next";
import { loadLanguageAsync  } from 'laravel-vue-i18n'; 
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    peachImg: string;
}>();

const perks = [
  {
    name: "Najniższe ceny",
    icon: CheckCircle,
    desc: "Gwarancja najniższych cen"
  },
  {
    name: "Wysoka jakość usług",
    icon: Gem,
    desc: "veri gud usługi"
  },
  {
    name: "blah blah blah",
    icon: Sword,
    desc: "papkin"
  },
]
</script>

<template>
    <GuestLayout>
    <div className="py-20 mx-auto text-center flex flex-col items-center max-w-3xl">
          <img :src="props.peachImg" alt="peach" width=40 height=30 />
          <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
            {{$t('lp.header')}}
            <span className="text-orange-600">Brzoskwinka.Net</span>
          </h1>
          <div className="flex flex-col sm:flex-row gap-4 mt-6">
            <Link href='/products' class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">{{$t('lp.store.button')}}</Link>
          </div>
        </div>
    </GuestLayout>

    <div className="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-0">
        <div v-for="perk in perks">
              <div key={perk.name} className="text-center md:flex md:text-left lg:block lg:text-center">
                <div className="md:flex-shrink-0 flex justify-center">
                  <div className="h-16 w-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-900">
                    <div :v-html="perk.icon">

                    </div>
                  </div>
                </div>

                <div className="mt-6 md:ml-4 md:mt-0 lg:ml-0 lg:mt-6">
                   <h3 className="text-base font-medium text-gray-900">{{perk.name}}</h3>
                   <p className="mt-3 text-sm text-muted-foreground">
                    {{perk.desc}}
                   </p>
                </div>
              </div>
          </div>
        </div>
</template>

