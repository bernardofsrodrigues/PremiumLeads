<!--begin::Form-->
<form class="form" action="{{route('register')}}" method="POST">
    @csrf
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Nome</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" id="nome" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nome do funcionário" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="email" id="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email@exemplo.com" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Senha</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="password" id="senha" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Digite a senha que será utilizada pelo usuário aqui." />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Confirmr senha</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="password" id="repassword" name="repassword" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Confirme a senha do usuário aqui." />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-7">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-5">Tipo de usuário</label>
            <!--end::Label-->
            <!--begin::Roles-->
            <!--begin::Input row-->
            <div class="d-flex fv-row">
                <!--begin::Radio-->
                <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input class="form-check-input me-3" name="type" type="radio" value="admin" id="kt_modal_update_role_option_0" checked='checked' />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label class="form-check-label" for="kt_modal_update_role_option_0" style="">
                        <div class="fw-bold text-gray-800" style="margin-top: 5%;">Administrador</div>
                        <div class="text-gray-600">Tem acesso total ao sistema, incluindo configurações avançadas, gerenciamento de usuários, controle de permissões e todas as demais funcionalidades.</div>
                    </label>
                    <!--end::Label-->
                </div>
                <!--end::Radio-->
            </div>
            <!--end::Input row-->
            <!--begin::Input row-->
            <div class="d-flex fv-row">
                <!--begin::Radio-->
                <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input class="form-check-input me-3" name="type" type="radio" value="user" id="kt_modal_update_role_option_3" />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label class="form-check-label" for="kt_modal_update_role_option_3">
                        <div class="fw-bold text-gray-800" style="margin-top: 7%;">Usuário comum</div>
                        <div class="text-gray-600">Não pode alterar configurações globais do sistema ou gerenciar outros usuários. Suas ações são geralmente restritas ao seu próprio escopo de trabalho.</div>
                    </label>
                    <!--end::Label-->
                </div>
                <!--end::Radio-->
            </div>
            <!--end::Input row-->
            <!--end::Roles-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Scroll-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Descartar alterações</button>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">Criar usuário</span>
            <span class="indicator-progress">Por favor espere...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->