<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useToast, POSITION, TYPE} from "vue-toastification";
import { ref } from 'vue';

const toast = useToast();
const form = useForm({
    name: '',
    description: '',
    price: 1,
    units: 1,
    category: 'other',
    imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg" // NOTE: For now, users can only point to an image from the Internet
});

const submit = () => {
    form.post(route('products.add'), {
        onSuccess: () => {
            toast("Listing created!", {
                position: POSITION.BOTTOM_CENTER,
                type: TYPE.SUCCESS
            });
        },
    });
};

</script>
<template>
    <div class="py-20 px-4 max-w-4xl mx-auto">
        <form @submit.prevent="submit" class="space-y-4">
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div>
            <InputLabel for="description" value="Description" />

            <textarea 
                id="description"
                type="text"
                class="mt-1 block w-full"
                v-model="form.description"
                required
            > 
                
            </textarea>
                

            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div>
            <InputLabel for="price" value="Price (PLN)" />

            <TextInput
                id="price"
                type="number"
                step="0.01"
                class="mt-1 block w-full"
                v-model.number="form.price"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.price" />
        </div>

        <div>
            <InputLabel for="units" value="Units" />

            <TextInput
                id="units"
                type="number"
                class="mt-1 block w-full"
                v-model.number="form.units"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.units" />
        </div>

        <div>
            <InputLabel for="category" value="Category" />

            <select class="mt-1 block w-full" required id="category" v-model="form.category">
                <option value="laptops">Laptops</option>
                <option value="other">Other</option>
            </select>

            <InputError class="mt-2" :message="form.errors.category" />
        </div>

        <div>
            <InputLabel for="imgSrc" value="Image URL" />

            <TextInput
                id="imgSrc"
                type="text"
                class="mt-1 block w-full"
                v-model="form.imgSrc"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.imgSrc" />
        </div>

        <div class="flex flex-col justify-center items-center mt-4 space-y-2">
            <Link
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Already registered?
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                ADD
            </PrimaryButton>
        </div>
    </form>
    </div>
</template>

<script lang="ts">
    export default {
        layout: GuestLayout
    }
</script>