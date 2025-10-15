<?php

namespace App\Http\Repository;

use App\Models\Stop;
use App\Services\QueroPassagemService;

class StopRepository
{

    protected QueroPassagemService $service;
    protected Stop $model;

    public function __construct(QueroPassagemService $externalApiService, Stop $stop)
    {
        $this->service = $externalApiService;
        $this->model = $stop;
    }

    public function all()
    {
        $data = $this->service->get('stops');
        return $data;
    }
}