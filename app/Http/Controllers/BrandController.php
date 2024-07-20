<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use App\Models\Brand;

class BrandController extends Controller
{

	public function index()
    {
    	$brands = Brand::latest()->paginate(5);
        return view('brands.index',compact('brands'));
    }
    public function create()
    {
    	return view('brands.create');
    }

    public function store(Request $request){
    		$request->validate([
                'name' => 'required',
                'slug' => 'required',
            ]);
            $brand = new Brand;
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status= $request->status ? '1' : '0'; 
            $brand->save();
            return redirect()->route('brands.index')
                            ->with('success','brands created successfully.');
    }
    public function edit($id,Request $request){
    	$brands = Brand::find($id);
        return view('brands.edit',compact('brands'));
    }
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brands.index')->with('error', 'Brand not found.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $id . '|max:255',
            'status' => 'required|in:1,0',
        ]);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(string $id)
    {
            $brand = Brand::find($id);
            $brand->delete();
            return redirect()->route('brands.index')
                            ->with('success','Brand deleted successfully');
    }
}
