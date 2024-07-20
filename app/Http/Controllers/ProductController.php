<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ProductRepositryInterface;
class ProductController extends Controller
{
    private $ProductRepositry;

    public function __construct(ProductRepositryInterface $ProductRepositry)
    {
        $this->ProductRepositry = $ProductRepositry;
    }
    public function index()
    {
        $products = $this->ProductRepositry->all();
        return view('products.index',compact('products'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
       $data = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image'=>'required',
            'price' => 'required',
        ]);
       $input = $request->all();
        $this->ProductRepositry->store($data,$input);
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    public function show(string $id)
    {
        //
    }
    public function edit($id)
    {
        $product= $this->ProductRepositry->find($id);
        return view('products.edit',compact('product'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }
        $this->ProductRepositry->update($data, $id);
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
         $this->ProductRepositry->delete($id);
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
