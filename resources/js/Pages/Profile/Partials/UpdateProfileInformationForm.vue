<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    Role: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    username: user.username,
    name: user.name,
});
</script>

<template>
    <div v-if="Role == 'Admin'">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Informasi Profil
                </h2>
                <p>{{ $page.props.auth.user }}</p>

                <p class="mt-1 text-sm text-gray-600">
                    Update informasi akun member.
                </p>
            </header>

            <form
                @submit.prevent="form.patch(route('admin.profile.update'))"
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

                    <InputError class="mt-2" :message="form.errors.name" />
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

                    <InputError class="mt-2" :message="form.errors.username" />
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
        </section>
    </div>
    <div v-else>
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Informasi Profil
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Update informasi akun member.
                </p>
            </header>

            <form
                @submit.prevent="form.patch(route('profile.update'))"
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

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

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

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="status === 'verification-link-sent'"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent to your email
                        address.
                    </div>
                </div>
                <div>
                    <InputLabel for="ktp" value="KTP" />

                    <TextInput
                        id="ktp"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ktp"
                        required
                        autocomplete="ktp"
                    />

                    <InputError class="mt-2" :message="form.errors.ktp" />
                </div>
                <div>
                    <InputLabel for="telephone" value="No Hp" />

                    <TextInput
                        id="telephone"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.telephone"
                        required
                        autocomplete="telephone"
                    />

                    <InputError class="mt-2" :message="form.errors.telephone" />
                </div>

                <div>
                    <InputLabel for="birth" value="Tanggal Lahir" />

                    <div class="flex flex-row-reverse relative">
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

                    <InputError class="mt-2" :message="form.errors.birth" />
                </div>
                <div>
                    <InputLabel for="gender" value="Jenis Kelamin" />

                    <select
                        id="gender"
                        name="gender"
                        v-model="form.gender"
                        required
                        class="mt-1 block w-full border-gray-300 text-gray-600 focus:border-accent focus:ring-accent rounded-md shadow-sm"
                    >
                        <div v-if="form.gender == 'Laki-laki'">
                            <option selected value="Laki-laki">
                                Laki-laki
                            </option>
                        </div>
                        <div v-else>
                            <option selected value="Perempuan">
                                Perempuan
                            </option>
                        </div>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
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
        </section>
    </div>
</template>
