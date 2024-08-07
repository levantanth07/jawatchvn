@extends('backend.app.index')
@section('title','Danh sách bài viết')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Danh sách bài viết</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form method="GET" action="{{ route('backend.post.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Nhập từ khóa">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Tìm kiếm</button>
                        </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                @include('backend.notify')
                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Post Type</th>
                            <th>Created</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $postTypes[$item->post_type] ?? '' }}</td>
                                <td>{{ date('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('backend.post.edit',$item->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa ?')"
                                       href="{{ route('backend.post.destroy',$item->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {!! $results->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

