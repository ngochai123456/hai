@extends('layouts.admin')
@section('title', $title??'Danh sách slider')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÙNG RÁC SLIDER</h1>
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
              <a href="{{ route('slider.create') }}" class="btn btn-sm btn-success">Thêm</a>
              <a href="{{ route('slider.trash') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Thùng Rác</a>
            </div>
          </div>
        </div>
        </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <tr class="bg-primary">
                <th class="text-center" style="width: 5%">
                    <div class="form-group select-all">
                        <input type="checkbox">
                    </div>
                </th>
                <th class="text-center" style="width:10%">HÌNH</th>
                <th class="text-center" style="width:20%">TÊN SLIDER</th>
                <th class="text-center" style="width:10%">LINK</th>
                <th class="text-center" style="width:15%">NGÀY TẠO</th>
                <th class="text-center" style="width:20%">CHỨC NĂNG</th>
                <th class="text-center" style="width:5%">ID</th>
            </tr>
              @foreach ($list as $row)
                  <tr>
                    <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                    <td>
                      <img src="{{ asset('images/slider/'.$row->image) }}" class="img-fluid" alt="{{ $row->image }}">
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->link }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <a href="{{ route('slider.show',['slider' => $row ->id]) }}" class="btn btn-sm btn-success">
                          <i class="fas fa-toggle-on"></i></a>
                        <a href="{{ route('slider.edit',['slider' => $row ->id]) }}" class="btn btn-sm btn-info" > <i class="fas fa-edit"></i></a>
                        <a href="{{ route('slider.show',['slider' => $row ->id]) }}" class="btn btn-sm btn-danger "><i class="far fa-eye"></i></a>
                        <form action="{{ route('slider.destroy',['slider' => $row ->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
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