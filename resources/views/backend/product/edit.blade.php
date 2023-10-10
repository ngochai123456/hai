@extends('layouts.admin')

@section('title', $title)
@section('content')
    @endphp
@endsection
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form action="{{ route('product.update', ['product' => $row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CHỈNH SỬA SẢN PHẨM
                        </h1>
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
                        <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay
                            về danh sách</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" type="text"
                                value="{{ old('name', $row->name) }}" class="form-control " required placeholder="">
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="detail">Chi tiết</label>
                            <textarea name="detail" id="detail" cols="10" rows="2" class="form-control "
                                value="{{ old('detail') }}" required placeholder="Chi tiết">{{ $row->detail }}</textarea>
                            @if ($errors->has('detail'))
                                <div class="text-danger">
                                    {{ $errors->first('detail') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="metadesc">Mô tả (SEO)</label>
                            <textarea type="text" name="metadesc" id="metadesc" cols="10" value="{{ old('metadesc') }}"
                                rows="2" class="form-control " required placeholder="">{{ $row->metadesc }}
                              </textarea>  @if ($errors->has('metadesc'))
                                <div class="text-danger">
                                    {{ $errors->first('metadesc') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="metakey">Từ khóa (SEO)</label>
                            <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control "
                                value="{{ old('metakey' ) }}" required placeholder="">{{ $row->metakey }}
                              </textarea>
                            @if ($errors->has('metakey'))
                                <div class="text-danger">
                                    {{ $errors->first('metakey') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category_id">Danh mục</label>
                            <select name="category_id" id="category_id"
                                value="{{ old('category_id', $row->category_id) }}" required class="form-control">
                                <option value="">--chon danh mục--</option>
                                {!! $html_category_id !!};
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" required class="form-control">
                                <option value="">--chon thương hiệu--</option>
                                {!! $html_brand_id !!};
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty">Số lượng </label>
                            <input name="qty" id="qty" type="number" class="form-control "
                                value="{{ old('qty', $row->qty) }}" min="1">
                        </div>
                        <div class="mb-3">
                            <label for="price">Giá</label>
                            <input name="price" id="price" type="number" class="form-control" value="{{ old('price', $row->price) }}" 
                                min="1000" step="500">
                        </div>
                        <div class=" mb-3">
                            <label for="pricesale">Giá khuyến mãi</label>
                            <input name="pricesale" id="pricesale" type="number"
                                value="{{ old('pricesale', $row->pricesale) }}" class="form-control ">
                        </div>
                        <div class="mb-3">
                            <label for="image">Hình ảnh</label>
                            <input name="image" id="image" type="file" 
                                class="form-control btn-sm">
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
        </section>
    </form>
    <!-- /.content -->
</div>
