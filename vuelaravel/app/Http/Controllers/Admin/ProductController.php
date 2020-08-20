<?php

namespace App\Http\Controllers\Admin;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->get();;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required',
            'status'   => 'required',
           'image'     =>'required',
            'description'=>'required'


        ]);
        $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        \Image::make($request->image)->save(public_path('images/').$name);

          Product::create([
            'name'     => $request['name'],
            'category' => $request['category'],
            'price'    => $request['price'],
            'status'   => $request['status'],
            'image'    => $name,
         'description' => $request['description'],
        ]);
    }


  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
		$this->validate($request, [
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required',
            'status'   => 'required',
            'image'     =>'required',
            'description'=>'required'


        ]);

        $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        \Image::make($request->image)->save(public_path('images/').$name);

        $product = Product::findOrFail($id);
        
        $path=public_path()."/images/".$product->image;
        unlink($path);

	       $product->update([
            'name'     => $request['name'],
            'category' => $request['category'],
            'price'    => $request['price'],
            'status'   => $request['status'],
            'image'    => $name,
            'description' => $request['description'],
        ]); 

        
        
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
		$product = Product::findOrFail($id);
		$product->delete();
		return response()->json([
				'message' => 'product deleted successfully'
			]);
	}
}
