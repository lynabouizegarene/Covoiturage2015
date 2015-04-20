@extends('app')

@section('activeAccueil')
class="active"
@endsection

@section('content')
<link href="{{ asset('css/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('recherche')
        </div>
    </div>
	<div class="row">
	    @if (Session::has('message'))
	    <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        		<strong>{{ Session::get('message') }}</strong>
        	</div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
            	<div class="panel-heading"><h5>Votre profil</h5></div>
            	<div class="panel-body">

            	</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
            	<div class="panel-heading"><h5>Ca se passe près de chez vous !</h5></div>
            	<div class="panel-body">
                    <?php $covoituages = $pasLoins?>
                    @include('covoiturage.vignette', $covoituages)
            	</div>
            </div>
        </div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h5>Les dernières annonces de covoiturage</h5></div>
				<div class="panel-body">
                    <?php $covoituages = $recents ?>
                    @include('covoiturage.vignette', $covoituages)
			    </div>
		    </div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h5>Les covoiturages gratuits</h5></div>
				<div class="panel-body">
                    <?php $covoituages = $bonplans ?>
                    @include('covoiturage.vignette', $covoituages)
			    </div>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('maps_onload')
    onload="initialize()"
@endsection

@section('maps_script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&language=fr&region=dz"></script>
@endsection

@section('script_maps_autocomplete')
        <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('locales/bootstrap-datepicker.fr-CH.min.js')}}"></script>
    	<script>
            $('#datepicker').datepicker({
                format: "yyyy-mm-dd",
                weekStart: 7,
                startDate: "now",
                todayBtn: "linked",
                language: "fr"
            });
        </script>
    <script src="{{asset('js/maps_autocomplete.js')}}"></script>
@endsection
