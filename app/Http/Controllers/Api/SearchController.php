<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\SearchRepository;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SeatsRequest;
use App\Models\Search;

class SearchController extends Controller
{

    protected $repository;
    protected $model;

    public function __construct(SearchRepository $searchRepository, Search $search)
    {
        $this->repository = $searchRepository;
        $this->model = $search;
    }

    public function index(SearchRequest $request)
    {
        try {
            $data = $this->repository->find($request->validated());
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro inesperado'], $e->getCode() ?: 500);
        }
    }

    public function seats(SeatsRequest $request)
    {
        try {
            $data = $this->repository->findSeats($request->validated());
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro inesperado'], $e->getCode() ?: 500);
        }
    }
}
