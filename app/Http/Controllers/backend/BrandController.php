<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Link;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='Danh sách thương hiệu';                                                                                                             #$title...
        $list = Brand::where('status','<>','0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title ='Tạo';
        $list = Brand ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_sort_order = '';
        foreach($list as $item)
        {
            $html_sort_order .= "<option value ='" . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
        }
        // dd($html_sort_order);

        return view("backend.brand.create", compact('html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $row = new Brand();
        $row ->name = $request->name;
        $row ->slug = Str::of($request->name)->slug('-');;
        $row ->sort_order = $request->sort_order;
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row->metakey = $request->metakey;
        $row->metadesc=$request->metadesc;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->updated_at=date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=2;
        
        // upload file
       if ($request->has('image')) {
        $path_dir = "images/brand/";
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = $row->link . '.' . $extension;
        $file->move($path_dir, $filename);
        $row->image = $filename;
    }
    // end
    if ($row->save()) {
        $link = new Link();
        $link->link = $row->link;
        $link->table_id = $row->id;
        $link->type = 'brand';
        $link->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm sản phẩm thành công']);
    } else {
        return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm sản phẩm không thành công']);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(   $id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $title = "Chi tiết mãu tin";
        return view('backend.brand.show',compact('row','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = brand::find($id);                                                                                           
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = brand ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_sort_order = '';
        foreach($list as $item)
        {
            if($item->sort_order == $row->sort_order)
            {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";            
            }
            else
            {
            $html_sort_order .= "<option value =' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.brand.edit',compact('row','title','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row ->name = $request->name;
        $row ->link = Str::of($request->name)->link('-');;
        $row ->sort_order = $request->sort_order;
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row->metakey = $request->metakey;
        $row->metadesc=$request->metadesc;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->updated_at=date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=2;
        
         // upload file
         if ($request->has('image')) {
            $path_dir = "images/brand/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $row->link . '.' . $extension;
            $file->move($path_dir, $filename);
            $row->image = $filename;
        }
        // end
        if ($row->save()) {
            $link = Link::where([['type', '=', 'brand'], ['table_id', '=', $id]])->first();
            $link->link = $row->link;

            
           
           
            $link->save();
            return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm sản phẩm thành công']);
        } else {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm sản phẩm không thành công']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Brand::find($id);
        $path_dir = "images/brand/";
        $path_image_delete = public_path($path_dir . $row->image);
        if ($row == null) {
            return redirect()->route('brand.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        if ($row->delete()) {
            if (File::exists($path_image_delete)) {
                File::delete($path_image_delete);
            }
            $link = Link::where(
                [['type', '=', 'brand'], ['table_id', '=', $id]]
            )->first();
            $link->delete();
            return redirect()->route('brand.trash')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
        } else {
            return redirect()->route('brand.trash')->with('message', ['type' => 'danger', 'mgs' => 'Xóa sản phẩm không thành công']);
        }

    }
    public function trash()
    {                                                                                                        
        $list = Brand::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.trash',compact('list'));
    }
    public function status($id)
    {
        $row = Brand::find($id);
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=($row ->status == 1)? 2 : 1;

        $row ->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công']);
    }

    public function delete($id)
    {
        $row = Brand::find($id);
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=0;

        $row ->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Xoá vào thùng rác thành công']);
    }
    

    public function restore($id)
    {
    $row = Brand::find($id);
        if($row == NULL)
        {
            return redirect()->route('brand.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=($row ->status == 1)? 2 : 1;

        $row ->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục thành công']);
    }
}
?>