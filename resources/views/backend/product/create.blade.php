@extends('backend.app.index')
@section('title','Thêm mới sản phẩm')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thêm mới sản phẩm</h3>
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
                              method="post" action="{{ route('backend.product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tên sản phẩm
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}">
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
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Giá sản phẩm
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Giá khuyến mại
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="sale_price"
                                           class="form-control @error('sale_price') is-invalid @enderror"
                                           value="{{ old('sale_price') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Upload ảnh bài
                                    viết
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="image" name="image"
                                           class="form-control @error('image') is-invalid @enderror" value="">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Upload ảnh chi
                                    tiết
                                </label>
                                <div class="list-input-hidden-upload">
                                    <input type="file" name="filenames[]" multiple id="file_upload"
                                           class="my_form form-control hidden">
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-add-image ml-2" type="button"><i
                                            class="fldemo glyphicon glyphicon-plus"></i> Add image
                                    </button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">
                                </label>
                                <div class="list-images">
                                    @if (!empty($listImages))
                                        @foreach ($listImages as $key => $img)
                                            <div class="box-image">
                                                <input type="hidden" name="images_uploaded[]" value="{{ $img }}"
                                                       id="img-{{ $key }}">
                                                <img src="{{ asset('files/'.$img) }}" class="picture-box">
                                                <div class="wrap-btn-delete"><span data-id="img-{{ $key }}"
                                                                                   class="btn-delete-image">x</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Thuộc danh mục
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control js-states" name="category_id" id="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Chọn chiến dịch
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control js-states" name="campaign_id" id="campaign_id">
                                        @foreach($campaigns as $campaign)
                                            <option value="{{ $campaign['id'] }}">{{ $campaign['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Trạng thái
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Kích hoạt</option>
                                        <option value="2">Ngừng kích hoạt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tồn kho
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="is_stock" id="is_stock">
                                        <option value="1">Còn hàng</option>
                                        <option value="2">Hết hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a class="btn btn-primary" href="{{ route('backend.product.index') }}">Hủy</a>
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
                let images = event.target.files;

                for ( let i = 0; i < images.length; i++) {
                    let box_image = $('<div class="box-image"></div>');
                    box_image.append('<div class="wrap-btn-delete"><span data-id=' + time + ' class="btn-delete-image">x</span></div>');
                    box_image.append('<img src="' + URL.createObjectURL(images[i]) + '" class="picture-box">');
                    $(".list-images").append(box_image);
                }
                $(this).removeAttr('id');
                $(this).attr('id', time);
                let input_type_file = '<input type="file" name="filenames[]" multiple id="file_upload" class="my_form form-control hidden">';
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

