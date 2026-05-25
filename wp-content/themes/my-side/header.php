<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>

            <?php if (is_front_page() && is_home()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <p class="site-description"><?php bloginfo('description'); ?></p>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
            )); ?>
        </nav>
        <div class="myside-product-cta">
            <?php
            $product_page = get_page_by_path('product');
            if ( $product_page ) {
                $product_url = get_permalink( $product_page->ID );
            } else {
                $product_url = esc_url( site_url('/product') );
            }
            ?>
            <a class="button myside-product-button" href="<?php echo esc_url( $product_url ); ?>"><?php _e('Add Product', 'myside'); ?></a>
        </div>
    </header>

    <div id="content" class="site-content">
