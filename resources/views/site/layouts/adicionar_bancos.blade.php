<!--begin::Form-->
<form class="form" action="{{route('controle_bancos.adicionar')}}" method="POST">
    @csrf
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <label class="required fw-semibold fs-6 mb-2">Nome</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="nome" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nome do banco" />
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Descartar alterações</button>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">Adicionar Banco</span>
            <span class="indicator-progress">Por favor espere...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->