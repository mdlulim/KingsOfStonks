<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

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

    /**
     * @OA\Get(
     ** path="/api/v4/quote",
     *   tags={"Home"},
     *   summary="Kings of stonks",
     *   description="",
     *
     *   @OA\Parameter(
     *      name="ticker",
     *      in="query",
     *      description="Provide stock ticker",
     *      required=true,
     *   ),
     *   @OA\Parameter(
     *      name="apiKey",
     *      in="query",
     *      description="Provide Api Key",
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
    public function getStock(Request $request)
    {
        $type = $request->input('ticker');
        $apiKey =  $request->input('apiKey');
        $result = json_decode($this->stockTickerApi($type, $apiKey), true);

        /**
         * Check if the stock ticker is valid
         */
        if(empty($result)) {
            return response()->json([
                'status' => 200,
                'message' => 'Invalid stock ticker'
            ]);
        }

        $result = $result[0];
        $date = date_create($result['earningsAnnouncement']);
        $result['earningsAnnouncement']=date_format($date,"Y-m-d H:i:s");

        $stock = Stock::where('symbol',$result['symbol'])->first();
        if($stock && !empty($stock->symbol)){
            $message = 'Stock was successfully updated';
            $stock->update($result);
        }else{
            $message = 'Stock was successfully created';
            Stock::create($result);
        }

        $stock = Stock::where('symbol',$type)->first();
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $stock
        ]);

    }

    private function stockTickerApi($type, $apkey){
        $curl = curl_init();
        $baseurl="https://financialmodelingprep.com/api/v3/quote/$type?apikey=$apkey";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

}
