<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Feedback\Entities\Rating;

class RatingController extends Controller
{
    public function postRating(Request $request, $shop_id)
    {
        $rating = $request->rating;
        $user_id = auth()->user()->id;
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
        return response()->json('sorry you have rated already rated');
    }

    public function getUserRatingOnShop($shop_id)
    {
        $user_id=auth()->user()->id;
        $rating = Rating::select('shop_id', 'rating')->where([
            ['user_id','=',$user_id],
            ['shop_id','=',$shop_id]
        ])->get();
        if (sizeOf($rating) == 0) {
            return response()->json(['msg'=>'not rated yet']);
        }
        return $rating;
    }
    public function getAllRatingOfShop($shop_id)
    {
        //get all rating of a particular shop
        $ratings = Rating::select('rating')->where('shop_id', $shop_id)->get();
        return response()->json($ratings);
    }
}
