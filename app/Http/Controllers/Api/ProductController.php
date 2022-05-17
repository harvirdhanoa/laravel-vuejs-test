<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('is_auth');
    }
    
    public function list(Request $request)
    {
        /* get products using author, search filer */
        $productQuery = Product::with('author');

        if($request->selectedAuthor != 'all'){
            $productQuery->where('user_id',$request->selectedAuthor);
        }

        if($request->search != null){
            $productQuery->where('name','LIKE',"%{$request->search}%");
        }

        if($request->dateFilter != null){
            $productQuery->whereDate('created_at',date('Y-m-d',strtotime($request->dateFilter)));
        }

        $products = $productQuery->get();

        $authors = User::all();

        $data = [
            'products' => $products,
            'authors' => $authors
        ];

        $response = ['status' => 200,'message' => 'Product list loaded', 'data' => $data];
        return response($response, 200);
    }
   
}