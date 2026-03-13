<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue';
import type { BreadcrumbItem } from '@/types';

interface Product {
    id: number,
    name: string,
    price: number,
    description: string
}

const props = defineProps<{product: Product}>()

const form = useForm({
    id: props.product.id,
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
});

const handleSubmit = () => {
    console.log('form', form)
    form.put(route('products.update', {product: props.product}))
};

</script>

<template>
    <Head title="Edit Product" />

    <AppLayout :breadcrumbs="[
        {
            title: 'Edit Product',
            href: `/products/${props.product.id}/edit`,
        },
    ]">
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
                    Update Product
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
