@extends('site.layouts.basico')

@section('title', 'Sobre')

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
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1">Premium Leads</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">Sobre</h1>
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
												<div class="card-header pt-5 d-flex justify-content-center align-items-center">
                                                    <i class="bi bi-info-circle-fill fs-1" style="color: #F6C000;"></i>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-6">	
                                                <p>Texto sobre premium leads</p>												
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
