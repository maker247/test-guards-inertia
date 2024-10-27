<template>
    <div class="flex items-center my-5 px-5">
        <BreadCrumb :breadcrumb="breadcrumb" />
    </div>

    <ScrollArea class="h-screen flex">
        <Card class="mx-5 pb-5">
            <CardHeader>
                <CardTitle class="uppercase">{{ title }}</CardTitle>
            </CardHeader>
            <CardContent>
                <slot />
            </CardContent>
        </Card>
    </ScrollArea>
</template>

<script setup>
import { ScrollArea } from '@/components/ui/scroll-area'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import BreadCrumb from "./BreadCrumb.vue"

defineProps({
    title: String,
    breadcrumb: Array
})

</script>
