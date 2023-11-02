<template>
    <Head title="Add Admin" />

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
                                List Admin Yang Terdaftar
                            </caption>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="member in data">
                                    <td>
                                        {{ member.id }}
                                    </td>
                                    <td>{{ member.username }}</td>
                                    <td>{{ member.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="w-fit bg-neutral-content m-5 flex flex-col justify-center items-center card shadow-md p-5"
                    >
                        <h1 class="text-lg text-base-300 p-5">
                            Tambahkan Akun Admin Baru
                        </h1>
                        <form
                            @submit.prevent="
                                form.post(route('admin.add.admin.create'))
                            "
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="name" value="Nama" />

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

                            <div>
                                <InputLabel for="username" value="Username" />

                                <TextInput
                                    id="username"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.username"
                                    required
                                    autocomplete="username"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.username"
                                />
                            </div>
                            <div>
                                <InputLabel for="password" value="Password" />

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                    required
                                    autocomplete="password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
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
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useForm, Head } from "@inertiajs/vue3";
export default {
    props: ["data", "string"],
    components: {
        Head,
        AuthenticatedLayout,
        InputLabel,
        PrimaryButton,
        TextInput,
        InputError,
    },
    setup() {
        const form = useForm({
            name: "",
            username: "",
            password: "",
        });
        return { form };
    },
};
</script>

<style lang="scss" scoped></style>
