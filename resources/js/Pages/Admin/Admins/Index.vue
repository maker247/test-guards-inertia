<script setup>
import Layout from '@/Shared/Admin/Layout.vue'
import ContentContainer from "@/Shared/Admin/ContentContainer.vue"
import AdminTable from "@/Shared/Admin/AdminTable.vue"
import {computed} from "vue";

const breadcrumb = [
    {
        name: 'admin',
        url: route('admin.admins.index')
    }
]

defineProps({
    admins: Object,
    filters: Object
})

const createRoute = computed(() => route('admin.admins.create'))
</script>

<template>
    <div class="hidden flex-col md:flex">
        <Layout>
            <ContentContainer
                title="admins"
                :breadcrumb="breadcrumb"
            >
                <AdminTable
                    :create="createRoute"
                    :admins="admins"
                    :filters="filters"
                />
            </ContentContainer>
        </Layout>
    </div>
</template>
