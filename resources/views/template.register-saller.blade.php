{{--
  Template Name: Register Seller Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.register-seller.content')
  @endwhile
@endsection
