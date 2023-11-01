<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        usePage,
        AuthenticatedLayout,
    },
    setup() {
        const user = usePage().props.auth.user;
        const date = new Date(user.created_at);
        const convertedDate = date.toDateString();

        // const formatedDate = date("d F Y", user.created_at);
        return { convertedDate };
    },
};
</script>

<style lang="scss" scoped></style>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout Role="Member">
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Halo {{ $page.props.auth.user.name }}
                    </div>
                    <div>
                        <p class="p-6 text-gray-900">
                            Anda terdaftar pada {{ convertedDate }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
