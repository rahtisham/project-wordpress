<aside id="secondary" class="widget-area myside-sidebar">
    <?php get_search_form(); ?>

    <section class="widget widget_about">
        <h2 class="widget-title"><?php bloginfo('name'); ?></h2>
        <p><?php bloginfo('description'); ?></p>
    </section>

    <section class="widget widget_product_cta">
        <?php
        $product_page = get_page_by_path('product');
        if ( $product_page ) {
            $product_url = get_permalink( $product_page->ID );
        } else {
            $product_url = esc_url( site_url('/product') );
        }
        ?>
        <a class="button myside-product-button" href="<?php echo esc_url( $product_url ); ?>"><?php _e('Add Product', 'myside'); ?></a>
    </section>

    <section class="widget widget_recent_entries">
        <h2 class="widget-title"><?php _e('Recent Posts', 'myside'); ?></h2>
        <ul>
            <?php
            $recent = wp_get_recent_posts(array('numberposts'=>5,'post_status'=>'publish'));
            foreach($recent as $post){
                printf('<li><a href="%1$s">%2$s</a></li>', esc_url(get_permalink($post['ID'])), esc_html($post['post_title']));
            }
            ?>
        </ul>
    </section>

    <section class="widget widget_products">
        <h2 class="widget-title"><?php _e('Recent Products', 'myside'); ?></h2>
        <ul>
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'myside_products';
            if ( $wpdb->get_var( "SHOW TABLES LIKE '%s'" , $table ) == $table ) {
                $products = $wpdb->get_results( $wpdb->prepare( "SELECT id,name,price FROM {$table} ORDER BY id DESC LIMIT %d", 5 ) );
                if ( $products ) {
                    foreach ( $products as $p ) {
                        printf('<li>%s — %s</li>', esc_html( $p->name ), esc_html( number_format_i18n( $p->price, 2 ) ) );
                    }
                } else {
                    echo '<li>' . __('No products yet','myside') . '</li>';
                }
            } else {
                echo '<li>' . __('No products table','myside') . '</li>';
            }
            ?>
        </ul>
    </section>

    <section class="widget widget_categories">
        <h2 class="widget-title"><?php _e('Categories', 'myside'); ?></h2>
        <ul><?php wp_list_categories(array('title_li'=>'')); ?></ul>
    </section>

    <section class="widget widget_tag_cloud">
        <h2 class="widget-title"><?php _e('Tags', 'myside'); ?></h2>
        <?php wp_tag_cloud(array('smallest'=>10,'largest'=>16,'unit'=>'px')); ?>
    </section>

    <?php if (is_active_sidebar('sidebar-1')) dynamic_sidebar('sidebar-1'); ?>
</aside>
