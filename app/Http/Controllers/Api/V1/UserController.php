<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }


    public function index(Request $request)
    {
        $filteredData = $this->userService->getFilteredData($request->all());
        // native laravel response  method
        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $filteredData,
        ]);
        // my custom response
//                return reponseBuilder()
//                    ->setData($filteredData)
//                    ->response();

    }


}
