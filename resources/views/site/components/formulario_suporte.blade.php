<form action="{{ route('suporte.post') }}" method="post">
    @csrf
    <label class="fw-semibold fs-6 mb-2"">Enviar mensagem:</label>
    <textarea type="text" value="{{ old('mensagem') }}" id="" name="mensagem" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Digite aqui a mensagem que será enviada para o suporte." style="height: 20vh; margin-top: 1%"></textarea>
    <button type="submit" class="btn btn-primary" style="padding: 1% 4%; margin-top: 1%;"">
        <span class="indicator-label">Enviar</span>
        <span class="indicator-progress d-none">Carregando...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</form>