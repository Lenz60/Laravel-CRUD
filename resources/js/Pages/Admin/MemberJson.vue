<template>
    <AuthenticatedLayout Role="Admin">
        <div class="text-white">
            <p>{{ encodedJson }}</p>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    components: {
        AuthenticatedLayout,
    },
    props: ["encodedJson"],
    setup(props) {
        console.log(props.encodedJson);
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
