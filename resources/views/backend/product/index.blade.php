@extends('layouts.admin')
@section('title', $title ?? 'trang quản lý')
@section('header')


@endsection
@section('content')

    <form name="form1" method="post" enctype="multipart/form-data">
        @csrf

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="text-transform: uppercase;">{{ $title ?? 'trang quản lý' }}</h1>
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
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                    <i class="fa-solid fa-trash-can"></i></i> Xóa đã chọn
                                </button>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="text-right">
                                    <a class="btn btn-sm btn-success" href="{{ route('product.create') }}">
                                        <i class="fas fa-plus"></i> Thêm
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('product.trash') }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Thùng rác
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @includeIf('backend.message', ['some' => 'data'])
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr class="text-center ">
                                    <th class="col-md-1 col-sm-1 col-1 align-middle text-center">
                                        <div class="form-group select-all">
                                            <input type="checkbox" class=""  name="checkAll" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="col-md-1 col-sm-1 col-1 align-middle text-center">Ảnh</th>
                                    <th class="col-md-2 col-sm-3 col-3 align-middle text-center">Tên sản phẩm</th>
                                    <th class="col-md-2 col-sm-2 col-2 align-middle text-center">Danh mục</th>
                                    <th class="col-md-2 col-sm-2 col-2 align-middle text-center">Thương hiệu</th>

                                    <th class="align-middle text-center">Giá bán</th>

                                    <th class="align-middle text-center col-md-2">Chức năng</th>

                                    <th class="align-middle text-center">Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
                                        </td>
                                        <td>
                                            <img src="{{ asset('images/product/' . $row->image) }}" alt=""
                                                class="w-100">
                                        </td>
                                        <td style="word-break: break-word;">{{ $row->name }}</td>
                                        <td>{{ $row->category_id }}</td>
                                        <td>{{ $row->brand_id }}</td>
                                        <td>{{ number_format($row->pricesale) }}₫</td>

                                        <td class="text-center">
                                        
                                            {{-- @if ($row->status==1)
                                            <a href="{{ route('product.status',['product' => $row ->id]) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-toggle-on"></i></a>
                                            @else
                                            <a href="{{ route('product.status',['product' => $row ->id]) }}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-toggle-off"></i></a>
                                            @endif --}}

                                            <a href="{{ route('product.edit', ['product' => $row->id]) }}"
                                                class="btn btn-sm btn-info" title="edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            
                                            <a href="{{ route('product.show', ['product' => $row->id]) }}"
                                                class="btn btn-sm btn-primary" title="view">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ route('product.delete', ['product' => $row->id]) }}"
                                                class="btn btn-sm btn-danger" title="delete">
                                                <i class="fa-solid fa-delete-left"></i>
                                            </a>
                                        </td>

                                        <td class="text-center">{{ $row->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
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
        </div>
    </form>
@endsection
@section('footer')


@endsection
