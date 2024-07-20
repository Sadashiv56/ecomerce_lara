<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::with('category')->get();
            return datatables()
                ->of($data)
                ->addColumn("action", function (SubCategory $data) {
                    $edit = route("subcategory.edit", $data->id);
                    $deleteLink = route("subcategory.destroy", $data->id);
                    $btn = '<a href="' . $edit . '" class="edit btn btn-danger btn-sm">Edit</a>';
                    $btn .= '<form action="' . $deleteLink . '" method="POST" style="display:inline-block;" class="delete-form">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-primary btn-sm delete-button">Delete</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(["action"])
                ->make(true);
                dd($data);
        }
        return view('subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('subcategory.create',compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // dd($request->all());
            $validator = $request->validate([
                'name'      => 'required',
                'slug'      => 'required',
                'category_id' => 'required|numeric',
            ]);
            SubCategory::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' =>$request->category_id
            ]);
            return redirect()->route('subcategory.index')
            ->with('success','SubCategory created successfully.');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::find($id);
        return view('subcategory.edit',compact('subcategory'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $subcategory = SubCategory::find($id);
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);
        // $category->update($request->all());
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;
        $subcategory->update();
        return redirect()->route('subcategory.index')
                        ->with('success','subcategory updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (request()->ajax()) {
            try {
                $subcategory = SubCategory::findOrFail($id);
                $subcategory->delete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        return redirect()->route('subcategory.index')
                         ->with('success', 'SubCategory deleted successfully');
    
    }
}
