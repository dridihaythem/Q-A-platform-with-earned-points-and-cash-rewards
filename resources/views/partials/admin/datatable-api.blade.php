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

    .dataTables_wrapper {
        padding-bottom: 0px;
        overflow: hidden;
        max-width: 100%;
    }
</style>
@endpush
@push('js')

{{$dataTable->scripts()}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js""></script>

<script>
    (function ($, DataTable) {

$.extend(true, DataTable.defaults, {
    responsive: true,
    oLanguage: { sUrl: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json'}
});

})(jQuery, jQuery.fn.dataTable);
</script>
@endpush