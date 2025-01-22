export interface DataGridColumn {
    field: string;
    headerName: string;
}

export interface DataGridProps {
    columns: DataGridColumn[];
    rows: any[];
}
