<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout Role="Admin">
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Manage Member Data
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table bg-neutral m-2 rounded-md">
                            <caption class="text-base-300 text-xl">
                                List Member Yang Terdaftar
                            </caption>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>KTP</th>
                                    <th>No Hp</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="member in data">
                                    <td>
                                        {{ member.id }}
                                    </td>
                                    <td>{{ member.name }}</td>
                                    <td>{{ member.email }}</td>
                                    <td>{{ member.ktp }}</td>
                                    <td>{{ member.telephone }}</td>
                                    <td>{{ member.gender }}</td>
                                    <td>{{ member.birth }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="p-6 text-gray-900">
                        Halo {{ $page.props.auth.user.name }}
                    </div>
                    <div>
                        <p class="p-6 text-gray-900">
                            Anda terdaftar pada {{ convertedDate }}
                        </p>
                    </div> -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    props: ["data", "string"],
    components: {
        AuthenticatedLayout,
    },
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
