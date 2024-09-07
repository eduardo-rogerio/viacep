<?php

declare(strict_types=1);

use Vagrant\ViaCep\ViaCep\ViaCepService;

require 'vendor/autoload.php';

$service = new ViaCepService();

dump($service->cep('15625000')->fetch()->ddd());