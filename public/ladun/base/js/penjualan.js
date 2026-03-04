// route 

// vue object 
var appPenjualan = new Vue({
    el : "#divDataPenjualan",
    data : {

    },
    methods : {
        detailAtc : function(kdFaktur)
        {
            renderPage('app/penjualan/detail/'+kdFaktur, 'Detail Penjualan');
        }
    }
});
// inisialisasi 
// $("#tblDataPenjualan").dataTable();

export default {
    mounted() {
        $('#tblDataPenjualan').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10,
            scrollX: true, // Aktifkan horizontal scroll
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data yang cocok",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya",
                },
                emptyTable: "Tidak ada data pada tabel",
            },
        });
    },
};
