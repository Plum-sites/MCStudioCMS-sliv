<!-- <hr> -->
@php
$user_prefixes = App\UsersPrefixes::where([
  ['user_id', '=', @$user->id],
  ['server_id', '=', @$server->id]
])->first();
$user_privilege = App\UsersPrivileges::where([
  ['user_id', '=', @$user->id],
  ['server_id', '=', @$server->id]
])->first();
@endphp
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-4" role="alert">
    <div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong style="font-weight:700;">
            Текущий префикс: 
            <span class="prefix_current"></span>
        </strong>
    </div>
</div>
<script type="text/javascript">
    var prefix_minecraft = "{{ @$user_prefixes['prefix_full'] }} Моё сообщение в чате";
    prefix_minecraft = decodeHTMLEntities(prefix_minecraft);
    prefix_minecraft = mineParse(prefix_minecraft);
    if(prefix_minecraft.raw != '<span></span>') {
        $('[class="prefix_current"]').html(prefix_minecraft.raw);
    } else {
        $('[class="prefix_current"]').html("Стандартный для вашей привилегии {{ @$user_privilege['privileges']['name'] }}");
    }
</script>
<!-- <hr> -->
<!-- <div class="card p-3"> -->
    <form id="form_prefix" method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="chose1" value="black" id="chose1">
        <input type="hidden" name="chose2" value="black" id="chose2">
        <input type="hidden" name="chose3" value="black" id="chose3">
        <input type="hidden" name="prefix" value="" id="prefix">
        <div class="row mt-4">
            <div class="col-md-4 mb-1 mt-2">
                <div class="form-group">
                    <select class="form-control w-100" onchange="f_prefixes_color_prefix();" id="prefixes_color_prefix" name="prefixes_color_prefix">
                        <option value="" selected disabled>Цвет префикса</option>
                        <option style='background-color:black;' value='black'>Черный</option>
                        <option style='background-color:darkblue;' value='darkblue'>Тёмно-синий</option>
                        <option style='background-color:darkgreen;' value='darkgreen'>Тёмно-зеленый</option>
                        <option style='background-color:turquoise;' value='turquoise'>Бирюзовый</option>
                        <option style='background-color:purple;' value='purple'>Сиреневый</option>
                        <option style='background-color:gold;' value='gold'>Оранжевый</option>
                        <option style='background-color:gray;' value='gray'>Серый</option>
                        <option style='background-color:darkgray;' value='darkgray'>Светло-серый</option>
                        <option style='background-color:blue;' value='blue'>Синий</option>
                        <option style='background-color:green;' value='green'>Зеленый</option>
                        <option style='background-color:aqua;' value='aqua'>Светло-Синий</option>
                        <option style='background-color:magenta;' value='magenta'>Розовый</option>
                        <option style='background-color:white;' value='white'>Белый</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <select class="form-control w-100" onchange="f_prefixes_color_nick();" id="prefixes_color_nick" name="prefixes_color_nick">
                        <option value="" selected disabled>Цвет ника</option>
                        <option style='background-color:black;' value='black'>Черный</option>
                        <option style='background-color:darkblue;' value='darkblue'>Тёмно-синий</option>
                        <option style='background-color:darkgreen;' value='darkgreen'>Тёмно-зеленый</option>
                        <option style='background-color:turquoise;' value='turquoise'>Бирюзовый</option>
                        <option style='background-color:purple;' value='purple'>Сиреневый</option>
                        <option style='background-color:gold;' value='gold'>Оранжевый</option>
                        <option style='background-color:gray;' value='gray'>Серый</option>
                        <option style='background-color:darkgray;' value='darkgray'>Светло-серый</option>
                        <option style='background-color:blue;' value='blue'>Синий</option>
                        <option style='background-color:green;' value='green'>Зеленый</option>
                        <option style='background-color:aqua;' value='aqua'>Светло-Синий</option>
                        <option style='background-color:magenta;' value='magenta'>Розовый</option>
                        <option style='background-color:white;' value='white'>Белый</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <select class="form-control w-100" onchange="f_prefixes_color_message();" id="prefixes_color_message" name="prefixes_color_message">
                        <option value="" selected disabled>Цвет сообщения</option>
                        <option style='background-color:black;' value='black'>Черный</option>
                        <option style='background-color:darkblue;' value='darkblue'>Тёмно-синий</option>
                        <option style='background-color:darkgreen;' value='darkgreen'>Тёмно-зеленый</option>
                        <option style='background-color:turquoise;' value='turquoise'>Бирюзовый</option>
                        <option style='background-color:purple;' value='purple'>Сиреневый</option>
                        <option style='background-color:gold;' value='gold'>Оранжевый</option>
                        <option style='background-color:gray;' value='gray'>Серый</option>
                        <option style='background-color:darkgray;' value='darkgray'>Светло-серый</option>
                        <option style='background-color:blue;' value='blue'>Синий</option>
                        <option style='background-color:green;' value='green'>Зеленый</option>
                        <option style='background-color:aqua;' value='aqua'>Светло-Синий</option>
                        <option style='background-color:magenta;' value='magenta'>Розовый</option>
                        <option style='background-color:white;' value='white'>Белый</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-0">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" onchange="f_prefixes_word_prefix();" onkeyup="f_prefixes_word_prefix();" min="4" minlength="4" max="12" maxlength="12" placeholder="Введите префиксе" id="prefixes_word_prefix" name="prefixes_word_prefix">
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-0">
                <div id="prefixes_design_prefix" class="card mb-4" style="padding:.65rem 1.25rem;border-radius:.375rem;border:1px solid #e2e8f0;font-weight:510;">
                    <span>
                        [<span id='prefixes_design_color_prefix'>Prefix</span>]
                        <span id='prefixes_design_color_nick'>{{ @Auth::user()->username }}</span>: <span id='prefixes_design_color_message'>Пример сообщения</span>
                    </span>
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" id="prefixes_set_prefix" onclick="f_prefixes_set_prefix(this);" class="btn btn-sm btn-primary w-100">
                    Установить префикс
                </button>
            </div>
        </div>
    </form>
