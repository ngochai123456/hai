@extends('layouts.admin')

@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thành Viên</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col_6">
                            <button class="submit btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>Xóa
                            </button>
                        </div>
                        <div class="col text-right">

                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-success"><i
                                    class="fas fa-plus"></i>Thêm</a>
                            <a href="{{ route('user.trash') }}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i>Thùng rác</a>

                        </div>
                    </div>
                </div>

                @includeIf('backend.message')

                <div class="card-body">
                    <table class="table table-bordered table-striped">

                        <tr class="bg-success">
                            <th class="text-center" style="width: 5%">
                                <div class="form-group select-all">
                                    <input type="checkbox">
                                </div>
                            </th>
                            <th class="text-center" style="width:10%">HÌNH</th>
                            <th class="text-center" style="width:20%">TÊN TÀI KHOẢN</th>
                            <th class="text-center" style="width:10%">EMAIL</th>
                            <th class="text-center" style="width:15%">PHONE</th>
                            <th class="text-center" style="width:15%">NGÀY TẠO</th>
                            <th class="text-center" style="width:20%">CHỨC NĂNG</th>
                            <th class="text-center" style="width:5%">ID</th>
                        </tr>

                        @foreach ($list as $row)
                            <tr>
                                <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                <td>
                                    <img src="{{ asset('images/user/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                    href="{{ route('user.show', ['user' => $row->id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('user.restore', ['user' => $row->id]) }}">
                                    <i class="fa-solid fa-arrow-rotate-left"></i>
                                </a>
                                <a class="btn btn-sm btn-danger"
                                    href="{{ route('user.destroy', ['user' => $row->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                </td>
                                <td>{{ $row->id }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
