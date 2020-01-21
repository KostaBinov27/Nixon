{{--
  Template Name: Dashboard Seller Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.dashboards.seller')
  @endwhile
@endsection
