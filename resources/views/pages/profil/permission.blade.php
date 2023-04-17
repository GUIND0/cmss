@extends('layout.main')

@section('title', 'Gestion des permission')

@section('content')
@section('page-title', 'Permissions '.$profil->libelle)
@section('page-button')
<div class="btn-group">
    <div class="text-right mb-2">
        <button type="button" class="toutCocher btn btn-light waves-effect">
            <i class="fa fa-check font-size-16 align-middle mr-2"></i> 
            Tout cocher
        </button>
        <button type="button" class="toutDeCocher btn btn-light waves-effect">
            <i class="fa fa-times font-size-16 align-middle mr-2"></i> 
            Tout décocher
        </button>
    </div>
</div>
@endsection
<form action="{{ route('permission.store', $profil->id ) }}" method='POST' role="form" id="form" class="form-horizontal">
        <input type="hidden" value="{{$profil->id}}" name="profil_id">
        @csrf
        <div class="row">
            @foreach ($controleurs as $controleur)
            
                <div class="col-md-4">
                    <div class="card card-box border border-primary waves-effect waves-light">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary"> 
                                <i class="fa fa-certificate mr-3"></i>
                                {!! ($controleur->description) ? $controleur->description : $controleur->nom !!}
                                
                                <i class="fa fa-check font-size-16 align-middle ml-2"></i>
                                <i class="fa fa-times font-size-16 align-middle mr-2"></i>
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-nowrap table-centered mb-0">
                                <tbody>
                                    @foreach ($controleur->methodes()->whereNotIn('methode', ['store','update','show','permission_store'])->orderBy('description', 'ASC')->get() as $action)

                                        <tr>
                                            <td class="" style="width: 60px;">
                                                <div class="ml-4 custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="action_id[]" id="{{ $action->id }}" value="{{ $action->id }}" {{ in_array($action->id, $permissions) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="{{ $action->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0">
                                                    <span class="text-dark">{!! ($action->description) ? $action->description : $action->methode !!}</span>
                                                </h5>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="col-md-12">
                <div class="form-group ">
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-1">Enregistrer</button>
                    <button type="reset" class="btn btn-danger waves-effect"> Annuler</button>
                </div>
            </div>
        </div>

    </form>

@endsection
@section('page-script')

<script>
    
    $('body').on('click', '.toutCocher', function (e) {
        e.preventDefault();
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    });

    $('body').on('click', '.toutDeCocher', function (e) {
        e.preventDefault();
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    });

</script>
@endsection
