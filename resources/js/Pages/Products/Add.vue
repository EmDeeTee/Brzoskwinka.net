<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useToast, POSITION, TYPE} from "vue-toastification";
import { ref } from 'vue';
import PictureInput from 'vue-picture-input'


const imageInput = ref()
const toast = useToast();
const form = useForm({
    name: '',
    description: '',
    price: 1,
    units: 1,
    category: 1,
    imgSrc: null,
    attributes: {
        "hasCertificate": false,
    },
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

function onImageChange(event) {
    // TODO: Proper error handling
    if (event) {
        console.log(imageInput.value.file);
        form.imgSrc = imageInput.value.file
    } else {
        console.log("error 'onImageChange - Add.vue'");
    }
}

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
                <option :value="2">Laptops</option>
                <option :value="1">Other</option>
            </select>

            <InputError class="mt-2" :message="form.errors.category" />
        </div>

        <div class="flex space-x-2 items-center" v-if="$page.props.auth.isUserAdmin === true">
            <input class="cursor-pointer" type="checkbox" name="cert" v-model="form.data().attributes.hasCertificate">
            <InputLabel for="attributes" value="Certificate" />
            <!-- TODO: This could be a component -->
            <div v-tooltip="'This option is available because you are an admin'" class="bg-red-400 rounded-lg p-1 select-none">
                <p class="font-semibold">ADMIN OPTION</p>
            </div>


            <InputError class="mt-2" :message="form.errors.category" />
        </div>

        <div>
            <InputLabel value="Image" />

            <picture-input
                ref="imageInput"
                width="600"
                height="600"
                accept="image/jpeg,image/png"
                @change="onImageChange">
            </picture-input>
        </div>

        <div class="flex flex-col justify-center items-center mt-4 space-y-2">

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
