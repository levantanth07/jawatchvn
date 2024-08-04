@extends('backend.app.index')
@section('title','Thêm mới bài viết')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thêm mới bài viết</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                @include('backend.notify')
                <div class="x_panel">
                    <div class="x_content">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                              method="post" action="{{ route('backend.post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tóm tắt
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="description" name="description"
                                           class="form-control @error('description') is-invalid @enderror"
                                           value="{{ old('description') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nội dung
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                              id="content" cols="30" rows="10">{{ old('content') }}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Loại bài viết
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control js-states" name="post_type" id="post_type">
                                        @foreach($postTypes as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Trạng thái
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Hiển thị</option>
                                        <option value="2">Ẩn</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a class="btn btn-primary" href="{{ route('backend.post.index') }}">Hủy</a>
                                    <button type="submit" class="btn btn-success">Thêm mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .list-images {
            width: 50%;
            margin-top: 20px;
            display: inline-block;
        }

        .picture-box {
            margin-right: 5px;
            padding-bottom: 10px;
        }

        .btn-delete-image {
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .box-image {
            width: 100px;
            height: 108px;
            position: relative;
            float: left;
            margin-left: 5px;
        }

        .box-image img {
            width: 100px;
            height: 100px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#post_type").select2({
                placeholder: {
                    id: 0,
                    text: 'Chọn loại bài viết',
                },
                allowClear: true
            });

            $(".btn-add-image").click(function () {
                $('#file_upload').trigger('click');
            });

            $('.list-input-hidden-upload').on('change', '#file_upload', function (event) {
                let today = new Date();
                let time = today.getTime();
                let image = event.target.files[0];
                let file_name = event.target.files[0].name;
                let box_image = $('<div class="box-image"></div>');
                box_image.append('<div class="wrap-btn-delete"><span data-id=' + time + ' class="btn-delete-image">x</span></div>');
                box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
                $(".list-images").append(box_image);

                $(this).removeAttr('id');
                $(this).attr('id', time);
                let input_type_file = '<input type="file" name="filenames[]" id="file_upload" class="my_form form-control hidden">';
                $('.list-input-hidden-upload').append(input_type_file);
            });

            $(".list-images").on('click', '.btn-delete-image', function () {
                let id = $(this).data('id');
                $('#' + id).remove();
                $(this).parents('.box-image').remove();
            });
        })
    </script>
    <script>
        CKEDITOR.replace('content',{
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@endsection

