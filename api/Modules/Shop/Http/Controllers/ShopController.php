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
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('shop::index');
    }

    public function createShop(CreateShopRequest $request)
    {
        try {
            if (Shop::count() < 2) {
                //A user can only post 2 shops
                $input = $request->all();
                if ($result = Shop::create($input)) {
                    return response()->json([
                        'status' => 'done', 'msg' => 'A new shop has been succesfully created', 'data' => $result
                    ]);
                }
            } else {
                return response()->json(['msg' => 'sorry, You already have reached max limit:2']);
            }
        } catch (ExceptionMessage $e) {
            return response()->json($e);
        }
    }
    public function fetchShop()
    {
        try {
            // $shop = Shop::leftJoin('ratings', 'ratings.shop_id', '=', 'shops.id')
            // ->select('shops.id','shops.name', 'ratings.rating')->groupBy('rating')->get();
            $shop = Shop::with('ratings')->get();
            return response($shop);
            
        } catch (ExceptionMessage $e) {
            return response()->json(['msg' => $e, 'status' => 'Fetching failed'], 401);
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('shop::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('shop::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('shop::edit');
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
