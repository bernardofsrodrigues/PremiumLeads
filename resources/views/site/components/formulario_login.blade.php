<form class="form w-100" action="{{route('login')}}" method="POST">
@csrf
    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">Acessar sua conta</h1>
        <!--end::Title-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="form-label fs-6 fw-bold text-dark">Email</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input id="email" value="{{ old('email') }}" class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-2">
            <!--begin::Label-->
            <label class="form-label fw-bold text-dark fs-6 mb-0">Senha</label>
            <!--end::Label-->
            <!--begin::Link-->
            <a href="../dist/authentication/sign-in/password-reset.html" class="link-primary fs-6 fw-bold">Esqueceu sua senha?</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Input-->
        <input id="senha" value="{{ old('password') }}" class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif

        <input id="senha" class="d-none" name="device" value="site" />
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
            <span class="indicator-label">Entrar</span>
            <span class="indicator-progress">Carregando...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <!--end::Submit button-->
        
    </div>
    <!--end::Actions-->
    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</form>