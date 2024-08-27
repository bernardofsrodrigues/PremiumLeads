@extends('site.layouts.basico')

@section('title', 'Controle de bancos')

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
												<li class="breadcrumb-item text-gray-700"></li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Lista de bancos</h1>
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
													<input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Pesquisar banco" />
												</div>
												<!--end::Search-->
											</div>

											<!--begin::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Toolbar-->
												<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
												<!--begin::Add user-->
													<button action="{{route('controle_bancos.view')}}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" style="height: 50%">
													<i class="bi bi-bank2 fs-3"></i>  Adicionar Banco</button>
												<!--end::Add user-->
												</div>
												<!--end::Toolbar-->
												<!--begin::Group actions-->
												<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
													<div class="fw-bold me-5">
													<span class="me-2" data-kt-user-table-select="selected_count"></span>Selecionado(s)</div>
													<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Deletar selecionados</button>
												</div>
												<!--end::Group actions-->
												<!--begin::Modal - Adjust Balance-->
												<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Modal header-->
															<div class="modal-header">
																<!--begin::Modal title-->
																<h2 class="fw-bold">Export Users</h2>
																<!--end::Modal title-->
																<!--begin::Close-->
																<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
																	<i class="ki-duotone ki-cross fs-1">
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
																<form id="kt_modal_export_users_form" class="form" action="#">
																	<!--begin::Input group-->
																	<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bold">
																			<option></option>
																			<option value="Administrator">Administrador</option>
																			<option value="Analyst">Analyst</option>
																			<option value="Developer">Developer</option>
																			<option value="Support">Support</option>
																			<option value="Trial">Trial</option>
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="required fs-6 fw-semibold form-label mb-2">Select Export Format:</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
																			<option></option>
																			<option value="excel">Excel</option>
																			<option value="pdf">PDF</option>
																			<option value="cvs">CVS</option>
																			<option value="zip">ZIP</option>
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Actions-->
																	<div class="text-center">
																		<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Descartar</button>
																		<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
																			<span class="indicator-label">Enviar</span>
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
												<!--begin::Modal - Add task-->
												<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Modal header-->
															<div class="modal-header" id="kt_modal_add_user_header">
																<!--begin::Modal title-->
																<h2 class="fw-bold">Adicionar Banco</h2>
																<!--end::Modal title-->
																<!--begin::Close-->
																<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
																	<i class="bi bi-bank2 fs-3"></i>
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</div>
																<!--end::Close-->
															</div>
															<!--end::Modal header-->
															<!--begin::Modal body-->
															<div class="modal-body mx-5 mx-xl-15 my-7">
															<!--begin::Form-->
																@include('site.layouts.adicionar_bancos')
															</div>
															<!--end::Modal body-->
														</div>
														<!--end::Modal content-->
													</div>
													<!--end::Modal dialog-->
												</div>
												<!--end::Modal - Add task-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body py-4">
											<!--begin::Table-->
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
												<thead>
													<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-125px">BANCO</th>
														<th class="min-w-125px">Data de criação</th>
														<th class="text-end min-w-100px">Ações</th>
													</tr>
												</thead>
												<tbody class="text-gray-600 fw-semibold">
													@foreach ($bancos as $banco)
														@if ($banco->active == 1)
															@php $situacao = "Habilidado"; $class_situacao = "success"; $verbo_situacao = "Desabilitar";@endphp
														@else
															@php $situacao = "Desabilitado"; $class_situacao = "danger"; $verbo_situacao = "Habilitar";@endphp
														@endif
														<tr>
														<td>
															<div class="form-check form-check-sm form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="1" />
															</div>
														</td>
														<td class="d-flex align-items-center">
															<!--begin:: Avatar -->
															<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
																<a href="#">
																	<div class="symbol-label fs-3 bg-light-{{$class_situacao}} text-{{$class_situacao}}">B</div>
																</a>
															</div>
															<!--end::Avatar-->
															<!--begin::User details-->
															<div class="d-flex flex-column">
																<a href="#" class="text-gray-800 text-hover-primary mb-1">{{$banco->nome}}</a>
															</div>
															<!--begin::User details-->
														</td>
														<td>
															<div class="badge badge-light-{{$class_situacao}} fw-bold">{{$situacao}}</div>
														</td>
														<td>{{$banco->created_at->format('d/m/Y H:i:s')}}</td>
														<td class="text-end">
															<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Ações
															<i class="bi bi-caret-down-fill ms-1"></i></a>
															<!--begin::Menu-->
															<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
																<!--begin::Menu item-->
																<div class="menu-item px-3">
																	<a href="{{ route('controle_bancos.deletar', $banco->id) }}" class="menu-link px-3">{{ $verbo_situacao }}</a>
																</div>
																<!--end::Menu item-->
															</div>
															<!--end::Menu-->
														</td>
													</tr>
													@endforeach
													
												</tbody>
											</table>
											<!--end::Table-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
@endsection

