<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
function fastest_store_theme_setup(){

    // Make theme available for translation.
    load_theme_textdomain( 'fastest-store', get_stylesheet_directory_uri() . '/languages' );
    
}
add_action( 'after_setup_theme', 'fastest_store_theme_setup' );


if ( !function_exists( 'fastest_store_parent_css' ) ):
    function fastest_store_parent_css() {

        wp_enqueue_style( 'fastest-store-parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','icofont','scrollbar','magnific-popup','owl-carousel','fastest-shop-common','fastest-shop-style' ) );

    }
endif;
add_action( 'wp_enqueue_scripts', 'fastest_store_parent_css', 10 );

// Remove hook from Parent
if( !function_exists('fastest_store_disable_from_parent') ):

    add_action('init','fastest_store_disable_from_parent',10);
    function fastest_store_disable_from_parent(){
        
      global $fastest_shop_Header_Layout;
      remove_action('fastest_shop_site_header', array( $fastest_shop_Header_Layout, 'site_header_layout' ), 30 );
      remove_action('fastest_shop_site_header', array( $fastest_shop_Header_Layout, 'site_top_bar' ), 10 );
      
      remove_action( 'woocommerce_shop_loop_item_title','fastest_shop_loop_item_title',40 );

      global $fastest_shop_post_related;

      remove_action( 'fastest_shop_site_content_type', array( $fastest_shop_post_related,'site_loop_heading' ), 21 ); 
     
    }
    
endif;

// END ENQUEUE PARENT ACTION

if( !function_exists('fastest_store_header_layout') ) : 

    add_action('fastest_shop_site_header', 'fastest_store_header_layout', 30 );

    function fastest_store_header_layout(){
        global $fastest_shop_Header_Layout;
    ?>
    <header id="masthead" class="site-header header-5">
            <div class="container">
                <div class="d-flex justify-content-end">
                    <div class="branding-wrap">
                        <div class="block">
                            <?php do_action('fastest_shop_header_layout_1_branding');?>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-fill">

                        <?php do_action('fastest_shop_header_layout_1_navigation');?>
                    

                        <div class="d-flex header-info">
                            <?php if( !empty( fastest_shop_get_option('__topbar_phone') ) && !empty( fastest_shop_get_option('__topbar_address') ) && !empty( fastest_shop_get_option('__topbar_email') ) ) : ?>

                            <ul class="flat-support">
                                 <?php if( !empty( fastest_shop_get_option('__topbar_address') ) ):?>
                                 <li><i class="icofont-location-pin"></i> <?php echo esc_html( fastest_shop_get_option('__topbar_address')  );?> </li>
                                 <?php endif; ?>
                                 <?php if( !empty( fastest_shop_get_option('__topbar_email') ) ):?>
                                 <li><i class="icofont-email"></i> <?php echo esc_html( fastest_shop_get_option('__topbar_email')  );?> </li>
                                 <?php endif; ?>
                                 <?php if( !empty( fastest_shop_get_option('__topbar_phone') ) ):?>
                                 <li><i class="icofont-ui-cell-phone"></i> <?php echo esc_html( fastest_shop_get_option('__topbar_phone')  );?> </li>
                                  <?php endif; ?>   
                            </ul>
                            <?php endif;?>
                            <div class="table-cell text-right last-item item-wrap-4">
                            <?php echo wp_kses( $fastest_shop_Header_Layout->get_site_header_icon(), fastest_shop_alowed_tags() ); ?>
                            </div>
                        </div>


                    </div>
                </div>
                

            </div>
        </header>    
    <?php
    }
endif;



if ( ! function_exists( 'fastest_store_template_loop_product_title' ) ) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function fastest_store_template_loop_product_title() {
        echo '<h5 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">' . esc_html( get_the_title() ) . '</a></h5>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    add_action( 'woocommerce_shop_loop_item_title','fastest_store_template_loop_product_title',40 );
}


if ( ! function_exists( 'fastest_store_loop_heading' ) ) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function fastest_store_loop_heading() {
        if( is_page() ) return;
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h4>' );
        endif;
    }

    add_action( 'fastest_shop_site_content_type', 'fastest_store_loop_heading', 21 ); 
}



/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function fastest_store_custom_excerpt_length( $length ) {
    return 22;
}
add_filter( 'excerpt_length', 'fastest_store_custom_excerpt_length', 999 );


function fastest_store_filter_default_theme_options( $args ) {
    $args['blog_layout']              = 'full-container';
     $args['single_post_layout']      = 'sidebar-content';

    return $args;
}
add_filter( 'fastest_shop_filter_default_theme_options', 'fastest_store_filter_default_theme_options', 999 );


function fastest_store_filter_header_args( $args ) {
    $args['default-image'] = get_stylesheet_directory_uri() . '/image/custom-header.jpg';
    return $args;
}
add_filter( 'fastest_shop_custom_header_args', 'fastest_store_filter_header_args' );

