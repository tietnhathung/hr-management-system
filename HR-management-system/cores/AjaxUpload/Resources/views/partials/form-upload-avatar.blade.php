{!! Form::open(['method' => 'POST', 'id'=>'upload_form', 'style'=>'display:inline', 'enctype'=>"multipart/form-data"]) !!}
<div class="form-group">


    <label class="label-control">Ảnh mẫu</label> <input type="file" class="form-control-file" name="select_file" id="select_file" />
    <p class="help-block">Chỉ upload file dạng ảnh (jpg, png, gif).</p>
    <a class="btn btn-default"  onclick="$(this).closest('form').submit();"><i title="Upload" id="item-12" class="fas fa-upload bigger-120"></i>Upload</a>

    <div id="imageMessage" style="display:none"></div>
    <div id="imagePreview" style="{{  ($image=="" || $image == null)?"display:none":"" }}"><img src="{{ env('URL_IMAGE') . $image }}" class="img-thumbnail" id="img_preview" width="150"></div>
</div>
{!! Form::close() !!}

@section('scripts')
<script>
    $(document).ready(function(){

        $('#upload_form').on('submit', function(event){
            $('#imageMessage').html("<span><i class=\"fas fa-spinner\"></i> Đang upload ảnh. Vui lòng chờ trong giây lát.</span>");
            $('#imageMessage').show();
            event.preventDefault();
            console.log("upload image");
            $.ajax({
                url:"{{ route('ajaxupload.uploadAvatar') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $('#select_file').val("");
                    $('#imageMessage').css('display', 'block');
                    $('#imageMessage').html(data.message);
                    $('#imageMessage').addClass(data.class_name);
                    $('#imagePreview').html(data.uploaded_image);
                    $('#imagePreview').show();
                    $('#{{ $element_id }}').val(data.image_path);
                }
            })
        });
    });
</script>
@endsection
