<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): array{
            return [
                'success' => true,
                'message' => 'Welcome in Backend to Fleet Vehicule Managment',
                'data'   => [
                    'service' => 'Fleet Vehicule Managment API',
                    'version' => '1.0',
                    'language'=> app()->getLocale(),
                    'support' => 'osm.cre.dev@gmail.com',
                    'author'  => 'Oumar Samba BA'
                ]
            ];

    }
}
