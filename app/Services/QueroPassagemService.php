<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class QueroPassagemService
{
    protected string $baseUrl;
    protected string $user;
    protected string $pw;

    public function __construct()
    {
        $this->baseUrl = config('services.queropassagem.url');
        $this->user = config('services.queropassagem.user');
        $this->pw = config('services.queropassagem.pw');
    }


    public function post(string $endpoint, array $data = [])
    {
        try {
            $response = Http::withBasicAuth($this->user, $this->pw)
                ->timeout(15)
                ->retry(3, 200)
                ->post("{$this->baseUrl}/{$endpoint}", $data);

            return $response->throw()->json();
        } catch (RequestException $e) {
            logger()->error('Erro na API QueroPassagem', [
                'endpoint' => $endpoint,
                'message' => $e->getMessage(),
                'response' => $e->response?->body(),
            ]);
            throw $e;
        }
    }

    public function get(string $endpoint, array $query = [])
    {
        try {
            $response = Http::withBasicAuth($this->user, $this->pw)
                ->timeout(15)
                ->retry(3, 200)
                ->get("{$this->baseUrl}/{$endpoint}", $query);

            return $response->throw()->json();
        } catch (RequestException $e) {
            logger()->error('Erro na API QueroPassagem', [
                'endpoint' => $endpoint,
                'message' => $e->getMessage(),
                'response' => $e->response?->body(),
            ]);
            throw $e;
        }
    }

}
