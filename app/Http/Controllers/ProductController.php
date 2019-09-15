<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $data = Product::all();
        return response()->json($data);
    }
    
    public function show($id){
        $data = Product::show($id)->get();
        return response()->json($data);
    }
    
    public function store (Request $request){

        try {

            $rules = array(
                'name' => 'required|',
                'price' => 'required|integer',
                'qty' => 'required|integer',
                'description' => 'required',
            );    
            $messages = array(
                'name.required' => 'Name is required.',
                'price.required' => 'Price is required.',
                'price.integer' => 'Price must be integer.',
                'qty.required' => 'Quantity is required.',
                'qty.integer' => 'Quantity must be integer.',
                'description.required' => 'Description is required.'
            );
            $validator = Validator::make( $request->all(), $rules, $messages );
            
            if ( $validator->fails() ) 
            {
                return response()->json( [
                    'status' => 0, 
                    'message' => $validator->errors()->first()
                ]);
            }
    
            $data = new Product();
            $data->name = $request->name;
            $data->price = $request->price;
            $data->qty = $request->qty;
            $data->description = $request->description;
            $data->save();
            
            return response()->json( [
                'status' => 1, 
                'message' => 'Berhasil Tambah Data'
            ]);
        
        } catch (\Exception $e) {
        
            return $e->getMessage();
        }

    }

    public function update(Request $request, $id){

        try {

            $rules = array(
                'name' => 'required|',
                'price' => 'required|integer',
                'qty' => 'required|integer',
                'description' => 'required',
            );    
            $messages = array(
                'name.required' => 'Name is required.',
                'price.required' => 'Price is required.',
                'price.integer' => 'Price must be integer.',
                'qty.required' => 'Quantity is required.',
                'qty.integer' => 'Quantity must be integer.',
                'description.required' => 'Description is required.'
            );
            $validator = Validator::make( $request->all(), $rules, $messages );
            
            if ( $validator->fails() ) 
            {
                return response()->json( [
                    'status' => 0, 
                    'message' => $validator->errors()->first()
                ]);
            }
    
            $data = Product::where('id',$id)->first();
            $data->name = $request->name;
            $data->price = $request->price;
            $data->qty = $request->qty;
            $data->description = $request->description;
            $data->save();
            
            return response()->json( [
                'status' => 1, 
                'message' => 'Berhasil Merubah Data'
            ]);
        
        } catch (\Exception $e) {
        
            return $e->getMessage();
        }


    }
    
    public function destroy($id){
        $data = Product::where('id',$id)->first();
        $data->delete();

        return response()->json( [
            'status' => 1, 
            'message' => 'Berhasil Menghapus Data'
        ]);
    }
}
