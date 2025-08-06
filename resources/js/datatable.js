import { DataTable } from "simple-datatables";
import "simple-datatables/dist/style.css";

document.addEventListener("DOMContentLoaded", () => {
    const table = document.getElementById("search-table");
    if (table) {
        new DataTable(table, {
            searchable: true,
            sortable: false,
        });
    } else {
        console.warn("Tabel #search-table tidak ditemukan.");
    }
});
