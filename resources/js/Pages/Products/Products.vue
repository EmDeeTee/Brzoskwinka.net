<script setup lang="ts" >
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ShopPanel from '@/Components/ShopPanel.vue';
import { Product } from '@/types/index'

const laptops:Product[] = [
    {
        name: "Dell Inspiron 1525",
        price: 50,
        category: "laptops",
        imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg",
        id: 0
    },
    {
        name: "Dell Inspiron 1525",
        price: 50,
        category: "laptops",
        imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg",
        id: 1
    },
    {
        name: "Dell Inspiron 1525",
        price: 50,
        category: "laptops",
        imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg",
        id: 2
    },
]
</script>

<template>
    <GuestLayout>
        <div className="py-20 mx-auto max-w-5xl bg-orange-0 space-y-8">
            <ShopPanel :title="$t('laptops').toUpperCase()" :products="laptops" />
            <ShopPanel :title="$t('pcs').toUpperCase()" :products="laptops" />
            <ShopPanel :title="$t('monitors').toUpperCase()" :products="laptops" />
        </div>
    </GuestLayout>
</template>