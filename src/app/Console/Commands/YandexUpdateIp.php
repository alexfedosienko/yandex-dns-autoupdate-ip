<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Services\MyIpService;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Services\YandexDnsService;

class YandexUpdateIp extends Command
{
  protected $signature = 'yandexdns:updateip';

  protected $description = 'Update Yandex DNS ip';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle(YandexDnsService $yandex, MyIpService $myIp)
  {
    $myIp = $myIp->getMyIp();
    $domains = Domain::get();
    foreach ($domains as $domain) {
      if ($domain->ip != $myIp) {
        $d = explode('.', $domain->subdomain_name);
        $res = $yandex->updateIp($domain->key, $domain->name, $domain->subdomain_id, $d[0], $domain->ttl, $myIp);
        $domain->status = ($res) ? 'success' : 'fail';
        $domain->ip = $myIp;
      }
      $domain->updated_at = Carbon::now();
      $domain->save();
    }
    return 0;
  }
}
