@extends('backend.app.index')
@section('title','Cập nhật phản hồi')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cập nhật phản hồi</h3>
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
                              method="post" action="{{ route('backend.feedback.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tiêu đề
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ $item->title }}">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nội dung
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea cols="3" rows="5" name="content" class="form-control">{{ $item->content }}</textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Upload ảnh
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="image" name="image"
                                           class="form-control @error('image') is-invalid @enderror" value="">
                                </div>
                            </div>
                            @if($item->image != '')
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Ảnh hiện tại
                                    </label>
                                    <div class="col-md-6 col-sm-6">
                                        <img src="{{ asset('').'public/public/'.$item->image }}" alt="" width="80px">
                                    </div>
                                </div>
                            @endif
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Trạng thái
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="status">
                                        <option @if($item->status == 1)
                                                    {{ 'selected' }}
                                                @endif value="1">Kích hoạt
                                        </option>
                                        <option @if($item->status == 2)
                                                    {{ 'selected' }}
                                                @endif value="2">Ngưng hoạt động
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a class="btn btn-primary" href="{{ route('backend.feedback.index') }}">Hủy</a>
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

