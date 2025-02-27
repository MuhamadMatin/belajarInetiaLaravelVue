<script setup>
import MagnifyingGlass from "@/Components/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
    students: {
        type: Object,
        required: true,
    },
    classes: {
        type: Object,
        required: true,
    },
});

const search = ref("");
const class_id = ref("");
console.log(class_id);

const deleteForm = useForm({});

const deleteStudent = (studentId) => {
    if (confirm("Delete?")) {
        deleteForm.delete(route("students.destroy", studentId));
    }
};

// Watch the search input and send a request to the server
watch([search, class_id], ([newSearch, newClassId]) => {
    router.get(
        route("students.index"),
        { search: newSearch, class_id: newClassId },
        { preserveState: true }
    );
});
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Students
            </h2>
        </template>
        <div class="py-10 bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Students
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Students.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                                :href="route('students.create')"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Add Student
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col justify-start mt-6 sm:flex-row">
                        <div class="relative col-span-3 text-sm text-gray-800">
                            <div
                                class="absolute top-0 bottom-0 left-0 flex items-center pl-2 text-gray-500 pointer-events-none"
                            >
                                <MagnifyingGlass />
                            </div>

                            <input
                                v-model="search"
                                type="text"
                                autocomplete="off"
                                placeholder="Search students data..."
                                id="search"
                                class="block py-2 pl-10 text-gray-900 border-0 rounded-lg ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                        <select
                            v-model="class_id"
                            class="block py-2 ml-5 text-gray-900 border-0 rounded-lg ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                        >
                            <option value="">Filter By Class</option>

                            <option
                                v-for="item in classes.data"
                                :key="item.id"
                                :value="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col mt-8">
                        <div
                            class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                        >
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    Email
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Class
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Section
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Created At
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                />
                                            </tr>
                                        </thead>
                                        <tbody
                                            v-for="student in students.data"
                                            :key="student.id"
                                            class="bg-white divide-y divide-gray-200"
                                        >
                                            <tr>
                                                <td
                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6"
                                                >
                                                    {{ student.id }}
                                                </td>
                                                <td
                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6"
                                                >
                                                    {{ student.name }}
                                                </td>
                                                <td
                                                    class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                                >
                                                    {{ student.email }}
                                                </td>
                                                <td
                                                    class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                                >
                                                    {{ student.class.name }}
                                                </td>
                                                <td
                                                    class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                                >
                                                    {{ student.section.name }}
                                                </td>
                                                <td
                                                    class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                                >
                                                    2021-09-01
                                                </td>

                                                <td
                                                    class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'students.edit',
                                                                student.id
                                                            )
                                                        "
                                                        class="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <button
                                                        @click="
                                                            deleteStudent(
                                                                student.id
                                                            )
                                                        "
                                                        class="ml-2 text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <pagination :data="students" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
