<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DomainStoreRequest;
use App\Services\YandexDnsService;

class DomainController extends Controller
{

  public function create()
  {
    return view('domain.new');
  }

  public function store(DomainStoreRequest $request)
  {
    $inputFields = $request->only(['name', 'key', 'subdomain_id', 'subdomain_name', 'ip', 'ttl']);
    $inputFields['user_id'] = Auth::user()->id;

    $domain = Domain::create($inputFields);

    if ($domain) {
      return redirect(route('dashboard'));
    }

    return redirect(route('domain.create'))->withErrors([
      'error' => 'Ошибка при добавлении домена'
    ]);
  }

  public function show($id, YandexDnsService $yandex)
  {
    $domain = Domain::where('id', $id)->where('user_id', Auth::user()->id)->first();
    if ($domain) {
      $subdomains = $yandex->getSubdomains($domain->key, $domain->name);
      $records = [];
      if ($subdomains['status'] == 'ok') {
        $records = $subdomains['records'];
      }
      return view('domain.edit', ['domain' => $domain, 'subdomains' => $records]);
    }
    return redirect(route('dashboard'));
  }

  public function update(Request $request, $id)
  {
    $domain = Domain::where('id', $id)->where('user_id', Auth::user()->id)->first();
    $domain->name = $request->name;
    $domain->ttl = $request->ttl;
    $domain->subdomain_id = $request->subdomain_id;
    $domain->subdomain_name = $request->subdomain_name;
    $domain->key = $request->key;
    $domain->save();
    return redirect(route('dashboard'));
  }

  public function destroy($id)
  {
    $domain = Domain::where('id', $id)->where('user_id', Auth::user()->id)->first();
    if ($domain) {
      $domain->delete();
    }
    return redirect(route('dashboard'));
  }

  public function subdomains(Request $request, YandexDnsService $yandex)
  {
    $response = $yandex->getSubdomains($request->key, $request->name);
    if ($response['status'] == 'ok') {
      return response()->json(['records' => $response['records']]);
    } else {
      return response()->json(['records' => [], 'error' => $response['error']]);
    }
  }
}
