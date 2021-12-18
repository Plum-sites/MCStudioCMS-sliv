
<form action="{{ route('reset.pass.cabinet') }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-control-label">Ваш email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control form-control-muted" disabled value="{{ @Auth::user()->email }}" title="Невозможно изменить">
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Ваш ник</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control form-control-muted" disabled value="{{ @Auth::user()->username }}" title="Невозможно изменить">
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Новый пароль</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="password" class="form-control form-control-muted {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Введите новый пароль" title="Введите новый пароль">
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Повторить пароль</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="password_confirmation" class="form-control form-control-muted {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Повторите новый пароль" title="Должен совпадать с первым">
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-icon">
        <span class="btn-inner--text">Сохранить</span>
        <span class="btn-inner--icon">
            <i class="fas fa-save"></i>
        </span>
    </button>
</form>