<?php

declare(strict_types=1);

namespace Vagrant\ViaCep\ViaCep;

use GuzzleHttp\Client;

class ViaCepService
{
    protected Client $client;

    protected string $cep;

    protected array $response;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://viacep.com.br/ws/',
        ]);
    }

    public function cep(string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function fetch(): self
    {
        try {
            $response = $this->client->request('GET', "{$this->cep}/json/");
            $this->response = json_decode($response->getBody()
                ->__toString(), true);
        } catch (\Exception $exception) {
            $this->response = ['error' => 'Erro ao buscar o CEP: '.$exception->getMessage()];
        }

        return $this;
    }

    public function get(): array
    {
        return $this->response;
    }

    public function logradouro(): ?string
    {
        return $this->response['logradouro'] ?? null;
    }

    public function localidade(): ?string
    {
        return $this->response['localidade'];
    }

    public function estado(): ?string
    {
        return $this->response['estado'] ?? null;
    }

    public function ddd(): ?string
    {
        return $this->response['ddd'] ?? null;
    }
}
