<?php

namespace App\Http\Repository;

use App\Models\Search;
use App\Services\QueroPassagemService;

class SearchRepository
{

    protected $service;
    protected $model;

    public function __construct(QueroPassagemService $externalApiService, Search $search)
    {
        $this->service = $externalApiService;
        $this->model = $search;
    }

    public function find(array $request)
    {
        $data = $this->service->post('new/search', $request);
        return $data;
    }

    public function findSeats(array $request)
    {
        $data = $this->service->post('new/seats', $request);
        return $data;
    }
}