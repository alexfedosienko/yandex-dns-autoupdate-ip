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
                <form method="POST" action="{{ route('domain.store') }}">
                  @csrf
                  <input type="hidden" name="ip" value="">
                  <input type="hidden" name="subdomain_name" value="">

                  <div class="form-group mb-3">
                    <label class="form-label">Название домена</label>
                    <input type="text" name="name" class="form-control" placeholder="Название домена">
                  </div>

                  <div class="form-group mb-3">
                    <label class="form-label">Ключ Яндекс.API</label>
                    <div>
                      <input type="text" name="key" class="form-control" placeholder="Ключ Яндекс.API">
                      <small class="form-hint">Ключ получать по <a href="https://pddimp.yandex.ru/api2/admin/get_token" target="_blank">ссылке</a></small>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <label class="form-label">TTL</label>
                    <input type="text" name="ttl" class="form-control" placeholder="TTL">
                  </div>

                  <div class="form-group mb-3 text-center">
                    <button class="btn btn-primary" id="getSubdomains">Получить домены</button>
                  </div>

                  <div class="progress mb-3" style="display: none">
                    <div class="progress-bar progress-bar-indeterminate bg-blue"></div>
                  </div>

                  <div class="mb-3 subdomains" style="display: none">
                    <select type="text" class="form-select" name="subdomain_id" value=""></select>
                  </div>

                  <div class="alert alert-danger error-message" style="display: none;">
                    <h4 class="alert-title"></h4>
                  </div>

                  <div class="form-footer mt-3 text-center">
                    <button type="submit" class="btn btn-primary">Добавить</button>
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
      let domains = [];

      $('body').on('click', '#getSubdomains', function(e) {
        e.preventDefault();
        let key = $('input[name="key"]').val();
        let name = $('input[name="name"]').val();
        $.ajax({
          url: '{{ route("domain.getSubdomains") }}',
          type: "POST",
          dataType: 'json',
          data: `name=${name}&key=${key}`,
          beforeSend: function() {
            $('.progress').show();
            $('.error-message').hide();
          },
          success: function(json) {
            domains = [];
            $('.progress').hide();
            if (json.records.length > 0) {
              $('.subdomains select').html(json.records.map(record => `<option value="${record.id}">${record.name}</option>`).join(''));
              $('.subdomains').show();
              domains = json.records;
              selectDomain();
            } else {
              $('.subdomains').hide();
              $('.error-message h4').text(json.error);
              $('.error-message').show();
            }
          }
        });
      });

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
