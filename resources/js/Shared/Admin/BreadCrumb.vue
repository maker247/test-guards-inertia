<script setup>
import {computed} from "vue"
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb'

import { Link } from "@inertiajs/vue3"

const props = defineProps({
    breadcrumb: Array
})

const dashboardRoute = route('admin.dashboard')

const crumbs = computed(() => {
    let crbs = [...props.breadcrumb]

    crbs.pop()

    return crbs
})

const lastCrumb = computed(() => {
    let crbs = [...props.breadcrumb]

    let last = crbs.pop()

    return last
})
</script>

<template>
    <Breadcrumb>
        <BreadcrumbList>
            <BreadcrumbItem>
                <Link class="capitalize" :href="dashboardRoute">Dashboard</Link>
            </BreadcrumbItem>
            <BreadcrumbSeparator />

            <BreadcrumbItem
                v-if="crumbs.length"
                v-for="(crumb, index) in crumbs"
                :key="index"
            >
                <Link class="capitalize" :href="crumb.url">
                    {{ crumb.name }}
                </Link>
                <BreadcrumbSeparator />
            </BreadcrumbItem>

            <BreadcrumbItem>
                <BreadcrumbPage class="capitalize">{{ lastCrumb.name }}</BreadcrumbPage>
            </BreadcrumbItem>
        </BreadcrumbList>
    </Breadcrumb>
</template>
