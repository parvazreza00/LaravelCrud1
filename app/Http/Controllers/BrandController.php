<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand(){

        $brands = Brand::paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
            
        ],
        [
            'brand_name.required'=> 'Please Input brand Name',
            'brand_name.min'=> 'Brnad name at least 4 chars',
            'brand_image.required'=> 'Please Input brand Image',
            
        ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen. '.' .$img_ext;
        $up_loaction = 'image/brandimage/';        
        $brand_image->move($up_loaction,$image_name);

        $last_image = $up_loaction.$image_name;

        
        
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_image,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success','Brand added successfully');
    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request, $id){

        $validated = $request->validate([
            'brand_name' => 'required|min:4',            
        ],
        [
            'brand_name.required'=> 'Please Input brand Name',
            'brand_name.min'=> 'Brnad name at least 4 chars',            
            
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){            
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen. '.' .$img_ext;
        $up_loaction = 'image/brandimage/';        
        $brand_image->move($up_loaction,$image_name);

        $last_image = $up_loaction.$image_name;

        
        unlink($old_image);

        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_image,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success','Brand Update successfully');

        }else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,                
                'created_at'=>Carbon::now(),
            ]);
    
            return redirect()->back()->with('success','Brand Update successfully');

        }

        
    }

    public function BrandDelete($id){
        
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success','Brand deleted successfully');

    }
}
