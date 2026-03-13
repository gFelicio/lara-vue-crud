<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const page = usePage()
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


            <Link :href="route('products.create')">
                <Button>
                    Create Product
                </Button>
            </Link>
        </div>
    </AppLayout>
</template>
