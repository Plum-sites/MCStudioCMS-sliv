@extends('admin.layouts.master')
@section('page_icon', 'fa fa-lock')
@section('page_name', 'Смена пароля')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <!-- <h3 class="tile-title">Смена пароля</h3> -->
                <form method="post" action="{{ route('admin.pass.change')}}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"><b>Текущий пароль</b></label>
                            <input class="form-control form-control-lg" type="password" name="cur_pass" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Новый пароль</b></label>
                            <input class="form-control form-control-lg" type="password" name="new_pass" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Подтвердите новый пароль</b></label>
                            <input class="form-control form-control-lg" type="password" name="con_pass" required>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary btn-block btn-lg" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i> Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
        });
    </script>
@endsection