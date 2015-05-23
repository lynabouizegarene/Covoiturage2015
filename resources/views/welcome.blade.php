@extends('app')
@section('content')
@include('covoiturage.recherche')
<div class="container-fluid">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="{{url("../public/img/Background.jpg")}}" alt="photo1">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img src="{{url("../public/img/1.jpg")}}" alt="photo2">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img src="{{url("../public/img/Background.jpg")}}" alt="photo3">
          <div class="carousel-caption">
          </div>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Précédent</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Prochain</span>
      </a>
    </div>
</div>
@endsection
@section('script_carousel')
<script>
$('.carousel').carousel()
</script>
@endsection