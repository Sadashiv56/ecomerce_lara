<?php
namespace App\Repository;
use App\Repository\Interfaces\ProductRepositryInterface;
use App\Models\Product;

class ProductRepositry implements  ProductRepositryInterface{
	public function all(){
		return Product::latest()->paginate(5);
	}
	public function store($data ,$input){
		 if ($image = $input['image']) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
       return Product::create($input);
	}
	public function find($id){
		return Product::where('id',$id)->first();
	}
	public function update($data, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new \Exception('Product not found');
        }
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $data['image']->getClientOriginalExtension();
            $data['image']->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
        } else {
            unset($data['image']);
        }
        $product->update($data);
    }
    public function delete($id){
    	$product = product::whereId($id)->first();
        $product->delete();
    }
}
?>