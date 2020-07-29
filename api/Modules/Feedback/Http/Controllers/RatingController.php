<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Feedback\Entities\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('feedback::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('feedback::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function postRating(Request $request, $shop_id)
    {
        $rating = $request->rating;
        $user_id = auth()->user()->id;
        //checking if the authenticated user has already rated the specific shop
        $getRating = Rating::select('shop_id', 'rating')->where([
            ['user_id', '=', auth()->user()->id], ['shop_id', '=', $shop_id]
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

    public function getUserRatingOnShop()
    {

        $rating = Rating::select('shop_id','rating')->where('user_id', auth()->user()->id)->get();
        return $rating;
        if (sizeOf($rating) == 0) {
            dd('not rated');
        }
        dd('already rated', $rating);
    }
    public function getAllRatingOfShop($shop_id)
    {
        //get all rating of a particular shop
        $ratings = Rating::select('rating')->where('shop_id', $shop_id)->get();
        return response()->json($ratings);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('feedback::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('feedback::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
