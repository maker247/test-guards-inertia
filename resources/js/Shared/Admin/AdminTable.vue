<script setup>
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Button } from '@/components/ui/button'
import { BadgePlus } from 'lucide-vue-next'
import { Pencil } from 'lucide-vue-next'
import { CircleX } from 'lucide-vue-next'
import Pagination from './Pagination.vue'
import {ref, watch} from "vue"
import { router } from '@inertiajs/vue3'
import debounce from "lodash/debounce"

let props = defineProps({
    create: String,
    admins: Object,
    filters: Object
})

let search = ref(props.filters.search)

watch(search, debounce(function (value) {
    router.get(route('admin.admins.index'), {
            search: value
        },
        {
            preserveState: true,
            replace: true
        })
, 500}))

</script>

<template>
    <div class="w-full">
        <div class="flex justify-between items-center py-4">
                <Input
                    v-model="search"
                    class="max-w-sm"
                    placeholder="Search..."
                />

                <Button>
                    <Link :href="create" class="flex items-center">
                        <BadgePlus class="w-4 h-4 mr-1" />
                        <span class="text-sm uppercase">create</span>
                    </Link>
                </Button>

        </div>

        <div class="rounded-md border mb-4">
            <Table>
                <TableHeader>
                    <TableRow>
<!--                        <TableHead class="w-[100px] py-4">-->
<!--                            <Checkbox id="terms" />-->
<!--                        </TableHead>-->
                        <TableHead class="uppercase py-4">Name</TableHead>
                        <TableHead class="uppercase py-4">Email</TableHead>
                        <TableHead class="uppercase py-4">
                            Action
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="admin in admins.data">
<!--                        <TableCell class="py-2 font-medium">-->
<!--                            <Checkbox id="terms" />-->
<!--                        </TableCell>-->
                        <TableCell class="py-2">{{ admin.name }}</TableCell>
                        <TableCell class="py-2">{{ admin.email }}</TableCell>
                        <TableCell class="py-2 space-x-2">
                            <Button variant="ghost" size="icon">
                                <Pencil class="w-4 h-4" />
                            </Button>

                            <Button variant="ghost" size="icon">
                                <CircleX class="w-4 h-4" />
                            </Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <Pagination :admins="admins" />
    </div>
</template>
