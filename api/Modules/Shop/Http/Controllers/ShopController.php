<?php

namespace Modules\Shop\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Shop\Entities\Shop;
use Modules\Shop\Entities\Image;
use Modules\Feedback\Entities\Rating;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use Modules\Shop\Http\Requests\CreateShopRequest;

class ShopController extends Controller
{

    public function imageSubmit(Request $request)
    {
        $shop_id = 1;
        $shop_name = $request->shop_name;
        $image = $request->image;
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        //each image of shop is stored in public/assets/<shopname>/images
        $image->move(public_path('/assets' . $shop_name . '/images'), $imageName);
        $imagePath = $shop_name . '/images/' . $imageName;

        if (Image::create([
            'main_img' => $imagePath,
            'shop_id' => $shop_id
        ])) {
            return response()->json(['success' => 'You have successfully uploaded the image.']);
        }
    }

    public function createShop(CreateShopRequest $request)
    {
        //change the request class to createshopRequest
        $user_id = auth()->user()->id;
        $image = $request->logo;
        $imageName = time() . '.' . $request->logo->getClientOriginalExtension();
        //each image of shop is stored in public/assets/<shopname>/images
        $image->move(public_path('/assets/' . $request->name . '/logo'), $imageName);
        $imagePath = $request->name . '/logo/' . $imageName;

        $result = Shop::create([
            'name' => $request->name,
            'user_id' => $user_id,
            'motto' => $request->motto,
            'description' => $request->description,
            'email' => $request->email,
            'location' => $request->location,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'logo' => $imagePath,
            'website' => $request->website
        ]);
        if (!$result) {
            return response()->json('Failed');
        } else {
            return response()->json([
                'status' => 'done',
                'msg' => 'A new shop has been succesfully created',
                'data' => $result
            ]);
        }
    }
    public function assetsHandler(Request $request)
    {

        $user_id = auth()->user()->id;
        $img1 = $request->img1;
        $img2 = $request->img2;
        $img3 = $request->img3;
        $img4 = $request->img4;
        $shop_id = $request->shop_id;
        function storeImage($req, $shop_name, $db_col, $shop_id)
        {
            $img = $req;

            $imgName = time() . '.' . $req->getClientOriginalExtension();
            //each image of shop is stored in public/assets/<shopname>/images
            $img->move(public_path('/assets/' . $shop_name . '/images'), $imgName);
            $imagePath = $shop_name . '/logo/' . $imgName;
            $image = Image::firstOrCreate(['shop_id' => $shop_id]);
            $image->shop_id = $shop_id;
            $image->$db_col = $imagePath;
            $image->save();
           
        }
        storeImage($img1, $request->shop_name, 'img1', $shop_id);
        storeImage($img2, $request->shop_name, 'img2', $shop_id);
        // $this->storeImage($img3, $request->shop_name);
        // $this->storeImage($img4, $request->shop_name);
        return response()->json(['msg' => 'success']);
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
