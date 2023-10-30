<template>
    <Head title="Home" />
    <div class="flex flex-col items-center justify-center w-screen h-screen">
        <div class="flex flex-col justify-center items-center">
            <div class="p-5">
                <Link href="/login">
                    <button class="btn btn-primary btn-outline rounded-md">
                        Member Login
                    </button>
                </Link>
            </div>
            <div class="p-5">
                <Link href="/admin">
                    <button
                        class="btn btn-secondary btn-outline rounded-md"
                        @click="changeUser()"
                    >
                        Admin Login
                    </button>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
export default {
    components: {
        Head,
        Link,
    },
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped></style>
