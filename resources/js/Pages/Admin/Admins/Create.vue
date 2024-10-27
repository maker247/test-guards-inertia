<script setup>
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { useForm } from '@inertiajs/vue3'
import Layout from '@/Shared/Admin/Layout.vue'
import ContentContainer from "@/Shared/Admin/ContentContainer.vue"
import {computed} from "vue";

const indexRoute = route('admin.admins.index')

const breadcrumb = [
    {
        name: 'admin',
        url: indexRoute
    },
    {
        name: 'create',
        url: route('admin.admins.create')
    }
]

const form = useForm({
    email: null,
    password: null,
    name: null
})

const errors = computed(() => form.errors)

const submit = () => {
    form.post(route("admin.admins.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
    })
}

</script>

<template>
    <div class="hidden flex-col md:flex">
        <Layout>
            <ContentContainer
                title="admins"
                :breadcrumb="breadcrumb"
            >
                <form @submit.prevent="submit" class="py-4">
                    <div class="mb-5">
                        <div class="flex gap-6 mb-3">
                            <div class="w-1/2">
                                <Label for="name" class="capitalize mb-3">name</Label>
                                <Input v-model="form.name" placeholder="Enter name..." id="name" type="text" />
                                <div class="text-xs text-red-500 mt-1" v-if="errors.name">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <div class="w-1/2">
                                <Label for="email" class="capitalize mb-3">email</Label>
                                <Input v-model="form.email" placeholder="Enter email..." id="email" type="text" />
                                <div class="text-xs text-red-500 mt-1" v-if="errors.email">
                                    {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="w-full mb-3">
                            <Label for="password" class="capitalize mb-3">password</Label>
                            <Input v-model="form.password" placeholder="Enter password..." id="password" type="password" />
                            <div class="text-xs text-red-500 mt-1" v-if="errors.password">
                                {{ errors.password }}
                            </div>
                        </div>
                    </div>


                    <div class="w-full space-x-4">
                        <Button variant="secondary">
                            <Link :href="indexRoute">
                                Cancel
                            </Link>
                        </Button>

                        <Button type="submit">
                            Submit
                        </Button>
                    </div>
                </form>
            </ContentContainer>
        </Layout>
    </div>
</template>
