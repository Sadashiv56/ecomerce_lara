<?php
namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryValidationRequest;
use App\Http\Requests\CategoryUpdateValidationRequest;
use App\Http\Requests\SubCategoryValidationRequest;
use Illuminate\Http\JsonResponse;
use DataTables;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::all();
            return datatables()
                ->of($data)
                ->addColumn('status', function (Category $data) {
                    if ($data->status == 1) {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function (Category $data) {
                    $edit = route('categories.edit', $data->id);
                    $deleteLink = route('categories.destroy', $data->id);
                    $btn = '<a href="' . $edit . '" class="edit btn btn-danger btn-sm">Edit</a>';
                    $btn .= '<form action="' . $deleteLink . '" method="POST" style="display:inline-block;" class="delete-form">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-primary btn-sm delete-button">Delete</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('category.index');
    }
    

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
            // dd($request->all());
            $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ]);
            // Category::create($request->all());
            $category = new Category;
            $category->name = $request->name;
            $category->slug = $request->slug;
            // $category->status = $request->status;
            $category->status= $request->status ? '1' : '0'; // Ternary operator used here
            $category->save();
            return redirect()->route('categories.index')
                            ->with('success','Category created successfully.');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // dd($request->all());
            $category = Category::find($id);
            request()->validate([
                'name' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ]);
            // $category->update($request->all());
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->update();
            return redirect()->route('categories.index')
                            ->with('success','Product updated successfully');
    }

    /**
         * Remove the specified resource from storage.
         */

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('categories.index')
                            ->with('success','Category deleted successfully');
    }
}
