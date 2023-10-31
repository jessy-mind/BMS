<?php

namespace App\Http\Controllers;

use App\User;
use App\Store;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getproducts()
    {
      $products = Product::where('creator_id', 1)->orderBy('created_at', 'DESC')->get();

      if(!empty($products)) {
        return response()->json([ 'data' => $products, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function editProduct(Request $request)
    {
      $updateProduct = Product::find($request->id);
      $updateProduct->product_name = $request->product_name;  
      $updateProduct->product_quantity = $request->quantity;  
      $updateProduct->buying_price = $request->buying_price;  
      $updateProduct->selling_price = $request->selling_price; 
      $updateProduct->stores_id = json_encode($request->stores_assigned);
      
      if ($updateProduct->update()) {
        return response()->json([ 'data' => $updateProduct, 'status' => 'success', 'status_code' => 201 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function addNewProduct(Request $request)
    {
      $newProduct = new Product();
      $newProduct->product_name = $request->product_name;  
      $newProduct->product_quantity = $request->quantity;  
      $newProduct->buying_price = $request->buying_price;  
      $newProduct->selling_price = $request->selling_price; 
      $newProduct->stores_id = json_encode($request->stores_assigned);  
      $newProduct->status = 'Available';  
      $newProduct->creator_id = 1;  
      // $newProduct->creator_id = Auth::user()->id;  
      
      if ($newProduct->save()) {
        return response()->json([ 'data' => $newProduct, 'status' => 'success', 'status_code' => 201 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function getStoreAdmins()
    {
      $storeAdmins = User::where('level', 3)->orderBy('created_at', 'DESC')->get();

      if(!empty($storeAdmins)) {
        return response()->json([ 'data' => $storeAdmins, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function editStoreAdmin(Request $request)
    {
      $updateStoreAdmin =  User::find($request->id);
      $updateStoreAdmin->full_name = $request->full_name;  
      $updateStoreAdmin->email = $request->email_address;  
      $updateStoreAdmin->phone_number = $request->phone_number;  
      $updateStoreAdmin->stores_id = json_encode($request->stores_assigned);

      if(!empty($request->password)) {  $updateStoreAdmin->password = bcrypt($request->password); }
      
      if ($updateStoreAdmin->update()) {
          return response()->json([ 'data' => $updateStoreAdmin, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
  }

    public function addNewStoreAdmin(Request $request)
    {

      $newStoreAdmin = new User();
      $newStoreAdmin->full_name = $request->full_name;  
      $newStoreAdmin->email = $request->email_address;  
      $newStoreAdmin->phone_number = $request->phone_number;  
      $newStoreAdmin->stores_id = json_encode($request->stores_assigned);  
      $newStoreAdmin->level = 3;  
      $newStoreAdmin->status = 'Active';  
      $newStoreAdmin->creator_id = 1;  
    //   $newStoreAdmin->creator_id = Auth::user()->id;  
      $newStoreAdmin->password = bcrypt($request->password); 
      
      if ($newStoreAdmin->save()) {
          return response()->json([ 'data' => $newStoreAdmin, 'status' => 'success', 'status_code' => 201 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
    }

    public function editStore(Request $request)
    {
      $updateStore =  Store::find($request->id);
      $updateStore->store_name = $request->store_name;  
     if(!empty($request->store_picture)) {  $updateStore->photo = $request->store_picture; }
      
      if ($updateStore->update()) {
          return response()->json([ 'data' => $updateStore, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
    }

    public function getStores(Request $request)
    {
      $stores = Store::orderBy('created_at', 'DESC')->get();

      if(!empty($stores)) {
        return response()->json([ 'data' => $stores, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function addNewStore(Request $request)
    {
      $newStore = new Store();
      $newStore->user_id = 1;  
      //   $newStore->user_id = Auth::user()->id;  
      $newStore->store_name = $request->store_name;  
      $newStore->photo = $request->store_picture;  
      $newStore->status = 'Active';  
      
      if ($newStore->save()) {
          return response()->json([ 'data' => $newStore, 'status' => 'success', 'status_code' => 201 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
    }

    public function uploadStorePicture(Request $request)
    {
      $picture = time().'.'.$request->file->extension();
      $request->file->move(public_path('uploads/store'), $picture);

      return $picture;
    }

    public function getSuperAdmins()
    {
      $superAdmins = User::where('level', 2)->orderBy('created_at', 'DESC')->get();

      if(!empty($superAdmins)) {
        return response()->json([ 'data' => $superAdmins, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
      }
    }

    public function editSuperAdmin(Request $request)
    {
      $updateSuperAdmin =  User::find($request->id);
      $updateSuperAdmin->full_name = $request->full_name;  
      $updateSuperAdmin->email = $request->email_address;  
      $updateSuperAdmin->phone_number = $request->phone_number;  
      $updateSuperAdmin->store_limit = $request->store_limit;
      $updateSuperAdmin->package = $request->package;  
     if(!empty($request->password)) {  $updateSuperAdmin->password = bcrypt($request->password); }
      
      if ($updateSuperAdmin->update()) {
          return response()->json([ 'data' => $updateSuperAdmin, 'status' => 'success', 'status_code' => 200 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
  }
    
    public function addNewSuperAdmin(Request $request)
    {
      $newSuperAdmin = new User();
      $newSuperAdmin->full_name = $request->full_name;  
      $newSuperAdmin->email = $request->email_address;  
      $newSuperAdmin->phone_number = $request->phone_number;  
      $newSuperAdmin->store_limit = $request->store_limit;  
      $newSuperAdmin->level = 2;  
      $newSuperAdmin->status = 'Active';  
      $newSuperAdmin->creator_id = 1;  
      $newSuperAdmin->package = $request->package;  
    //   $newSuperAdmin->creator_id = Auth::user()->id;  
      $newSuperAdmin->password = bcrypt($request->password); 
      
      if ($newSuperAdmin->save()) {
          return response()->json([ 'data' => $newSuperAdmin, 'status' => 'success', 'status_code' => 201 ]);
      } else {
        return response()->json([ 'status' => 'failed', 'status_code' => 200 ]);
    }
    }

    public function home()
    {
      return view('home');
    }

    public function index(Request $request)
    {
      // dd(Auth::check());
      if (!Auth::check() && $request->path() != 'login') {
        return redirect('/login');
      } 

      if (Auth::check() && $request->path() == 'login') {
        return redirect('/dashboard');
      } 
     
      return view('welcome');
    }
}
