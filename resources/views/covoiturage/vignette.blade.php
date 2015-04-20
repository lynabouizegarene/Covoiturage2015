@foreach($covoituages as $covoituage)
    <?php $conducteur=$covoituage->conducteur; ?>
    <div class="thumbnail">
        <div class="media">
            <div class="media-left">
                <a href="{{route('user/show',$conducteur->id)}}">
                    <img class="media-object img-rounded" src="{{ $conducteur->pathPhoto('mini_') }}" alt="photo de profil">
                    <div class="text-center">
                        {{ $conducteur->prenom }}<br>
                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($conducteur->date_nais))->age }} ans
                    </div>
                </a>
            </div>
            <div class="media-body">
                <a href="{{route('covoiturage/show',$covoituage->id)}}">
                    <p>
                        <h4 class="media-heading">
                           <span class="color-green glyphicon glyphicon-map-marker"></span>
                           {{ $covoituage->villeDepart->nom }} <small>{{$covoituage->villeDepart->wilaya}}</small>
                           <span class="glyphicon glyphicon-chevron-right text-primary"></span>
                           <span class="color-red glyphicon glyphicon-map-marker"></span>
                           {{ $covoituage->villeArrivee->nom }} <small>{{$covoituage->villeArrivee->wilaya}}</small>
                        </h4>
                    </p><p>
                        <i class=" fa fa-calendar"></i>&nbsp; Départ&nbsp;
                        {{(\Carbon\Carbon::createFromTimestamp(strtotime($covoituage->date_depart))->diffForHumans()) }}&nbsp;
                        @if($covoituage->prix == 0)
                            <span class="label label-success">Gratuit</span>
                        @else
                            <span class="label label-primary">{{ $covoituage->prix }} DA</span>
                        @endif
                    </p><p>
                        <i class="fa fa-car"></i> &nbsp; Vehicule : {{ $covoituage->vehicule }}
                    </p>
                </a>
            </div>
        </div>
    </div>
 @endforeach