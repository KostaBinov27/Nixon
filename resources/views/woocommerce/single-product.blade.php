@extends('layouts.app')

  @section('content')
    @php
      do_action('get_header', 'shop');
    @endphp
  <div class="container mt-5">
    @while(have_posts())
      @php
        the_post();
        do_action('woocommerce_shop_loop'); @endphp
        <div class="row">
          <div class="col-lg-12">
            @php do_action( 'woocommerce_before_single_product' ); @endphp
          </div>
          <div class="col-lg-6 col-md-6">
            @php woocommerce_show_product_images(); @endphp
          </div>
          <div class="col-lg-6 col-md-6">
            @php woocommerce_template_single_title(); @endphp
            <hr>
            @php woocommerce_template_single_meta(); @endphp
            <h2 class="mt-3">Description</h2>
            <hr>
            <div class="contentSingleProduct">
              @php the_content(); @endphp
            </div>
            <div class="mt-5 singleFlex">
              @php woocommerce_template_single_price(); @endphp
            </div>
            <div>
              @php woocommerce_template_single_add_to_cart(); @endphp
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-12">
           @php woocommerce_output_related_products(); @endphp
          </div>
        </div>
    @endwhile
  </div>
    @php
      do_action('woocommerce_after_main_content');
      do_action('get_sidebar', 'shop');
      do_action('get_footer', 'shop');
    @endphp
    
  @endsection


