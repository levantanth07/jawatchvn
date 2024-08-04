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

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                @include('backend.notify')
                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Field_1</th>
                            <th>Field_2</th>
                            <th>Field_3</th>
                            <th>Field_4</th>
                            <th>Logo</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->field_1 }}</td>
                                <td>{{ $item->field_2 }}</td>
                                <td>{{ $item->field_3 }}</td>
                                <td>{{ $item->field_4 }}</td>
                                <td><img src="{{ asset('').'public/public/'.$item->logo }}" alt="" width="100px"></td>
                                <td>
                                    <a href="{{ route('backend.config.edit',$item->id) }}">
                                        <i class="fa fa-edit"></i>
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

