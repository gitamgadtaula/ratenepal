<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Feedback\Entities\Rating;
use Modules\Shop\Entities\Shop;

class RatingController extends Controller
{
    public function postRating(Request $request, $shop_id)
    {
        $rating = $request->rating;
        $user_id = auth()->user()->id;

        $shop =Shop::select('user_id')->where('id',$shop_id)->first();
        if($shop->user_id===$user_id){
            //check if the authenticated user is the shop owner 
            return response()->json(['msg'=>'cant rate your own shop'],403);
        }
        //checking if the authenticated user has already rated the specific shop
        $getRating = Rating::select('shop_id', 'rating')->where([
            ['user_id', '=', $user_id], 
            ['shop_id', '=', $shop_id]
        ])->get();
        if (sizeOf($getRating) === 0) {
            $data = Rating::create([
                'shop_id' => $shop_id,
                'user_id' => $user_id,
                'rating' => $rating
            ]);
            return response()->json(['msg' => 'Rated', $data]);
        }
        return response()->json(['msg'=>'sorry you have rated this shop already'],403);
    }

    public function getUserRatingOnShop($shop_id)
    {
        $user_id=auth()->user()->id;
       
        $rating = Rating::select('rating')->where([
            ['user_id','=',$user_id],
            ['shop_id','=',$shop_id]
        ])->first();
        if (!$rating) {
            return response()->json(['msg'=>'not rated yet','status'=>false]);
        }
        return response()->json($rating);
    }
    public function getAllRatingOfShop($shop_id)
    {
        //get all ratings of a particular shop
        $ratings = Rating::select('rating')->where('shop_id', $shop_id)->get();
        return response()->json($ratings);
    }
}
