import { Component } from "vue";

export interface DataGridColumn {
    field: string;
    headerName: string;
    renderValue?: Component;
    sortable?: boolean;
}

export interface DataGridProps {
    columns: DataGridColumn[];
    rows: any[];
}
