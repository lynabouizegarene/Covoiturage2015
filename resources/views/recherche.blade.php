<form>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="jumbotron dark">
        <div class="row">
            <div class="page-header dark text-center ">
              <h1>Chercher<br>
              <small>Votre covoiturage</small></h1>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">Départ</span>
                    <input name="autocomplete_d" id="autocomplete_d" type="text" class="form-control" value="{{ old('autocomplete_d') }}" required>
                    <span class="input-group-addon"><span class="color-green glyphicon glyphicon-map-marker"></span></span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">Arrivée</span>
                    <input name="autocomplete_a" id="autocomplete_a" type="text" class="form-control" value="{{ old('autocomplete_a') }}" required>
                    <span class="input-group-addon"><span class="color-red glyphicon glyphicon-map-marker"></span></span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa color-blue fa-calendar fa-lg"></i></span>
                    <input type="text" id="datepicker" class="form-control" placeholder="Date de départ">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden"  id="ville_d" name="ville_d" value="{{ old('ville_d') }}">
    <input type="hidden"  id="wilaya_d" name="wilaya_d" value="{{ old('wilaya_d') }}">
    <input type="hidden"  id="geoloc_d" name="geoloc_d" value="{{ old('geoloc_d') }}">

    <input type="hidden"  id="ville_a" name="ville_a" value="{{ old('ville_a') }}">
    <input type="hidden"  id="wilaya_a" name="wilaya_a" value="{{ old('wilaya_a') }}">
    <input type="hidden"  id="geoloc_a" name="geoloc_a" value="{{ old('geoloc_a') }}">

</form>

