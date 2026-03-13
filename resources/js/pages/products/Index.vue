<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue'
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

interface Product {
    id: number,
    name: string,
    price: number,
    description: string,
}

interface Props {
    products: Product[],
}

// how you get props from inertiajs
const props = defineProps<Props>();

const page = usePage()

const handleDelete = (id: number) => {
    if (confirm('Do you wnat to delete this Product?')) {
        router.delete(route('products.destroy', {id}))
    }
}
</script>

<template>
    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div v-if="page.props.flash?.message" class="mb-4">
                <Alert class="bg-blue-200">
                    <AlertTitle>
                        Attention!
                    </AlertTitle>

                    <AlertDescription>
                        {{ page.props.flash?.message }}
                    </AlertDescription>
                </Alert>
            </div>

            <div class="m-3">
                <Link :href="route('products.create')">
                    <Button>
                        Create Product
                    </Button>
                </Link>
            </div>

            <div>
                <Table>
                    <TableCaption>
                        Products List
                    </TableCaption>

                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">
                                Product
                            </TableHead>

                            <TableHead>
                                Name
                            </TableHead>

                            <TableHead>
                                Price
                            </TableHead>

                            <TableHead>
                                Description
                            </TableHead>

                            <TableHead class="text-center">
                                Action
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="product in props.products" :key="product.id">
                            <TableCell>
                                {{ product.id }}
                            </TableCell>

                            <TableCell>
                                {{ product.name }}
                            </TableCell>

                            <TableCell>
                                {{ product.price }}
                            </TableCell>

                            <TableCell>
                                {{ product.description }}
                            </TableCell>

                            <TableCell class="text-center space-x-2">
                                <Link :href="route('products.edit', {id: product.id})">
                                    <Button class="bg-slate-600">
                                        Edit
                                    </Button>
                                </Link>

                                <Button class="bg-red-600"
                                    @click="handleDelete(product.id)">
                                    Delete
                                </Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
