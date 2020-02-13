{{--
The Template for displaying product archives, including the main shop page which is a post type archive
This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.
@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')


  @section('content')
    @php
      do_action('get_header', 'shop');
      do_action('woocommerce_before_main_content');
    @endphp

    <header class="woocommerce-products-header d-none">
      @if(apply_filters('woocommerce_show_page_title', true))
        <h1 class="woocommerce-products-header__title page-title">{!! woocommerce_page_title(false) !!}</h1>
      @endif

      @php
        do_action('woocommerce_archive_description');
      @endphp
    </header>
    <div class="heroImage-shop">
        <div class="colorLayout-shop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto text-center">
                        <h1>Pick the Best Product for you Needs</h1>
                        <!-- <p>Nixon is an online buying and selling site that has millions of online stores and sells various kinds of products to meet your needs.</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-5">
    @if(woocommerce_product_loop())
      @php
        do_action('woocommerce_before_shop_loop');
        woocommerce_product_loop_start();
      @endphp

      @if(wc_get_loop_prop('total'))
        @while(have_posts())
          @php
            the_post();
            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');
          @endphp
        @endwhile
      @endif

      @php
        woocommerce_product_loop_end();
        do_action('woocommerce_after_shop_loop');
      @endphp
    @else
      @php
        do_action('woocommerce_no_products_found');
      @endphp
    @endif
</div>
    @php
      do_action('woocommerce_after_main_content');
      do_action('get_sidebar', 'shop');
      do_action('get_footer', 'shop');
    @endphp
  @endsection
