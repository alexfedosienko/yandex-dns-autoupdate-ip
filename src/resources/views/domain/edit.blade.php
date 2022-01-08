@extends('layouts.default')
@section('title', 'Домены')
@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-md-6 offset-md-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Добавление нового домена</h3>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('domain.update', $domain->id) }}">
                  @csrf
                  {{ method_field('PATCH') }}
                  <input type="hidden" name="subdomain_name" value="{{ $domain->subdomain_name }}">
                  <input type="hidden" name="ip" value="{{ $domain->ip }}">
                  <div class="form-group mb-3">
                    <label class="form-label">Название домена</label>
                    <input type="text" name="name" class="form-control" value="{{ $domain->name }}" placeholder="Название домена">
                  </div>

                  <div class="form-group mb-3">
                    <label class="form-label">Ключ Яндекс.API</label>
                    <div>
                      <input type="text" name="key" class="form-control" value="{{ $domain->key }}" placeholder="Ключ Яндекс.API">
                      <small class="form-hint">Ключ получать по <a href="https://pddimp.yandex.ru/api2/admin/get_token" target="_blank">ссылке</a></small>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <label class="form-label">TTL</label>
                    <input type="text" name="ttl" class="form-control" value="{{ $domain->ttl }}" placeholder="TTL">
                  </div>

                  <div class="mb-3 subdomains">
                    <select type="text" class="form-select" name="subdomain_id" value="{{ $domain->subdomain_id }}">
                      @foreach ($subdomains as $subdomain)
                      <option value="{{ $subdomain['id'] }}" @if($subdomain['id'] == $domain->subdomain_id) selected @endif>{{ $subdomain['name'] }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-footer mt-3 text-center">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('includes.footer')
  </div>
  <script>
    $(document).ready(function(){
      let domains = @json($subdomains);

      $('body').on('change', 'select[name="subdomain_id"]', function() {
        selectDomain();
      });

      const selectDomain = () => {
        let selectedDomain = domains.filter(domain => domain.id == $('select[name="subdomain_id"]').val()).pop();
        $('input[name="ip"]').val(selectedDomain.content);
        $('input[name="subdomain_name"]').val(selectedDomain.name);
        $('input[name="ttl"]').val(selectedDomain.ttl);
      }
    });
  </script>
@stop
