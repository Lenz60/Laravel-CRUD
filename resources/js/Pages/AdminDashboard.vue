<template>
    <div>
        <Head title="Profile" />

        <!-- <div class="text-white">
            <p>{{ $page.props.auth.user }}</p>
            <p>
                The diverse and plentiful experience the bounds and place of
                personnel training contributes to the preparing and
                implementation of new propositions. Thus social economic
                development contributes to the preparing and implementation of
                the step-by-step consistent development of the society. The
                significance of such problems is so obvious that new model of
                the organisational activity plays an important part in the
                formation of existing financial and administrative conditions.
            </p>
        </div> -->

        <AuthenticatedLayout Role="Admin">
            <template #header>
                <h2 class="font-semibold text-xl leading-tight">Dashboard</h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
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
    </div>
</template>

<script>
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    components: {
        Head,
        AuthenticatedLayout,
        usePage,
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
