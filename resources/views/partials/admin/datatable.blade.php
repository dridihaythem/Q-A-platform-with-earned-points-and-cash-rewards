@push('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" />

<style>
    .div.dataTables_wrapper,
    div.dataTables_filter {
        text-align: left !important;
    }

    .dataTables_length {
        float: right;
    }
</style>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js""></script>

<script>
$(document).ready(function(){
    $('.datatable').DataTable({
        pageLength: 10,
        responsive: true,
        oLanguage: { sUrl: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json'}
    });
});
</script>
@endpush