<?php


namespace App\Service\Request;


use Symfony\Component\HttpFoundation\Request;

class JsonBodyParser
{
    public static function parse(Request $request)
    {
        return json_decode($request->getContent(), true);
    }
}