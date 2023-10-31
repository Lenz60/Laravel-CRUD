<template>
    <section>
        <header class="pb-5">
            <h2 class="text-lg font-medium text-gray-900">Foto Profil</h2>

            <p class="mt-1 text-sm text-gray-600">Update Foto Profil anda</p>
        </header>

        <div class="flex flex-col items-center justify-center">
            <img
                :src="`/storage/${$page.props.auth.user.avatar}`"
                class="w-48 h-48 rounded-md"
            />
            <form
                @submit.prevent="form.post(route('profile.update.avatar'))"
                class="mt-6 space-y-6"
                enctype="multipart/form-data"
            >
                <div class="mt-4">
                    <TextInput
                        id="avatar"
                        type="file"
                        class="mt-1 block w-ful"
                        @input="form.avatar = $event.target.files[0]"
                        required
                        autofocus
                        autocomplete="avatar"
                    />

                    <InputError class="mt-2" :message="form.errors.avatar" />
                </div>
                <div class="flex items-center justify-center gap-4 mt-5">
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
    </section>
</template>

<script>
import { useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
export default {
    props: ["modelValue"],
    components: {
        PrimaryButton,
        InputLabel,
        TextInput,
        InputError,
    },
    setup(props) {
        const user = usePage().props.auth.user;

        const form = useForm({
            avatar: "",
            assetAvatar: user.avatar,
        });

        const image = form.avatar;
        return { form, image };
    },
};
</script>

<style lang="scss" scoped></style>
