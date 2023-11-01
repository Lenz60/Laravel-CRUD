<template>
    <div>
        <Head title="Admin Profile" />

        <AuthenticatedLayout Role="Admin">
            <template #header>
                <h2 class="font-semibold text-xl leading-tight">Profile</h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            Role="Admin"
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdatePasswordForm Role="Admin" class="max-w-xl" />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <DeleteUserForm Role="Admin" class="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "../Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "../Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "../Partials/UpdateProfileInformationForm.vue";
import UpdateAvatar from "../Partials/UpdateAvatar.vue";
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        DeleteUserForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
        UpdateAvatar,
    },
    props: ["mustVerifyEmail", "status"],
    setup() {
        return {};
    },
    mounted() {
        if (localStorage.getItem("reloaded")) {
            // The page was just reloaded. Clear the value from local storage
            // so that it will reload the next time this page is visited.
            localStorage.removeItem("reloaded");
        } else {
            // Set a flag so that we know not to reload the page twice.
            localStorage.setItem("reloaded", "1");
            location.reload();
        }
    },
};
</script>
<style lang="scss" scoped></style>
