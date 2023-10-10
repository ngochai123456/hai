<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                       
        $title ='Danh sách danh mục';                                              
        $list = Category ::where('status','<>','0')->orderBy('status','asc')->get();                               
        return view('backend.category.index',compact('list','title'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Tạo';
        $list = Category ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_parent_id = '';
        $html_sort_order = '';
        foreach($list as $item)
        {
            if($item->id == old('parent_id')){
                $html_parent_id .= "<option selected value='" . $item->id ."'>" .$item ->name . "</option>";
            }else{
                $html_parent_id .= "<option value='" . $item->id ."'>" .$item ->name . "</option>";
            }
            if($item->sort_order == old('sort_order - 1')){
                $html_sort_order .= "<option selected value='" . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
            }else{
                $html_sort_order .= "<option value=' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
            }
        }
        
        return view("backend.category.create", compact('html_parent_id','html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $row = new Category();
        $row ->name = $request->name;
        $row ->metakey = $request->metakey;
        $row-> metadesc= $request->metadesc;
        $row ->slug = Str::of($request->name)->slug('-');;
        $row ->parent_id = $request->parent_id;
        $row ->sort_order = $request->sort_order;
        $row -> status = $request->status;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->level = $row->level + 1;
        
       // upload file
       if ($request->has('image')) {
        $path_dir = "images/category/";
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
        $link->type = 'category';
        $link->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm sản phẩm thành công']);
    } else {
        return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm sản phẩm không thành công']);
    }
}

    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Thông tin danh mục';
       

        // dd($product_category);
        $row = Category::where('category.id', '=', $id)
            
            ->first();
        if ($row == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Sản phẩm không tồn tại']);
        } else {

            return view('backend.category.show', compact('row', 'title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Category::find($id);
        $title = 'Sửa danh mục';
        $list = Category::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_parent_id = "";
        $html_sort_order = "";
        foreach ($list as $item) {
            if ($item->id != $id) {
                if ($row->parent_id == $item->id) {
                    $html_parent_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
                } else {
                    $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
                }
                if ($row->sort_order - 1  == $item->sort_order) {
                    $html_sort_order .= "<option selected value='" . ($item->sort_order) . "'>Sau: " . $item->name . "</option>";
                } else {
                    $html_sort_order .= "<option value='" . ($item->sort_order) . "'>Sau: " . $item->name . "</option>";
                }
            }
        }
        
        return view('backend.category.edit', compact('row', 'html_parent_id', 'html_sort_order', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'unique:category,name,' . $id . ',id'
        // ], [
        //     'name.unique' => 'Tên đã được sử dụng, vui lòng sử dụng một tên khác',
        // ]);

        $row = Category::find($id);
        $row->name = $request->name;

        $row->link = Str::link($request->name, '-');
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->parent_id =  $request->parent_id;
        $row->sort_order = $request->sort_order;
        $row->level = 1;
        $row->status = $request->status;
        $row->updated_at = date('Y-m-d H:i:s');

        $row->updated_by =  Auth::user()->id;
       
        // dd($category);
        // upload file
        if ($request->has('image')) {
            $path_dir = "images/category/";
            if (File::exists(public_path($path_dir . $row->image))) {
                File::delete(public_path($path_dir . $row->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $row->link . '.' . $extension;
            $file->move($path_dir, $filename);
            $row->image = $filename;
        }
        // end
        if ($row->save()) {
            $link = Link::where([['type', '=', 'category'], ['table_id', '=', $id]])->first();
            $link->link = $row->link;

            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Cập nhật sản phẩm thành công']);
        } else {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm sản phẩm không thành công']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Category::find($id);
        $path_dir = "images/category/";
        if ($row == null) {
            return redirect()->route('category.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        if ($row->delete()) {
            if (File::exists($path_image_delete)) {
                File::delete($path_image_delete);
            }
            $link = Link::where(
                [['type', '=', 'category'], ['table_id', '=', $id]]
            )->first();
            $link->delete();
            return redirect()->route('category.trash')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
        } else {
            return redirect()->route('category.trash')->with('message', ['type' => 'danger', 'mgs' => 'Xóa sản phẩm không thành công']);
        }

    }
    public function trash()
    {                                                                                                        
        $list = Category::where('status','=','0')->orderBy('created_at','asc')->get();                           
        return view('backend.category.trash',compact('list'));
    }

    public function status($id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        } else {
            $row->status = ($row->status == 1) ? 2 : 1;
            
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by =  Auth::user()->id;
            $row->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công']);
        }
    }

    public function delete($id)
    {
       
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by =  Auth::user()->id;
            $row->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Chuyển vào thùng rác thành công']);
        }
    }
    public function restore($id)
    {
    $row = Category::find($id);
        if($row == NULL)
        {
            return redirect()->route('category.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by= 1;
        $row->status=($row ->status == 1)? 2 : 1;

        $row ->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục thành công']);
    }
}
?>