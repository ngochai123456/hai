@extends('layouts.admin')

@section('title', $title??'Danh sách liên hệ')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TẤT CẢ LIÊN HỆ</h1>
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
              <a href="{{ route('contact.create') }}" class="btn btn-sm btn-success">Thêm</a>
              <a href="{{ route('contact.trash') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Thùng Rác</a>
            </div>
          </div>
        </div>
      </div>
        <div class="card-body">
          @includeIf('backend.message')
          <table class="table table-bordered table-striped ">
              <tr class="bg-success">
                <th class="text-center" style="width: 5%">
                  <div class="form-group select-all">
                      <input type="checkbox">
                  </div>
              </th>
                  <th class="text-center">TÊN LIÊN HỆ</th>
                  <th class="text-center">EMAIL</th>
                  <th class="text-center">ĐIỆN THOẠI</th>
                  <th class="text-center" style="width:160px;">NGÀY TẠO</th>
                  <th class="text-center" style="width:200px;">CHỨC NĂNG</th>
                  <th class="text-center" style="width:20px;">ID</th>
              </tr>
            @foreach ($list as $row)
                <tr>
                  <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->email }}</td>
                  <td>{{ $row->phone }}</td>
                  <td>{{ $row->created_at }}</td>
                  <td>
                  
                    <a href="{{ route('contact.edit',['contact' => $row ->id]) }}" class="btn btn-sm btn-info" > <i class="fas fa-edit"></i></a>
                    <a href="{{ route('contact.show',['contact' => $row ->id]) }}" class="btn btn-sm btn-danger "><i class="far fa-eye"></i></a>
                    <a href="{{ route('contact.delete',['contact' => $row ->id]) }}" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
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