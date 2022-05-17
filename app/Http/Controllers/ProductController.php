<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Auth;
use Redirect;
   
class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(){
        return view('products');
    }
    
}