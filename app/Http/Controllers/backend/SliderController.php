<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;


use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='Danh sách sản phẩm';                                                                                                             #$title...
        $list = Slider::where('status','<>','0')->get(); 
                                                                                           #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.slider.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title ='Tạo';
        $list = Slider ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_sort_order = '';
        foreach($list as $item)
        {
            $html_sort_order .= "<option value =' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
        }
        return view("backend.slider.create", compact('html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $slider = new Slider();
        $slider ->name = $request->name;
        $slider ->link = $request->link;
        // $slider ->position = $request->position;
        //$slider ->level = $request->level;
        //$slider ->image = $request->image;
        $slider ->sort_order = $request->sort_order;
        $slider->created_at=date('Y-m-d H:i:s');
        $slider->created_by= 1;
        $slider->updated_by= 1;
        $slider->updated_at= date('Y-m-d H:i:s');
        $slider->status=2;
        
        $file = $request->file('image');
        if ($request->has('image')) {
            $path_dir = "images/slider/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $slider->link . '.' . $extension;
            $file->move($path_dir, $filename);
            $slider->image = $filename;
        }
        // end
        if ($slider->save()) {
            $link = new Link();
            $link->link = $slider->link;
            $link->table_id = $slider->id;
            $link->type = 'slider';
            $link->save();
            return redirect()->route('slider.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm sản phẩm thành công']);
        } else {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm sản phẩm không thành công']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $row = Slider::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.slider.show',compact('row','title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Slider::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Slider ::where('status','<>','0')->orderBy('created_at','desc')->get();  
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
        return view('backend.slider.edit',compact('row','title','list','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $row = Slider::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row ->name = $request->name;
        $row ->link = $request->link;
        $row ->position = 'position';
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row ->sort_order = $request->sort_order;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->updated_by= 1;
        $row->updated_at= date('Y-m-d H:i:s');
        $row->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $row ->link. '.'.$extention;
                $file->move(public_path('images/slider'),$fileName);
                $row->image = $fileName;
                //$brand ->image = $request->image;
             }
        }
        $row->save();
        return redirect()->route('slider.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $path_dir = "images/slider/";
        $path_image_delete = public_path($path_dir . $slider->image);
        if ($slider == null) {
            return redirect()->route('slider.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        if ($slider->delete()) {
            if (File::exists($path_image_delete)) {
                File::delete($path_image_delete);
            }
           
            return redirect()->route('slider.trash')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
        } else {
            return redirect()->route('slider.trash')->with('message', ['type' => 'danger', 'mgs' => 'Xóa sản phẩm không thành công']);
        }


    }
    public function trash()
    {                                                                                                        
        $list = Slider::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.slider.trash',compact('list'));
    }

    public function delete($id)
    {
       
        $row = Slider::find($id);
        if ($row == null) {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by =  Auth::user()->id;
            $row->save();
            return redirect()->route('slider.index')->with('message', ['type' => 'success', 'mgs' => 'Chuyển vào thùng rác thành công']);
        }
    }

    public function status($id, Request $request)
    {
        $slider = Slider::find($id);
        if ($slider == null) {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        } else {
            $slider->status = ($slider->status == 1) ? 2 : 1;
            $slider->updated_at = date('Y-m-d H:i:s');
            $slider->updated_by = 1;
            $slider->save();
            return redirect()->route('slider.index')->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
        }
    }
}