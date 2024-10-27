<script setup>
import {
    Button,
} from '@/components/ui/button'

import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/components/ui/pagination'

defineProps({
    admins: Object
})
</script>

<template>
    <div class="flex items-center justify-between border-gray-200 px-4 py-3 sm:px-6">
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ admins.from }}</span>
                        to
                        <span class="font-medium">{{ admins.to }}</span>
                        of
                        <span class="font-medium">{{ admins.total }}</span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <template :key="index" v-for="(link, index) in admins.links">
                            <Link v-if="index === 0" :href="link.url ?? ''" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-slate-800 focus:z-20 focus:outline-offset-0" preserve-scroll>
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                            <Link preserve-scroll v-else-if="index === (admins.links.length - 1)" :href="link.url ?? ''" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-slate-800 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                            <Link preserve-scroll v-else :href="link.url ?? ''" :aria-current="link.active ? 'page' : ''"
                                  class="relative hover:bg-slate-800 z-10 ring-1 ring-inset ring-slate-300 inline-flex items-center px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                  :class="link.active ? 'bg-slate-900' : ''"
                            >{{ link.label }}</Link>
                        </template>
                    </nav>
                </div>
            </div>
        </div>
</template>
