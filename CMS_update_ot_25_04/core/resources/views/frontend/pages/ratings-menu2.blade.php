@if(@Auth::user()->id)
    <!-- <div class="card p-3 mb-0"> -->
    <form id="form_exchange" method="POST" action="#" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 mb-3 text-center">
                <div class="card mb-0" style="padding:.65rem 1.25rem;border-radius:.375rem;border:1px solid #e2e8f0;font-weight:510;">
                    <span style="font-size:25px;">
                        <span id="balance_bitcoins">{{ (@Auth::user()->balance_game) ? Auth::user()->balance_game : '0' }}</span>
                        <i class="fab fa-bitcoin" data-toggle="tooltip" data-placement="left" title="Биткоины для обмена"></i>
                    </span>
                </div>
            </div>
            {{-- <div class="col-md-6 mb-4 text-center">
                <div class="card mb-0" style="padding:.65rem 1.25rem;border-radius:.375rem;border:1px solid #e2e8f0;font-weight:510;">
                    <span style="font-size:25px;">
                        <span id="balance_kits">{{ (@Auth::user()->kits_game) ? Auth::user()->kits_game : '0' }}</span>
                        <i class="fa fa-archive" data-toggle="tooltip" data-placement="left" title="Набор на сервера"></i>
                    </span>
                </div>
            </div> --}}
            <div class="col-md-12 mb-4 text-center">
                <select class="form-control select-max-width" style="border-radius:.375rem;" id="ratings_server_id" name="ratings_server_id">
                    <option value="" selected disabled>Выберите сервер для обмена</option>
                    @foreach($servers as $server)
                    <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">Сервер {{ @$server->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="ratings_count_bitcoins_div" class="col-md-12 mb-4" style="display:none;">
                <input type="number" name="ratings_count_bitcoins" class="form-control form-control-sm validate" placeholder="Кол-во биткоинов">
            </div>
            {{-- <div id="ratings_count_kits_div" class="col-md-6 mb-4" style="display:none;">
                <input type="number" name="ratings_count_kits" class="form-control form-control-sm validate" placeholder="Кол-во наборов">
            </div> --}}
            <div id="ratings_exchange_bitcoins_btn" class="col-md-12" style="display:none;">
                <button type="button" id="ratings_exchange_bitcoins" onclick="ratings_exchange_send('bitcoins', this);" class="btn btn-sm btn-primary w-100">Обменять и выдать {{ @$general->game_symbol }}</button>
            </div>
            {{-- <div id="ratings_exchange_kits_btn" class="col-md-6" style="display:none;">
                <button type="button" id="ratings_exchange_kits" onclick="ratings_exchange_send('kits', this);" class="btn btn-sm btn-primary w-100">Обменять и выдать наборы</button>
            </div> --}}
        </div>
    </form>
    <!-- </div> -->
    <script type="text/javascript">

        var ratings_server_id = 0;

        function ratings_exchange_send(type, elem) {
            $('#ratings_exchange_bitcoins').attr('disabled', true);
            $('#ratings_exchange_kits').attr('disabled', true);
            var form = $('#form_exchange')[0];
            var form_data = new FormData(form);
            form_data.append('ratings_exchange_type', type);
            $.ajax({
                type: "POST",
                url: "{{ route('ratings.exchange') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    notify(data.message, 8000, data.type);
                    $('#ratings_exchange_bitcoins').attr('disabled', false);
                    $('#ratings_exchange_kits').attr('disabled', false);
                    if(data.type == "info") {
                        $('#balance_bitcoins').html((!data.balance.bitcoins) ? '0' : data.balance.bitcoins);
                        $('#balance_kits').html((!data.balance.kits) ? '0' : data.balance.kits);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('#ratings_exchange_bitcoins').attr('disabled', false);
                    $('#ratings_exchange_kits').attr('disabled', false);
                }
            });
        }

        $('#ratings_server_id').on('change', function() {
            ratings_server_id = $(this).val();
            $('#ratings_exchange_bitcoins_btn').slideUp(250);
            $('#ratings_exchange_kits_btn').slideUp(250);
            setTimeout(function() {
                $('#ratings_count_bitcoins_div').slideUp(500);
                $('#ratings_count_kits_div').slideUp(500);
            }, 250);
            setTimeout(function() {
                $('#ratings_count_bitcoins_div').slideDown(250);
                $('#ratings_count_kits_div').slideDown(250);
            }, 500);
            setTimeout(function() {
                $('[name="ratings_count_bitcoins"]').val('');
                $('[name="ratings_count_kits"]').val('');
                $('#ratings_exchange_bitcoins_btn').slideDown(500);
                $('#ratings_exchange_kits_btn').slideDown(500);
            }, 750);
        });
    </script>
@else
    <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-1" role="alert">
        <div class="alert-group-prepend">
            <span class="alert-group-icon text-">
                <i class="fa fa-info-circle"></i>
            </span>
        </div>
        <div class="alert-content">
            <strong>
                Авторизуйтесь в свой аккаунт, чтобы голосовать, получать бонусы и обменивать их
            </strong>
        </div>
    </div>
@endif