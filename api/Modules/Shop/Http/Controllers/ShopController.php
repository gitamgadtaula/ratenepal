<?php

namespace Modules\Shop\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Shop\Entities\Shop;
use Modules\Feedback\Entities\Rating;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use Modules\Shop\Http\Requests\CreateShopRequest;

class ShopController extends Controller
{

    public function imageSubmit(Request $request)
    {
        $shop_name = "name";
        // $shop_name =$request->shop_name;
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path($shop_name . '/images'), $imageName);
        return response()->json(['success' => 'You have successfully upload image.']);
    }

    public function createShop(CreateShopRequest $request)
    {

        $user_id = auth()->user()->id;
        // dd($user_id);
        // try {
        //     if (Shop::count() < 32) {
        //         //A user can only post 2 shops
        //         $input = $request->all();
        //         $user = auth()->user->id;
        //         if ($result = Shop::create($input)) {
        //             return response()->json([
        //                 'status' => 'done',
        //                 'msg' => 'A new shop has been succesfully created',
        //                 'data' => $result
        //             ]);
        //         }
        //     } else {
        //         return response()
        //         ->json(['msg' => 'sorry, You already have reached max limit:2']);
        //     }
        // } catch (ExceptionMessage $e) {
        //     return response()->json($e);
        // }
        $user_id = auth()->user()->id;
        $result = Shop::create([
            'name' => $request->name,
            'user_id' => $user_id,
            'motto' => $request->motto,
            'description' => $request->description,
            'email' => $request->email,
            'location' => $request->location,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'logo' => $request->name,
            'website' => $request->website
        ]);
        if (!$result) {
            return response()->json('Failed');
        }
        return response()->json([
            'status' => 'done',
            'msg' => 'A new shop has been succesfully created',
            'data' => $result
        ]);
    }
    public function fetchShop()
    {
        try {
            $shop = Shop::with('ratings')->get();
            return response($shop);
        } catch (ExceptionMessage $e) {
            return response()->json(['msg' => $e, 'status' => 'Fetching failed'], 401);
        }
    }
    public function fetchShopById($shop_id)
    {
        try {
            $myShop = Shop::with('ratings')->find($shop_id);
            // ->with('ratings')->get();
            return response()->json($myShop);
        } catch (Exception $e) {
            return response()->json(['msg' => $e, 'status' => 'Fetching failed'], 404);
        }
    }
}
