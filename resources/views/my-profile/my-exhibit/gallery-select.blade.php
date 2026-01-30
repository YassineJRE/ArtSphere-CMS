<div id="gallery_select_container">
<select
    class="input-text form-control @if ($errors->has('{{$select_id_input}}')) invalid @endif"
    name="{{$select_id_input}}"
    id="{{$select_id_input}}"
>
    @if ($preselected['value'])
        <option  id="preselected" value="{{$preselected['value']}}" selected="selected">{{$preselected['text']}}</option>
    @endif
</select>
</div>
@push('scripts')
<script type='text/javascript' charset="UTF-8">
    $(function() {
        let gallerySelector = $("#{{$select_id_input}}")
        gallerySelector.select2({
            placeholder:"Please select a gallery",
            minimumInputLength: 2,
            ajax:{
                url:"{{ route("app.groups.search") }}",
                delay: 500,
                processResults: function (data) {
                    return {
                        results: data.map((group)=>{return {id: group.id,text:group.name};})
                    };
                }
                
            },
            "searching": function (){return "Searching";}
        });
        console.log('Selected gallery',$('#preselected').val(), '{{implode(', ', $preselected)}}')
        gallerySelector.on("change",function (e){
            let gallery = gallerySelector.select2('data')[0];
            $('{{$gallery_id_output}}').val(gallery.id);
            $('{{$gallery_name_output}}').val(gallery.text);
        });
    });
</script> 
@endpush