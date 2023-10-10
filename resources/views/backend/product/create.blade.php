@extends('layouts.admin')

@section('title', $title)
@section('content')
@endphp
@endphp
<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
  @csrf
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÊM SẢN PHẨM</h1>
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
      <div class="card-header">
          
          
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
              <div class="mb-3">
                  <label for="name">Tên sản phẩm</label>
                  <input type="text" name="name" id="name" type="text" value="{{  old('name') }}" class="form-control " required placeholder="">
                  @if ($errors->has('name'))
                 <div class="text-danger">
                    {{ $errors->first('name') }}
                 </div>
               @endif
              </div>
              <div class="mb-3">
                  <label for="detail">Chi tiết</label>
                  <textarea name="detail" id="detail" cols="10" rows="2" class="form-control " value="{{  old('detail') }}" required placeholder="Chi tiết"></textarea>
                  @if ($errors->has('detail'))
                 <div class="text-danger">
                    {{ $errors->first('detail') }}
                 </div>
               @endif
              </div>
              <div class="mb-3">
                  <label for="metadesc">Mô tả (SEO)</label>
                  <textarea type="text" name="metadesc" id="metadesc" cols="10" value="{{  old('metadesc') }}" rows="2" class="form-control " required placeholder=""></textarea>
                  @if ($errors ->has('metadesc'))
              <div class="text-danger">
                {{ $errors->first('metadesc') }}
              </div>
              @endif
              </div>
              <div class="mb-3">
                  <label for="metakey">Từ khóa (SEO)</label>
                  <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control " value="{{  old('metakey') }}" required placeholder=""></textarea>
                  @if ($errors ->has('metakey'))
              <div class="text-danger">
                {{ $errors->first('metakey') }}
              </div> 
              @endif
              </div>
          </div>
          <div class="col-md-4">
              <div class="mb-3">
                  <label for="category_id">Danh mục</label>
                  <select name="category_id" id="category_id" required class="form-control">
                      <option value="">--chon danh mục--</option>
                      <?= $html_category_id ?>;
                  </select>
              </div>
              <div class="mb-3">
                  <label for="brand_id">Brand</label>
                  <select name="brand_id" id="brand_id" required class="form-control">
                      <option value="">--chon thương hiệu--</option>
                      <?= $html_brand_id ?>;
                  </select>
              </div>
              <div class="mb-3">
                  <label for="qty">Số lượng </label>
                  <input name="qty" id="qty" type="number" class="form-control " value="1" min="1">
              </div>
              <div class="mb-3">
                  <label for="price">Giá</label>
                  <input name="price" id="price" type="number" class="form-control" value="1000" min="1000" step="500">
              </div>
              <div class=" mb-3">
                  <label for="pricesale">Giá khuyến mãi</label>
                  <input name="pricesale" id="pricesale" type="number" value="{{  old('pricesale') }}" class="form-control ">
              </div>
              <div class="mb-3">
                  <label for="image">Hình ảnh</label>
                  <input name="image" id="image" type="file" required class="form-control btn-sm">
              </div>
              <div class="mb-3">
                  <label for="status">Trạng thái</label>
                  <select name="status" id="status" class="form-control">
                      <option value="1">Xuất bản</option>
                      <option value="2">Chưa xuất bản</option>

                  </select>
              </div>
          </div>
      </div>
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
</form>
@endsection