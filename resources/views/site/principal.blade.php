@extends('site.layouts.basico')

@section('title', 'Home')

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
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Home</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="bi bi-chevron-double-right"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700">Página principal</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Dashboard</h1>
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
									<!--begin::Row-->
									<div class="row gx-5 gx-xl-10">
				
										<!--begin::Col-->
										<div class="col-xl-12 mb-5 mb-xl-10">
											<!--begin::Tables widget 16-->
											<div class="card card-flush h-xl-100">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">Navegação</span>
													</h3>
													<!--end::Title-->

												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-6">
													<!--begin::Nav-->
													<ul class="nav nav-pills nav-pills-custom mb-3">
														<!--begin::Item-->
														<li class="nav-item mb-3 me-3 me-lg-6">
															<!--begin::Link-->
															<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-200px h-200px pt-5 pb-2 active" id="kt_stats_widget_16_tab_link_1" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_1">
																<!--begin::Icon-->
																<div class="nav-icon mb-3">
																	<i class="bi bi-filetype-csv fs-1"></i>
																</div>
																<!--end::Icon-->
																<!--begin::Title-->
																<span class="nav-text text-gray-800 fw-bold fs-2 lh-1">Campanhas</span> 
																<!--end::Title-->
																<!--begin::Bullet-->
																<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
																<!--end::Bullet-->
															</a>
															<!--end::Link-->
														</li>
														<!--end::Item-->
														<!--begin::Item-->
														<li class="nav-item mb-3 me-3 me-lg-6">
															<!--begin::Link-->
															<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-200px h-200px pt-5 pb-2" id="kt_stats_widget_16_tab_link_2" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_2">
																<!--begin::Icon-->
																<div class="nav-icon mb-3">
																<i class="bi bi-person-circle fs-1"></i>
																</div>
																<!--end::Icon-->
																<!--begin::Title-->
																<span class="nav-text text-gray-800 fw-bold fs-2 lh-1">Leads</span>
																<!--end::Title-->
																<!--begin::Bullet-->
																<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
																<!--end::Bullet-->
															</a>
															<!--end::Link-->
														</li>
														<!--end::Item-->
														<!--begin::Item-->
														<li class="nav-item mb-3 me-3 me-lg-6">
															<!--begin::Link-->
															<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-200px h-200px pt-5 pb-2" id="kt_stats_widget_16_tab_link_3" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_3">
																<!--begin::Icon-->
																<div class="nav-icon mb-3">
																	<i class="bi bi-pie-chart-fill fs-1"></i>
																</div>
																<!--end::Icon-->
																<!--begin::Title-->
																<span class="nav-text text-gray-800 fw-bold fs-2 lh-1">Relatórios</span>
																<!--end::Title-->
																<!--begin::Bullet-->
																<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
																<!--end::Bullet-->
															</a>
															<!--end::Link-->
														</li>
														<!--end::Item-->
														<!--begin::Item-->
														<li class="nav-item mb-3 me-3 me-lg-6">
															<!--begin::Link-->
															<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-200px h-200px pt-5 pb-2" id="kt_stats_widget_16_tab_link_4" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_4">
																<!--begin::Icon-->
																<div class="nav-icon mb-3">
																<i class="bi bi-check2-circle fs-1"></i>
																</div>
																<!--end::Icon-->
																<!--begin::Title-->
																<span class="nav-text text-gray-800 fw-bold fs-2 lh-1">Atividades</span>
																<!--end::Title-->
																<!--begin::Bullet-->
																<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
																<!--end::Bullet-->
															</a>
															<!--end::Link-->
														</li>
														<!--end::Item-->

													</ul>
													<!--end::Nav-->
													
												</div>
												<!--end: Card Body-->
											</div>
											<!--end::Tables widget 16-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
@endsection