<!-- </div> -->
<script type="text/javascript">

    function f_prefixes_color_prefix() {
        var myselect = document.getElementById('prefixes_color_prefix');
        prefix = myselect.options[myselect.selectedIndex].value;
        document.getElementById('prefixes_design_color_prefix').style.color = prefix;
        document.getElementById('chose1').value = prefix;
    }

    function f_prefixes_color_nick() {
        var myselect = document.getElementById('prefixes_color_nick');
        prefix = myselect.options[myselect.selectedIndex].value;
        document.getElementById('prefixes_design_color_nick').style.color = prefix;
        document.getElementById('chose2').value = prefix;
    }

    function f_prefixes_color_message() {
        var myselect = document.getElementById('prefixes_color_message');
        prefix = myselect.options[myselect.selectedIndex].value;
        document.getElementById('prefixes_design_color_message').style.color = prefix;
        document.getElementById('chose3').value = prefix;
    }

    function f_prefixes_word_prefix() {
        prefixex_message_on = true;
        var prefix = document.getElementById('prefixes_word_prefix').value;
        document.getElementById('prefixes_design_color_prefix').innerHTML = prefix;
        document.getElementById('prefix').value = prefix;
    }

    function f_prefixes_ints_generator(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    function f_prefixes_word_changer() {
        if(prefixex_message_on) {
            if(document.getElementById('prefixes_design_color_message')) {
                document.getElementById('prefixes_design_color_message').innerHTML = prefixex_messages_text[f_prefixes_ints_generator(0, prefixex_messages_text.length - 1)];
            }
        }
    }
    f_prefixes_word_changer();

    function f_prefixes_set_prefix(elem) {
        $(elem).attr('disabled', true);
        var form = $('#form_prefix')[0];
        var form_data = new FormData(form);
        form_data.append('server_id', prefix_list_server_id);
        $.ajax({
            type: "POST",
            url: "{{ route('cabinet.prefix.save') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                notify(data.message, 8000, data.type);
                $('#prefixes_set_prefix').attr('disabled', false);
                if(data.type == "info") {
                    load_content_3();
                }
            },
            error: function(data) {
                console.log(data);
                $('#prefixes_set_prefix').attr('disabled', false);
            }
        });
    }

</script>