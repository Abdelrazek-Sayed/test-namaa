<?php


use Modules\Transactions\Responses\ResponseBuilder;


if (!function_exists('reponseBuilder')) {
    function reponseBuilder(): ResponseBuilder
    {
        return new ResponseBuilder();
    }
}



