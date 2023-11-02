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
                                    <td>
                                        <button
                                            @click="toggleModal(member)"
                                            class="btn btn-outline btn-accent rounded-md"
                                        >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModal">
            <div v-if="showModal">
                <ModalEdit
                    :id="selectedId"
                    :name="selectedName"
                    :email="selectedEmail"
                    :ktp="selectedKtp"
                    :telephone="selectedTelephone"
                    :gender="selectedGender"
                    :birth="selectedBirth"
                    @close="toggleModal()"
                    class="w-full"
                >
                    <template name="content"> </template>
                </ModalEdit>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ModalEdit from "./Modal/ModalEdit.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
export default {
    props: ["data", "string"],
    components: {
        Head,
        AuthenticatedLayout,
        ModalEdit,
    },
    setup() {
        const selectedId = "";
        const selectedName = "";
        const selectedEmail = "";
        const selectedKtp = "";
        const selectedTelephone = "";
        const selectedGender = "";
        const selectedBirth = "";

        const showModal = ref(false);
        return { showModal };
    },
    methods: {
        toggleModal(data) {
            // console.log(this.showModal);
            // console.log(data);
            if (!this.showModal) {
                this.selectedId = data.id;
                this.selectedName = data.name;
                this.selectedEmail = data.email;
                this.selectedKtp = data.ktp;
                this.selectedTelephone = data.telephone;
                this.selectedGender = data.gender;
                this.selectedBirth = data.birth;
            }
            // console.log(this.selectedBirth);
            this.showModal = !this.showModal;
        },
    },
};
</script>

<style lang="scss" scoped></style>
