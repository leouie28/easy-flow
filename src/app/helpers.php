<?php

use Symfony\Component\HttpFoundation\Response;

if(!function_exists('resJson'))
{
    /**
     * return json response
     */
    function resJson($data = ['status' => 'success'], int $status = Response::HTTP_OK)
    {
        return response()->json($data, $status);
    }
}