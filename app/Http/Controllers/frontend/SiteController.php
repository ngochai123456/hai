<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Post;

class SiteController extends Controller
{
    public function index($link = null)
    {
        if ($link == null) {
           return  $this->home();
        } else {
            $link = Link::where('link', '=', $link)->first();
            // var_dump($link);
            if ($link != null) {
                $type = $link->type;
                switch ($type) {
                    case 'category': {                 
                            return $this->ProductCategory($link);               
                        }
                    case 'brand': {
                            return $this->ProductBrand($link);          
                        }
                    case 'topic': {
                            return $this->PostTopic($link);          
                        }
                    case 'page': {
                            return $this->PostPage($link);          
                        }
                }
            } else {
                $product = Product::where([['link', '=', $link], ['status', '=', 1]])->first();
                if ($product != null) {
                    return $this->ProductDetail($product);
                    
                } 
                else {
                    $post = Post::where([['link', '=', $link], ['status', '=', 1], ['type', '=', 'post']])->first();
                    if ($post != null) {
                        return $this->PostDetail($post);
                    } else {
                        return $this->error_404($link);
                        
                    }
                }
            }
            // return view('frontend.site');
        }
    }
    #home
    private function home()
    {
        $title = 'Trang chủ';
        $args=[
                ['status', '=', '1'],
                ['parent_id','=','0']
        ];
       $list_category = Category::where($args)->orderBy('sort_order')->get();
        return view('frontend.home', compact('list_category', 'title'));
    }
    #product - all
    public function product()
    {
        $title = 'tat ca san pham';
        $list_product = Product::where('status','=',1)
        ->orderBy('created_at','DESC')
        ->get();
        return view('frontend.product',compact('list_product','title'));
    }

    #category
    private function ProductCategory($link)
    {
        $args=[
            ['status','=',1],
            ['parent','=',0]
        ];
        $cat = Category::where($args)->first();
        return view('frontend.product-category');
    }
    #Detail
    private function ProductDetail($product)
    {
        $title = 'Sản phẩm theo thương hiệu';
        $list_product = Product::where('status', '=', '1')
            ->orderby('id')
            ->paginate(16);
        return view('frontend.product-detail', compact('product', 'list_product', 'title'));
    }
    #Brand
    private function ProductBrand($link)
    {
        return view('frontend.product-brand');
    }
    #Topic
    private function PostTopic($link)
    {
        return view('frontend.post-topic');
    }
    #page
    private function PostPage($link)
    {
        return view('frontend.post-page');
    }
    #Detail
    private function PostDetail($link)
    {
        return view('frontend.post-detail');
    }
    #Error_404
    private function Error_404($link)
    {
        return view('frontend.404');
    }
}