@extends('backend.app.index')
@section('title','Cấu hình web')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cấu hình web</h3>
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
                              method="post" action="{{ route('backend.config.update', $config->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="title_config" value="title_config">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề 1
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="field_1" name="field_1"
                                           class="form-control @error('field_1') is-invalid @enderror"
                                           value="{{ $config->field_1 }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề 2
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="field_2" name="field_2"
                                           class="form-control @error('field_2') is-invalid @enderror"
                                           value="{{ $config->field_2 }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề 3
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="field_2" name="field_3"
                                           class="form-control @error('field_3') is-invalid @enderror"
                                           value="{{ $config->field_3 }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề 4
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="field_4" name="field_4"
                                           class="form-control @error('field_4') is-invalid @enderror"
                                           value="{{ $config->field_4 }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Upload ảnh logo
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="logo" name="logo"
                                           class="form-control @error('logo') is-invalid @enderror" value="">
                                </div>
                            </div>
                            @if($config->logo != '')
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Logo hiện tại
                                    </label>
                                    <div class="col-md-6 col-sm-6">
                                        <img src="{{ asset('').'public/public/'.$config->logo }}" alt="" width="80px">
                                    </div>
                                </div>
                            @endif
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a class="btn btn-primary" href="{{ route('backend.config.index') }}">Hủy</a>
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
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
            $("#category_id").select2({
                placeholder: "Lựa chọn danh mục",
                allowClear: true
            });
            $("#campaign_id").select2({
                placeholder: {
                    id: 0,
                    text: 'Lựa chọn chiến dịch',
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
        CKEDITOR.replace('content');
    </script>
@endsection

