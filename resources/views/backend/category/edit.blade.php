@extends('backend.app.index')
@section('title','Cập nhật danh mục')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cập nhật danh mục</h3>
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
                              method="post" action="{{ route('backend.category.update', $item->id) }}">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Tên danh mục
                                    <span class="required text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $item->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Danh mục cha
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="parent_id">
                                        @foreach($parents as $parent)
                                            <option @if($parent->id == $item->parent_id)
                                                        {{ 'selected' }}
                                                    @endif value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a class="btn btn-primary" href="{{ route('backend.category.index') }}">Hủy</a>
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

