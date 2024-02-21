<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    price: 1,
    imageSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg" // NOTE: For now, users can only point to an image from the Internet
});

const submit = () => {
    form.post(route('products.add'), {
        onFinish: () => {
            console.log("FORM UPLOADED")
        },
    });
};

</script>
<template>
    <GuestLayout>
        <div class="py-20 max-w-2xl flex justify-center mx-auto ">
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
                <InputLabel for="price" value="Price (PLN)" />

                <TextInput
                    id="price"
                    type="number"
                    class="mt-1 block w-full"
                    v-model.number="form.price"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.price" />
            </div>

            <div>
                <InputLabel for="imageSrc" value="Image URL" />

                <TextInput
                    id="imageSrc"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.imageSrc"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.imageSrc" />
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
    </GuestLayout>
</template>