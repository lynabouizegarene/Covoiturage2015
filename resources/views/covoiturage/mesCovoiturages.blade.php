@extends('app')
@section('activeMesCovoiturages')
class="active"
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <div class="panel panel-default">
        <div class="panel-body">
            <div role="tabpanel" style="padding: 20px">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#annonce" aria-controls="annonce" role="tab" data-toggle="tab">Mes annonces</a></li>
                <li role="presentation"><a href="#reservation" aria-controls="reservation" role="tab" data-toggle="tab">Mes réservations</a></li>

              </ul>

              <!-- Tab panes -->
              <div class="tab-content" style="margin-top: 20px">
                <div role="tabpanel" class="tab-pane active" id="annonce">@include('covoiturage.mesCovoiturage.annonce')</div>
                <div role="tabpanel" class="tab-pane" id="reservation">@include('covoiturage.mesCovoiturage.reservation')</div>
              </div>

            </div>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection