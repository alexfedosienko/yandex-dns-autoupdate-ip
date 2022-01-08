<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class YandexDnsService
{
  function getSubdomains($key, $domain)
  {
    $response = Http::withHeaders(['PddToken' => $key])
      ->get('https://pddimp.yandex.ru/api2/admin/dns/list', ['domain' => $domain])
      ->json();

    $records = [];
    if (array_key_exists('records', $response)) {
      if ($response['records']) {
        foreach ($response['records'] as $record) {
          if ($record['type'] == 'A') {
            $records[] = ['id' => $record['record_id'], 'name' => $record['fqdn'], 'content' => $record['content'], 'ttl' => $record['ttl']];
          }
        }
      }
      return ['status' => 'ok', 'records' => $records];
    } else {
      return ['status' => 'error', 'error' => $response['error']];
    }
  }

  function updateIp($key, $domain, $recordId, $subdomain, $ttl, $ip)
  {
    $response = Http::withHeaders([
      'PddToken' => $key,
    ])->post('https://pddimp.yandex.ru/api2/admin/dns/edit?' . http_build_query([
      'domain' => $domain,
      'record_id' => $recordId,
      'subdomain' => $subdomain,
      'ttl' => $ttl,
      'content' => $ip,
    ]))->json();
    return $response['success'] == 'ok';
  }
}
