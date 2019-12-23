{{--
  Template Name: Register Buyer Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.register-buyer.content')
  @endwhile
@endsection
