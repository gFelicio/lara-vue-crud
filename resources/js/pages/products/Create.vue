<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Product',
        href: '/products/create',
    },
];

const form = useForm({
    name: '',
    price: '',
    description: ''
});

const handleSubmit = () => {
    console.log('form', form)
    form.post(route('products.store'))
};

</script>

<template>
    <Head title="Create Product" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="handleSubmit"
                class="w-b/12 space-y-4">
                <div class="space-y-2">
                    <Label for="Product name">
                        Name
                    </Label>

                    <Input type="text"
                        placeholder="Name"
                        v-model="form.name"/>

                    <div class="text-sm text-red-600"
                        v-if="form.errors.name">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="space-y-2">
                    <Label for="Product price">
                        Price
                    </Label>

                    <Input type="number"
                        placeholder="Price"
                        v-model="form.price"/>

                    <div class="text-sm text-red-600"
                        v-if="form.errors.price">
                        {{ form.errors.price }}
                    </div>
                </div>

                <div class="space-y-2">
                    <Label for="Product description">
                        Description
                    </Label>

                    <Input type="text"
                        placeholder="Description"
                        v-model="form.description"/>

                    <div class="text-sm text-red-600"
                        v-if="form.errors.description">
                        {{ form.errors.description }}
                    </div>
                </div>

                <Button type="submit"
                    :disabled="form.processing">
                    Add Product
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
