@extends('site.layouts.basico')

@section('title', 'Controle de bases')

@section('dashboard')
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar pt-5">
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
									<!--begin::Toolbar wrapper-->
									<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
										<!--begin::Page title-->
										<div class="page-title d-flex flex-column gap-1 me-3 mb-2">
											<!--begin::Breadcrumb-->
											<ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Gerenciamento</li>
												<!--end::Item-->
                                                <!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="bi bi-chevron-double-right"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Controle de bases</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="bi bi-chevron-double-right"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Bases</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="bi bi-chevron-double-right"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700">Lista de bases</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Banco {{ $banco }}</h1>
											<!--end::Title-->
										</div>
										<!--end::Page title-->
									</div>
									<!--end::Toolbar wrapper-->
								</div>
								<!--end::Toolbar container-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
									<!--begin::Card-->
									<div class="card">
										<!--begin::Card body-->
										<div class="card-body pt-0">
											<!--begin::Table-->
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
												<tbody class="fw-semibold text-gray-600">
													<tr>
											</a>
											<!--end::Card-->

													<!--begin::Card-->
												<!--begin::Card header-->
												<div class="card-header border-0 pt-9">
													<!--begin::Card Title-->
													<div class="card-title m-0">
														<!--begin::Avatar-->
														<div class="symbol symbol-50px  bg-light" style="padding: 40%;">
															<i class="bi bi-filetype-csv fs-1"></i>
														</div>
														<!--end::Avatar-->
													</div>
													<!--end::Car Title-->
													<!--begin::Card toolbar-->
													<div class="card-toolbar">
														<span class="badge badge-light-warning fw-bold me-auto px-4 py-3">Atenção</span>
													</div>
													<!--end::Card toolbar-->
												</div>
												<!--end:: Card header-->
												<!--begin:: Card body-->
												<div class="card-body p-9">
													<!--begin::Name-->
													<div class="fs-3 fw-bold text-dark">Higienizacao em lote saque complementar e refinanciamento</div>
													<!--end::Name-->
													<!--begin::Description-->
													<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">O arquivo precisa conter os seguintes campos Nome, CPF, Beneficio, Renda e Data de Nascimento.</p>
													<!--end::Description-->
													<!--begin::Progress-->
													<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 50% completed">
														<div class="bg-primary rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<!--end::Progress-->
													<!--begin::Name-->
													<div class="fs-3 fw-bold text-dark">Para higienização em lote FGTS</div>
													<!--end::Name-->
													<!--begin::Description-->
													<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">O arquivo precisa conter os seguintes campos Nome, CPF e Data de Nascimento.</p>
													<!--end::Description-->
													<!--begin::Progress-->
													<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 50% completed">
														<div class="bg-primary rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<!--end::Progress-->
													<!--begin::Name-->
													<div class="fs-3 fw-bold text-dark">Para higienização em lote IN100</div>
													<!--end::Name-->
													<!--begin::Description-->
													<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">O arquivo precisa conter os seguintes campos Benefício.</p>
													<!--end::Description-->
													<!--begin::Progress-->
													<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 50% completed">
														<div class="bg-primary rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<!--end::Progress-->
												</div>
												<!--end:: Card body-->
													<!--begin::Add customer-->
													<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer" style="margin-left: 40%;">Adicionar base</button>
													<!--end::Add customer-->
													</tr>
												</tbody>
												<!--end::Table body-->
											</table>
											<!--end::Table-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
									<!--begin::Modals-->
									<!--begin::Modal - Customers - Add-->
									<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
										<!--begin::Modal dialog-->
										<div class="modal-dialog modal-dialog-centered mw-650px">
											<!--begin::Modal content-->
											<div class="modal-content">
												<!--begin::Form-->
													<!--begin::Modal header-->
													<div class="modal-header" id="kt_modal_add_customer_header">
														<!--begin::Modal title-->
														<h2 class="fw-bold">Processar Campanha</h2>
														<!--end::Modal title-->
														<!--begin::Close-->
														<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
															<i class="bi bi-filetype-csv fs-1"></i>
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</div>
														<!--end::Close-->
													</div>
													<!--end::Modal header-->
													<!--begin::Modal body-->
@include('site.components.formulario_adicionar_base')
												<!--end::Form-->
											</div>
										</div>
									</div>
									<!--end::Modal - Customers - Add-->
									<!--begin::Modal - Adjust Balance-->
									<div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
										<!--begin::Modal dialog-->
										<div class="modal-dialog modal-dialog-centered mw-650px">
											<!--begin::Modal content-->
											<div class="modal-content">
												<!--begin::Modal header-->
												<div class="modal-header">
													<!--begin::Modal title-->
													<h2 class="fw-bold">Exportar bases</h2>
													<!--end::Modal title-->
													<!--begin::Close-->
													<div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
														<i class="bi bi-download fs-3">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Close-->
												</div>
												<!--end::Modal header-->
												<!--begin::Modal body-->
												<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
													<!--begin::Form-->
													<form id="kt_customers_export_form" class="form" action="#">
														<!--begin::Input group-->
														<div class="fv-row mb-10">
															<!--begin::Label-->
															<label class="fs-5 fw-semibold form-label mb-5">Selecione o formato de exportação:</label>
															<!--end::Label-->
															<!--begin::Input-->
															<select data-control="select2" data-placeholder="Selecione o formato" data-hide-search="true" name="format" class="form-select form-select-solid">
																<option></option>
																<option value="pdf">.xlsx</option>
																<option value="cvs">.csv</option>
															</select>
															<!--end::Input-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="fv-row mb-10">
															<!--begin::Label-->
															<label class="fs-5 fw-semibold form-label mb-5">Digite o nome para download:</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input class="form-control form-control-solid" placeholder="Digite o nome" name="date" />
															<!--end::Input-->
														</div>
														<!--end::Input group-->
														<!--begin::Actions-->
														<div class="text-center">
															<button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Descartar</button>
															<button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
																<span class="indicator-label">Baixar</span>
																<span class="indicator-progress">Carregando...
																<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
															</button>
														</div>
														<!--end::Actions-->
													</form>
													<!--end::Form-->
												</div>
												<!--end::Modal body-->
											</div>
											<!--end::Modal content-->
										</div>
										<!--end::Modal dialog-->
									</div>
									<!--end::Modal - New Card-->
									<!--end::Modals-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
@endsection