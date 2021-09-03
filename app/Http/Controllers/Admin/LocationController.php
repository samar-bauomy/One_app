<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;

class LocationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
        if (auth()->user()->hasRole(['super_admin', 'admin'])){
            $locations = Location::orderBy('id', 'desc')->get();
        }else{
            $auth_id = Auth::user()->id;

            $locations = Location::where('provider_id', $auth_id)->orderBy('id', 'desc')->get();
        }

       return view('pages.admin.locations.index', compact('locations'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        try {

            if (auth()->user()->hasRole('super_admin')){

                if($request->provider_id != 0 ){
                    $provider_id     = $request->provider_id;
                }else{
                    $provider_id     = Auth::id();
                }

                $provider = new Location;
                $provider->provider_id    = $provider_id;
                $provider->longtitud      = $request->longtitud;
                $provider->latitude       = $request->latitude;

                $provider->save();

                toastr()->success(trans('messages.success'));
                return redirect()->route('locations.index');

            }else{

                $auth_id = Auth::user()->id;
                $location = Location::where('provider_id', $auth_id)->count();

                if( $location <= 4 ){

                    if($request->provider_id != 0 ){
                        $provider_id     = $request->provider_id;
                    }else{
                        $provider_id     = Auth::id();
                    }

                    $provider = new Location;
                    $provider->provider_id    = $provider_id;
                    $provider->longtitud      = $request->longtitud;
                    $provider->latitude       = $request->latitude;

                    $provider->save();

                    toastr()->success(trans('messages.success'));
                    return redirect()->route('locations.index');
                }else{

                    toastr()->error(trans('Sorry, You Have Reached Your Limit Of Adding Locations'));
                    return redirect()->route('locations.index');
                }
            }
        }catch (\Exception $e){

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

            $location = Location::where('id', $request->id)->first();

            if (auth()->user()->hasRole('super_admin')){

                if($request->provider_id != 0 ){
                    $provider_id     = $request->provider_id;
                }else{
                    $provider_id     = Auth::id();
                }

                $location = Location::where('id', $request->id)->first();

                $location->update([
                    $location->provider_id    = $provider_id,
                    $location->longtitud      = $request->longtitud,
                    $location->latitude       = $request->latitude,
                ]);

                toastr()->success(trans('messages.success'));
                return redirect()->route('locations.index');

            }else{

                $auth_id = Auth::user()->id;
                $location_count = Location::where('provider_id', $auth_id)->count();

                if( $location_count <= 4 ){

                    if($request->provider_id != 0 ){
                        $provider_id     = $request->provider_id;
                    }else{
                        $provider_id     = Auth::id();
                    }

                    $location = Location::where('id', $request->id)->first();

                    $$location->update([
                        $$location->longtitud      = $request->longtitud,
                        $$location->latitude       = $request->latitude,
                    ]);

                    toastr()->success(trans('messages.success'));
                    return redirect()->route('locations.index');
                }else{

                    toastr()->error(trans('Sorry, You Have Reached Your Limit Of Adding Locations'));
                    return redirect()->route('locations.index');
                }
            }
        }catch (\Exception $e){

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
       $location = Location::findOrFail($request->id)->delete();

       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }
}
