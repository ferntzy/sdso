@php
  $container = 'container-xxl';
  $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', ' Home')

@section('content')
  <div class="row">
    <div class="col">
      @include('calendar.calendar')
    </div>
  </div>
@endsection