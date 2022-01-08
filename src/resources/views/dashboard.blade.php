@extends('layouts.default')
@section('title', 'Домены')
@section('content')
  <div class="page-wrapper">
    <div class="container-xl">
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Домены
            </h2>
          </div>
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="{{route('domain.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Добавить новый домен
              </a>
              <a href="{{route('domain.create')}}" class="btn btn-primary d-sm-none btn-icon"">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th class="w-3">#</th>
                      <th>Название домена</th>
                      <th>Название поддомена</th>
                      <th>IP</th>
                      <th>Статус</th>
                      <th>Дата последнего обновления</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (sizeof($domains) > 0)
                      @foreach ($domains as $domain)
                        <tr>
                          <td>{{ $domain->id }}</td>
                          <td class="text-muted">{{ $domain->name }}</td>
                          <td class="text-muted"><a href="{{ $domain->subdomain_name }}" class="text-reset" target="_blank">{{ $domain->subdomain_name }}</a></td>
                          <td class="text-muted">{{ $domain->ip }}</td>
                          <td>
                            @if ($domain->status == 'success')
                            <span class="badge bg-success me-1"></span> Успешно
                            @endif

                            @if ($domain->status == 'fail')
                            <span class="badge bg-danger me-1"></span> Провал
                            @endif
                          </td>
                          <td class="text-muted">{{ $domain->updated_at }}</td>
                          <td class="d-flex">
                            <a href="{{ route('domain.show', $domain->id) }}" class="d-inline-block m-1">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                             </svg>
                            </a>
                            <a href="{{ route('domain.destroy', $domain->id) }}" class="d-inline-block m-1">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                             </svg>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="7" class="text-muted text-center">Домены еще не добавлены</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('includes.footer')
  </div>
@stop
