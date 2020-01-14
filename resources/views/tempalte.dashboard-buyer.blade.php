{{--
  Template Name: Dashboard Buyer Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.dashboards.buyer')
  @endwhile
@endsection
