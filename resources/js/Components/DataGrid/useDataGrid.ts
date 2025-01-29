import { ref } from "vue";
import { router } from "@inertiajs/vue3";

export function useDataGrid(route: string) {
    const search = ref("");
    const sortField = ref("id");
    const sortDirection = ref<"asc" | "desc">("asc");
    const perPage = ref(10);
    const currentPage = ref(1);

    function fetchData(params) {
        router.get(route, params, { preserveState: true });
    }

    function performSearch() {
        fetchData({
            search: search.value,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
        });
    }

    function fetchPage({ page, perPage }) {
        fetchData({
            page,
            perPage,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
        });
    }

    function fetchPerPage({ perPage }) {
        fetchData({
            perPage,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
            search: search.value,
        });
    }

    function fetchSorted({ field, direction, page, perPage }) {
        fetchData({
            sortField: field,
            sortDirection: direction,
            page,
            perPage,
        });
    }

    return {
        search,
        sortField,
        sortDirection,
        perPage,
        currentPage,
        performSearch,
        fetchPage,
        fetchPerPage,
        fetchSorted,
    };
}
