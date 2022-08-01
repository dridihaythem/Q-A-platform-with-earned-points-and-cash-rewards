@push('css')
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
@endpush

@push('js')
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    const easyMDE =  new EasyMDE({
        element: document.getElementsByClassName("markdown-editor")[0],
        @if(isset($minHeight))
        minHeight:"{{ $minHeight }}",
        @endif
        direction:'rtl',
        uploadImage:true,
        hideIcons: ["image"],
        showIcons: ["upload-image"],
        imageUploadFunction: function(file,onSuccess ,onError ){
             const formData = new FormData();
            formData.append('image',file);
            axios.post('{{route('markdown.upload-image')}}',formData).then(function(res){
                onSuccess(res.data);
            }).catch(function(err){
                onError(err.response.data.message);
            });
        }
});

</script>
@endpush
