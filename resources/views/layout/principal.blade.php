<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
  @include('flash-toastr::message')
  @include('layout.head')

  <!-- BEGIN: Body-->
  <body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    @include('layout.navbar')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper d-none">
      <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
              <a class="navbar-brand" href="#">
                <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
              </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
          </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
          
        </div>
      </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-body">
          <section id="basic-horizontal-layouts">

            @yield('content')

          </section>
        </div>
      </div>
    </div>
    <!-- END: Content-->
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- Bootstrap-Table js -->
    <script src="{{ url('app-assets/plugins/bootstrap-table/bootstrap-table.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/locale/bootstrap-table-fr-FR.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/bootstrap-table-locale-all.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/export/bootstrap-table-export.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/multiple-sort/bootstrap-table-multiple-sort.min.js')}}"></script>
    <script src="{{ url('app-assets/plugins/bootstrap-table/extensions/print/bootstrap-table-print.min.js')}}"></script>
    <!-- END: Bootstrap-Table js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/localization/messages_fr.js"></script>
    <!-- BEGIN: Page JS-->
    @yield('page-script')
    <!-- END: Page JS-->
  </body>
  <!-- END: Body-->
</html>
