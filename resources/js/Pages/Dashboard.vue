<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Product } from '@/types';
import { Head } from '@inertiajs/vue3';
import { PropType } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    listings: Object as PropType<Product>
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="p-4 border-b text-2xl font-bold">Your listings</h1>
                    <div class="p-6 text-gray-900 space-y-2">
                        <div v-if="props.listings.length > 0" v-for="listing in props.listings">
                            <Link :href="'/products/' + listing.id">
                                {{ listing.name }}
                            </Link>
                        </div>
                        <div v-else>
                            <h1>You don't have any listings on <span class="font-bold text-orange-600"> Brzoskwinka.Net </span></h1>
                            
                            <h1>Would you like to add a new
                                <Link :href="'/products/add'" class="w-1">
                                    <span class="font-bold hover:underline">listing?</span>
                                </Link>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
