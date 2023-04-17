@extends('layout.main')

@section('title', 'Tableau de bord')
@section('page-style')
    <style>
      #chart_feuille_par_mois {
            width: 100%;
            height: 500px;
        }

    </style>
@endsection

@section('content')

<div class="card card-box">
    <div class="card-body">
            <form  action="{{ route('dashboard') }}" method="GET">
                @csrf
                    <div class="row justify-content-center mt-1">

                        <div class="col-sm-4" style="display: inline-block;">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_debut" value="{{request()->input('date_debut') ? request()->input('date_debut') : date("Y-m-d", strtotime('last monday', strtotime('tomorrow'))) }}">
                            </div>
                        </div>

                        <div class="col-sm-4" style="display: inline-block;">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_fin" value="{{request()->input('date_fin') ? request()->input('date_fin')   : date("Y-m-d", strtotime("today")) }}">
                            </div>
                        </div>

                        <div class="col-sm-1" style="right: 0px">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Filtrer</button>
                            </div>
                        </div>
                    </div>
            </form>
    </div>
</div>


<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $total_soins }}</h2>
                    <p class="card-text">Nombre de feuille de soin</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $total_prescriptions }}</h2>
                    <p class="card-text">Total des prescriptions</p>
                </div>
                <div class="avatar bg-light-success p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $total_ordonnances }}</h2>
                    <p class="card-text">Total des ordonnances</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $total_feuille_examens }}</h2>
                    <p class="card-text">Total feuilles d'examens</p>
                </div>
                <div class="avatar bg-light-warning p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon font-medium-5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ number_format($total_montant_ticket_mod, 0, '.', ' ') }} &nbsp; FCFA</h2>
                    <p class="card-text">Somme total des tickets modérateurs</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ number_format($total_montant_tiers_payant, 0, '.', ' ') }} &nbsp; FCFA</h2>
                    <p class="card-text">Somme total des tiers payant</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Nombre total de feuilles de soins par medecin</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse" class=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        </li>
                        <li>
                            <a data-action="reload"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></a>
                        </li>
                        <li>
                            <a data-action="close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table id="feuille_par_medecin" class="table table-hover mb-0">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Nombre adherent par compagnie</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse" class=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        </li>
                        <li>
                            <a data-action="reload"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></a>
                        </li>
                        <li>
                            <a data-action="close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table id="adherent_par_compagnie" class="table table-hover mb-0">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Nombre de feuilles de soins par Actes</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse" class=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        </li>
                        <li>
                            <a data-action="reload"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></a>
                        </li>
                        <li>
                            <a data-action="close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table id="feuille_par_prestation" class="table table-hover mb-0">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ADHERENTS PAR SEXE</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div id="chart_adherent_sexe" style="height:210px" style="height:210px" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Statistique Prestataire</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse" class=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        </li>
                        <li>
                            <a data-action="reload"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></a>
                        </li>
                        <li>
                            <a data-action="close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table id="feuille_par_prestataire" class="table table-hover mb-0">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('page-script')
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/spiritedaway.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);

    // Add data
    chart.data = [{
      "country": "Lithuania",
      "litres": 501.9
    }, {
      "country": "Czech Republic",
      "litres": 301.9
    }, {
      "country": "Ireland",
      "litres": 201.1
    }, {
      "country": "Germany",
      "litres": 165.8
    }, {
      "country": "Australia",
      "litres": 139.9
    }, {
      "country": "Austria",
      "litres": 128.3
    }, {
      "country": "UK",
      "litres": 99
    }, {
      "country": "Belgium",
      "litres": 60
    }, {
      "country": "The Netherlands",
      "litres": 50
    }];

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";
    </script>
<script>



        $('#feuille_par_medecin').bootstrapTable({
            data: @json($rsMedecin),
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            sortName: "created_at",
            locale: "fr-FR",
            search: true,
            searchAlign: "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType: "selected",
            mobileResponsive: false,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'prenom',
                    title: "Prénom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nom',
                    title: "Nom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nombre',
                    title: "Nombre",
                    sortable: true,
                    filterControl: "input",
                },

            ]

        });




        $('#adherent_par_compagnie').bootstrapTable({
            data: @json($rsCompagnie),
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            sortName: "created_at",
            locale: "fr-FR",
            search: true,
            searchAlign: "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType: "selected",
            mobileResponsive: false,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'code',
                    title: "Code",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'libelle',
                    title: "Libelle",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nombre',
                    title: "Nombre",
                    sortable: true,
                    filterControl: "input",
                },

            ]

        });


        $('#feuille_par_prestation').bootstrapTable({
            data: @json($rsPrestation),
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            sortName: "created_at",
            locale: "fr-FR",
            search: true,
            searchAlign: "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType: "selected",
            mobileResponsive: false,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'code',
                    title: "Code",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'libelle',
                    title: "Libelle",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nombre',
                    title: "Nombre",
                    sortable: true,
                    filterControl: "input",
                },

            ]

        });


        $('#feuille_par_prestataire').bootstrapTable({
            data: @json($rsPrestataire),
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            sortName: "created_at",
            locale: "fr-FR",
            search: true,
            searchAlign: "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType: "selected",
            mobileResponsive: false,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'code',
                    title: "Code",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'libelle',
                    title: "Libelle",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nombre',
                    title: "Nombre",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'ticket_mod',
                    title: "Total Ticket Modérateur",
                    sortable: true,
                    filterControl: "input",
                    formatter: amountFormatter
                },
                {
                    field: 'tiers_payant',
                    title: "Total Tiers Payant",
                    sortable: true,
                    filterControl: "input",
                    formatter: amountFormatter
                },

            ]

        });




        function amountFormatter(value, row, index){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

         // Create chart instance
        var chart = am4core.create("chart_adherent_sexe", am4charts.PieChart);

        // Add data
        chart.data = @json($rsAdherentBySexe);

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "nombre";
        pieSeries.dataFields.category = "sexe";


        am4core.ready(function() {

            // Themes begin
            //am4core.useTheme(am4themes_material);
            am4core.useTheme(am4themes_animated);
            am4core.color("#fff");
            // Themes end

            // Create chart instance
            var chart_carte = am4core.create("chart_feuille_par_mois", am4charts.XYChart3D);

            // Add data
            chart_carte.data = @json($soins_par_mois)

            // Create axes
            let categoryAxis = chart_carte.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "mois";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.tooltip.label.rotation = 270;
            categoryAxis.tooltip.label.horizontalCenter = "right";
            categoryAxis.tooltip.label.verticalCenter = "middle";

            let valueAxis = chart_carte.yAxes.push(new am4charts.ValueAxis());
            //valueAxis.title.text = "Mois";
            valueAxis.title.fontWeight = "bold";

            // Create series
            var series = chart_carte.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "nombre";
            series.dataFields.categoryX = "mois";
            series.name = "Nombre";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            series.tooltip.getFillFromObject = false;
            series.tooltip.label.propertyFields.fill = "color";
            series.tooltip.background.propertyFields.stroke = "color";

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;
            columnTemplate.stroke = am4core.color("#FFFFFF");

            columnTemplate.adapter.add("fill", function(fill, target) {
            return chart_carte.colors.getIndex(target.dataItem.index);
            })

            columnTemplate.adapter.add("stroke", function(stroke, target) {
            return chart_carte.colors.getIndex(target.dataItem.index);
            })

            chart_carte.cursor = new am4charts.XYCursor();
            chart_carte.cursor.lineX.strokeOpacity = 0;
            chart_carte.cursor.lineY.strokeOpacity = 0;

        }); // end am4core.ready()


</script>
@endsection
