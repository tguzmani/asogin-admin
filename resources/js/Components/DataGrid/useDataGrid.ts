import { ref } from "vue";
import { router } from "@inertiajs/vue3";

interface DataGridOptions {
    route: string;
    initialSearch?: string;
    initialSortField?: string;
    initialSortDirection?: "asc" | "desc";
    initialPerPage?: number;
}

export function useDataGrid({
    route,
    initialSearch = "",
    initialSortField = "id",
    initialSortDirection = "asc",
    initialPerPage = 10,
}: DataGridOptions) {
    const search = ref(initialSearch);
    const sortField = ref(initialSortField);
    const sortDirection = ref(initialSortDirection);
    const perPage = ref(initialPerPage);
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

        currentPage.value = page;
        perPage.value = perPage;
    }

    function fetchPerPage({ perPage }) {
        fetchData({
            perPage,
            sortField: sortField.value,
            sortDirection: sortDirection.value,
            search: search.value,
        });

        currentPage.value = 1;
        perPage.value = perPage;
    }

    function fetchSorted({ field, direction, page, perPage }) {
        fetchData({
            sortField: field,
            sortDirection: direction,
            page,
            perPage,
        });

        sortField.value = field;
        sortDirection.value = direction;
        currentPage.value = page;
        perPage.value = perPage;
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
