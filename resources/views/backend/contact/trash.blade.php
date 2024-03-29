@extends('layouts.admin')
@section('title', $title??'Danh sách liên hệ')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÙNG RÁC LIÊN HỆ</h1>
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
            <div class="col-6">
              <button class="submit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </div>
            <div class="col text-right">
              <a href="{{ route('contact.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
            </div>
          </div>
        </div>
        </div>
        <div class="card-body">
          @includeIf('backend.message')
          <table class="table table-bordered table-striped ">
            <tr class=" bg-primary">
              <th style="width:20px">#</th>
              <th>Tên thương hiệu</th>
              <th>Slug</th>
              <th>Thứ tự</th>
              <th>Hình đại diện</th>
              <th>Ngày tạo</th>
              <th>Chức năng</th>
              <th style="width: 20px">ID</th>
          </tr>
            @foreach ($list as $row)
                <tr>
                  <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->slug }}</td>
                  <td>{{ $row->sort_order }}</td>
                  <td>{{ $row->image }}</td>
                  <td>{{ $row->created_at }}</td>
                  <td>
                    <a class="btn btn-sm btn-info"
                    href="{{ route('contact.show', ['contact' => $row->id]) }}">
                    <i class="fas fa-eye"></i>
                </a>
                <a class="btn btn-sm btn-primary"
                    href="{{ route('contact.restore', ['contact' => $row->id]) }}">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </a>
                <a class="btn btn-sm btn-danger"
                    href="{{ route('contact.destroy', ['contact' => $row->id]) }}">
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