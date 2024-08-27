<form action="{{ route('higienizacao.view.post', ['banco' => $banco, 'produto' => $produto, 'id' => $id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body py-10 px-lg-17">
            <input type="hidden" value="{{ $id }}" name="banco_id" class="form-control form-control-lg" required />
        <div class="mb-3">
            <label for="nome" class="form-label fw-semibold">Nome da campanha</label>
            <input type="text" value="{{ old('nome') }}" id="nome" name="nome" class="form-control form-control-lg" placeholder="Insira o nome aqui" required />
        </div>
        <div class="mb-3">
            <label for="arquivo" class="form-label fw-semibold">Selecionar arquivo</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control" accept=".csv,.txt">
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button type="reset" class="btn btn-light me-3">Descartar</button>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">Enviar</span>
            <span class="indicator-progress d-none">Carregando...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
