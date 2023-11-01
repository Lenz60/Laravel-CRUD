<template>
    <div>
        <Head title="Profile" />

        <div class="text-white">
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
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    components: {
        Head,
        AuthenticatedLayout,
    },
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
