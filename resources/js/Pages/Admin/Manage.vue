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

                        <div
                            class="w-fit bg-neutral-content m-5 flex flex-col justify-center items-center card shadow-md p-5"
                        >
                            <h1 class="text-lg text-base-300 p-5">
                                Tambahkan Akun Member Baru
                            </h1>
                            <form
                                ref="adminMemberForm"
                                @submit.prevent="submit"
                                enctype="multipart/form-data"
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel for="email" value="Email" />

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.email"
                                    />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="ktp" value="KTP" />

                                    <TextInput
                                        id="ktp"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.ktp"
                                        required
                                        autofocus
                                        autocomplete="ktp"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.ktp"
                                    />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="name" value="Name" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="password"
                                        value="Password"
                                    />

                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="new-password"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.password"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="password_confirmation"
                                        value="Confirm Password"
                                    />

                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="
                                            form.errors.password_confirmation
                                        "
                                    />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="telephone" value="No Hp" />

                                    <TextInput
                                        id="telephone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.telephone"
                                        required
                                        autofocus
                                        autocomplete="telephone"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.telephone"
                                    />
                                </div>
                                <div class="mt-4">
                                    <InputLabel
                                        for="birth"
                                        value="Tanggal Lahir"
                                    />

                                    <div
                                        class="flex flex-row-reverse relative max-w-sm"
                                    >
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                                        >
                                            <svg
                                                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                                                />
                                            </svg>
                                        </div>
                                        <TextInput
                                            id="birth"
                                            type="date"
                                            class="mt-1 block w-full"
                                            v-model="form.birth"
                                            required
                                            autofocus
                                            autocomplete="telephone"
                                        />
                                    </div>

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.birth"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="gender"
                                        value="Jenis Kelamin"
                                    />

                                    <select
                                        id="gender"
                                        name="gender"
                                        v-model="form.gender"
                                        required
                                        class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-accent focus:ring-accent rounded-md shadow-sm"
                                    >
                                        <option value="Laki-laki">
                                            Laki-laki
                                        </option>
                                        <option value="Perempuan">
                                            Perempuan
                                        </option>
                                    </select>
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.gender"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="avatar"
                                        value="Foto Profil"
                                    />

                                    <input
                                        id="avatar"
                                        type="file"
                                        class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-accent focus:ring-accent rounded-md shadow-sm"
                                        @input="
                                            form.avatar = $event.target.files[0]
                                        "
                                        required
                                        autofocus
                                        autocomplete="avatar"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.avatar"
                                    />
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing"
                                        >Simpan</PrimaryButton
                                    >

                                    <Transition
                                        enter-active-class="transition ease-in-out"
                                        enter-from-class="opacity-0"
                                        leave-active-class="transition ease-in-out"
                                        leave-to-class="opacity-0"
                                    >
                                        <p
                                            v-if="form.recentlySuccessful"
                                            class="text-sm text-gray-600"
                                        >
                                            Data Tersimpan.
                                        </p>
                                    </Transition>
                                </div>
                            </form>
                        </div>
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
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
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
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },
    setup() {
        const selectedId = "";
        const selectedName = "";
        const selectedEmail = "";
        const selectedKtp = "";
        const selectedTelephone = "";
        const selectedGender = "";
        const selectedBirth = "";

        const form = useForm({
            id: "",
            name: "",
            email: "",
            avatar: "",
            password: "",
            ktp: "",
            telephone: "",
            gender: "",
            birth: "",
            password_confirmation: "",
        });

        const showModal = ref(false);
        return { showModal, form };
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
        submit() {
            this.form.post(route("manage.add.member"), {
                onFinish: () => this.$refs.adminMemberForm.reset(),
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
