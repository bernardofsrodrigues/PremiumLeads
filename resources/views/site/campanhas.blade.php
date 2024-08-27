@extends('site.layouts.basico')

@section('title', 'Campanhas')

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
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Campanhas processando</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="bi bi-chevron-double-right"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Processamento</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Processamento</h1>
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
										<!--begin::Card header-->
										<div class="card-header border-0 pt-6">
											<!--begin::Card title-->
											<div class="card-title">
												<!--begin::Search-->
												<div class="d-flex align-items-center position-relative my-1">
													<i class="bi bi-search position-absolute ms-5">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Pesquisar base" />
												</div>
												<!--end::Search-->
											</div>
											<!--begin::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Toolbar-->
												<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
													<!--begin::Filter-->
													<div class="w-150px me-3">
														<!--begin::Select2-->
														<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
															<option></option>
															<option value="all">Todas</option>
															<option value="active">Processando</option>
															<option value="locked">Em pausa</option>
															<option value="locked">Erro</option>
														</select>
														<!--end::Select2-->
													</div>
													<!--end::Filter-->
													<!--begin::Export-->
													<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
													<i class="bi bi-download fs-3">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>Exportar</button>
													<!--end::Export-->
													<!--begin::Add customer-->
													<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Adicionar base</button>
													<!--end::Add customer-->
												</div>
												<!--end::Toolbar-->
												<!--begin::Group actions-->
												<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
													<div class="fw-bold me-5">
													<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selecionada(as)</div>
													<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Deletar base</button>
												</div>
												<!--end::Group actions-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pt-0">
											<!--begin::Table-->
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
												<thead>
													<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-125px">Nome da base</th>
														<th class="min-w-125px">Progresso da base</th>
														<th class="min-w-125px">Status</th>
														<th class="min-w-125px">Usuário</th>
														<th class="min-w-125px">Data de envio</th>
														<th class="text-end min-w-70px">Ações</th>
													</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
											</a>
											<!--end::Card-->
													@foreach ($campanhas as $campanha)
													<tr>
													
														<td>
															<div class="form-check form-check-sm form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="1" />
															</div>
														</td>
														<td>
															<a href="#" class="text-gray-800 text-hover-primary mb-1">{{$campanha->nome}}</a>
														</td>
														<td>
															<a href="#" class="text-gray-600 text-hover-primary mb-1">{{'74%'}}</a>
														</td>
														<td>
															<!--begin::Badges-->
																@php
																	$class = $campanha->sit_campanha ? 'badge badge-light-success' : 'badge badge-light-danger';
																	$status = $campanha->sit_campanha ? 'Processando' : 'Em Pausa';
																@endphp															
															<div class="{{ $class }}">
																{{$status }}
															</div>
															<!--end::Badges-->
														</td>
														<td>{{$campanha->user->name}}</td>
														<td>{{$campanha->created_at->format('d/m/Y H:i:s')}}</td>
														<td class="text-end">
															<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Ações
															<i class="bi bi-caret-down-fill ms-1"></i></a>
															<!--begin::Menu-->
															<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
																<!--begin::Menu item-->
																<div class="menu-item px-3">
																	<a href="#" class="menu-link px-3">Pausar</a>
																</div>
																<!--end::Menu item-->
																<!--begin::Menu item-->
																<div class="menu-item px-3">
																	<a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Prosseguir</a>
																</div>
																<!--end::Menu item-->
															</div>
															<!--end::Menu-->
														</td>
													</tr>
													@endforeach
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
												<form class="form" action="#" id="kt_modal_add_customer_form" data-kt-redirect="../dist/apps/customers/list.php">
													<!--begin::Modal header-->
													<div class="modal-header" id="kt_modal_add_customer_header">
														<!--begin::Modal title-->
														<h2 class="fw-bold">Add a Customer</h2>
														<!--end::Modal title-->
														<!--begin::Close-->
														<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
															<i class="ki-duotone ki-cross fs-1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</div>
														<!--end::Close-->
													</div>
													<!--end::Modal header-->
													<!--begin::Modal body-->
													<div class="modal-body py-10 px-lg-17">
														<!--begin::Scroll-->
														<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
															<!--begin::Input group-->
															<div class="fv-row mb-7">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold mb-2">Name</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="" name="name" value="Sean Bean" />
																<!--end::Input-->
																<!--begin::Input group-->
																<div class="row g-9 mb-7">
																	<!--begin::Col-->
																	<div class="col-md-6 fv-row">
																		<!--begin::Label-->
																		<label class="required fs-6 fw-semibold mb-2">State / Province</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input class="form-control form-control-solid" placeholder="" name="state" value="Victoria" />
																		<!--end::Input-->
																	</div>
																	<!--end::Col-->
																	<!--begin::Col-->
																	<div class="col-md-6 fv-row">
																		<!--begin::Label-->
																		<label class="required fs-6 fw-semibold mb-2">Post Code</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input class="form-control form-control-solid" placeholder="" name="postcode" value="3000" />
																		<!--end::Input-->
																	</div>
																	<!--end::Col-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="d-flex flex-column mb-7 fv-row">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">
																		<span class="required">Country</span>
																		<span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
																			<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
																				<span class="path1"></span>
																				<span class="path2"></span>
																				<span class="path3"></span>
																			</i>
																		</span>
																	</label>
																	<!--end::Label-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Wrapper-->
																	<div class="d-flex flex-stack">
																		<!--begin::Label-->
																		<div class="me-5">
																			<!--begin::Label-->
																			<label class="fs-6 fw-semibold">Use as a billing adderess?</label>
																			<!--end::Label-->
																			<!--begin::Input-->
																			<div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
																			<!--end::Input-->
																		</div>
																		<!--end::Label-->
																		<!--begin::Switch-->
																		<label class="form-check form-switch form-check-custom form-check-solid">
																			<!--begin::Input-->
																			<input class="form-check-input" name="billing" type="checkbox" value="1" id="kt_modal_add_customer_billing" checked="checked" />
																			<!--end::Input-->
																			<!--begin::Label-->
																			<span class="form-check-label fw-semibold text-muted" for="kt_modal_add_customer_billing">Yes</span>
																			<!--end::Label-->
																		</label>
																		<!--end::Switch-->
																	</div>
																	<!--begin::Wrapper-->
																</div>
																<!--end::Input group-->
															</div>
															<!--end::Billing form-->
														</div>
														<!--end::Scroll-->
													</div>
													<!--end::Modal body-->
													<!--begin::Modal footer-->
													<div class="modal-footer flex-center">
														<!--begin::Button-->
														<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Descartar</button>
														<!--end::Button-->
														<!--begin::Button-->
														<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
															<span class="indicator-label">Enviar</span>
															<span class="indicator-progress">Carregando...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
														<!--end::Button-->
													</div>
													<!--end::Modal footer-->
												</form>
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
