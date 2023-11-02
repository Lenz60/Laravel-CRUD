<template>
    <div
        @click.self="closeModal()"
        class="backdrop flex flex-col items-center justify-center"
    >
        <div
            class="justify-center items-center w-[700px] p-5 rounded-md bg-white text-black"
        >
            <!-- <h1 class="text-2xl text-slate-600 font-bold">{{ header }}</h1>
            <p>{{text}}</p> -->
            <!-- ? Slot is used to make a dynamical model layout it also can be used as named slot -->
            <slot name="content">
                <form
                    @submit.prevent="form.patch(route('manage.update'))"
                    class="mt-6 space-y-6"
                >
                    <input type="hidden" v-model="form.id" />
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
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.telephone"
                            required
                            autocomplete="telephone"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.telephone"
                        />
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
                        <InputError
                            class="mt-2"
                            :message="form.errors.gender"
                        />
                    </div>

                    <div class="flex items-center justify-end gap-4">
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

                <!-- <p>{{ name }}</p>
                <p>{{ email }}</p>
                <p>{{ ktp }}</p>
                <p>{{ telephone }}</p>
                <p>{{ gender }}</p>
                <p>{{ birth }}</p> -->
                <!-- <p>{{ telephone }}</p> -->
            </slot>
            <div class="actions">
                <slot name="links"> </slot>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
export default {
    props: ["id", "name", "email", "ktp", "telephone", "gender", "birth"],
    components: {
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },
    setup(props) {
        const form = useForm({
            id: props.id,
            name: props.name,
            email: props.email,
            ktp: props.ktp,
            telephone: props.telephone,
            gender: props.gender,
            birth: props.birth,
        });
        // console.log(props.name);
        return { form };
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>

<style scoped>
.modal {
    padding: 20px;
    background: white;
    border-radius: 10px;
    text-align: center;
}
.backdrop {
    top: 0;
    position: fixed;
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
}

.modal .actions a {
    color: #333;
    border: 1px solid black;
    padding: 10px;
    border-radius: 10px;
}
</style>
