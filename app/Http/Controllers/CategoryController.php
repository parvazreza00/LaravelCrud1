<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function AllCategory(){
        
        // $categories = DB::table('categories')
        // ->join('users', 'categories.user_id','users.id')
        // ->select('categories.*','users.name')
        // ->paginate(5);

        $categories = Category::paginate(5);
        $trashCategory = Category::onlyTrashed()->paginate(3);
        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trashCategory'));

    }

    public function AddCategory(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            
        ],
        [
            'category_name.required'=> 'Please Input Category Name',
        ]);

        Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name']=$request->category_name;
        // $data['user_id']=Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category insertd successfully');
    }

    public function Edit($id){
        // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request, $id){
        // $update = Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id']= Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        
        return redirect()->route('all.category')->with('success','Category Updated successfully');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category Softdelete successfully');
    }

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restore successfully');
    }

    public function PDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category p-delete successfully');

    }
}
