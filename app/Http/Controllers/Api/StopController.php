<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\StopRepository;
use App\Http\Resources\StopsResource;
use App\Models\Stop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StopController extends Controller
{

    protected $repository;
    protected $model;

    public function __construct(StopRepository $stopRepository, Stop $stop)
    {
        $this->repository = $stopRepository;
        $this->model = $stop;
    }

    public function index()
    {
        try {
            $data = $this->repository->all();
            return StopsResource::collection($data)->response();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar paradas', 'message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }
}
