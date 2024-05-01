<?php

namespace Modules\Transactions\Controllers\Api\V1;

use Illuminate\Http\Request;
use Modules\Transactions\Controllers\Controller;
use Modules\Transactions\Services\UserService;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }


    public function index(Request $request)
    {
        $filteredData = $this->userService->getFilteredData($request->all());
        // my custom response
        return reponseBuilder()
            ->setData($filteredData)
            ->response();
    }


}
