<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontPagesController extends Controller
{
    public function Show_category_details($id)
    {

        $category = Category::where('id', $id)->where('status', '0')->first();

        return view('includes.pops_front.category_details', compact('id', 'category'));
    }


    public function Show_product_details($id)   //  $id--->Related To Product
    {
        $product = Product::where('id', $id)->where('status', '0')->first();

        $category_name = Category::where('id', $product->category_id)->where('status', '0')->first();

        return view('includes.pops_front.product_details', compact('id', 'product', 'category_name'));
    }
    public function home_product_send_message(Request $request)
    {
        try{
            if (Auth::user())
            {
                 //To Store One Photo For Home Page
                $file = $request->hasFile('file');

                if ($file != '' ) {
                        $file = $request->file('file');
                        $file_name = time().'.'.$file->getClientOriginalExtension();
                        $filePath =('files/product_comment/');
                        $file->move($filePath, $file_name);
                        $save = $file_name;
                    }else{
                        $save = 'null';
                    }

                    $comment = new Product_Comment();
                    $comment->file               = $save;
                    $comment->user_id            = Auth::id();
                    $comment->product_id         = $request->product_id;
                    $comment->product_comment    = $request->product_comment;
                    $comment->rate               = $request->rate;
                    $comment->save();

                toastr()->success('لقد تم اضافة نعليقك بنجاح');
                return redirect()->back();
            }else{
                toastr()->error('يجب عليك تسجيل الدخول للموقع حتي تتمكن من اضافة تعليق علي هذا المنتج');
                return redirect()->back();
            }

        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function home_pops_search(Request $request)
    {
        $products = Product::where('name', 'like', "%{$request->keyword}%")->get();

        $product_count = Product::where('name', 'like', "%{$request->keyword}%")->count();

        return view('includes.pops_front.product_search', compact('products', 'product_count'));
    }





    public function home_contact(Request $request)
    {
        return view('includes.pops_front.contactus');
    }
    public function home_contact_send_message(Request $request)
    {
        try{
            if (Auth::user()){
                $rules = [
                    'email' => 'email',
                ];
                $this->validate($request, $rules);

                $contact = new Contact();
                $contact->name          = $request->name;
                $contact->phone         = $request->phone;
                $contact->email         = $request->email;
                $contact->subject       = $request->subject;
                $contact->message       = $request->message;
                $contact->save();
                toastr()->success('لقم تم ارسال رسالتك بنجاح');
                return redirect()->back();

            }else{
                toastr()->error('يجب عليك تسجيل الدخول للموقع حتي تتمكن من التواصل معنا');
                return redirect()->back();
            }
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
