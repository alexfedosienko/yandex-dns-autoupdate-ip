<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class MyIpService
{
  function getMyIp()
  {
    $response = Http::get('https://api.ipify.org', [
      'format' => 'json',
    ])->json();
    return $response['ip'];
  }
}
