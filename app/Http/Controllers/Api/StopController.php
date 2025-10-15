<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\StopRepository;
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

    public function index(): JsonResponse
    {
        try {
            $data = $this->repository->all();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar paradas', 'message' => $e->getMessage()], $e->getCOde() ?: 500);
        }
    }
}
