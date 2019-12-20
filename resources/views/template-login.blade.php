{{--
  Template Name: Login Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.login.content')
  @endwhile
@endsection
