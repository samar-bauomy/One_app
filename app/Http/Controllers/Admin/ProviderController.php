<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Provider;
use App\User;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $providers = User::where('admin', '0')->orderBy('id', 'desc')->get();

       return view('pages.admin.providers.index', compact('providers'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        try {

            do
            {
                $name = str_replace(' ', '_', $request->name);
                $code = mt_rand(111111111,999999999);
                $user_code = $name.'_'.$code;
                $user_name = User::where('user_name', $user_code)->get();
            }
            while(!$user_name->isEmpty());

            $rules = [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'nullable|min:6',
            ];
            $this->validate($request, $rules);

            if($request->admin_id != 0 ){
                $admin_id     = $request->admin_id;
            }else{
                $admin_id     = Auth::id();
            }

           $provider = new user;
           $provider->name          = $request->name;
           $provider->user_name     = $user_code;
           $provider->email         = $request->email;
           $provider->password      = bcrypt($request->password);
           $provider->admin_id         = $admin_id;

           $provider->save();

           toastr()->success(trans('messages.success'));
           return redirect()->route('providers.index');
        }

       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request)
   {

       try {
           $rules = [
            'name'      => 'required|string|min:3',
            'email'     => 'required|email',
            'password'  => 'nullable|min:6',
           ];
           $this->validate($request, $rules);

           $provider = User::where('id', $request->id)->first();

           $provider->update([
               $provider->name           =  $request->name,
               $provider->email          =  $request->email,
               $provider->password       =  bcrypt($request->password),
               $provider->admin_id       =  $request->admin_id,

           ]);
           toastr()->success(trans('messages.Update'));
           return redirect()->route('providers.index');
       }
       catch
       (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $request)
   {
       $provider = User::findOrFail($request->id)->delete();

       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }
}

