<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/home",
     *   tags={"Home"},
     *   summary="Kings of stonks",
     *   description="",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Provide your name",
     *      required=true,
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *)
     **/
    public function index(Request $request){
        return response()->json([
            'name' => $request->input('name'),
            'message' => 'Home Wold'
            ]);
    }
}
