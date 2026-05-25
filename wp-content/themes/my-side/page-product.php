<?php
/**
 * Template Name: Product Form
 *
 * A custom page template to create products with a name and price.
 */

get_header();

global $wpdb;
$table_name = $wpdb->prefix . 'myside_products';
$message = '';
$message_class = '';

if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['myside_product_submit'])) {
    if (!isset($_POST['myside_product_nonce']) || !wp_verify_nonce($_POST['myside_product_nonce'], 'myside_product_action')) {
        $message = __('Security check failed. Please reload the page and try again.', 'myside');
        $message_class = 'error';
    } else {
        $product_name = sanitize_text_field(wp_unslash($_POST['product_name'] ?? ''));
        $product_price = sanitize_text_field(wp_unslash($_POST['product_price'] ?? ''));
        $product_price = str_replace(',', '.', $product_price);
        $product_price = floatval($product_price);

        if (empty($product_name)) {
            $message = __('Product name is required.', 'myside');
            $message_class = 'error';
        } elseif ($product_price <= 0) {
            $message = __('Product price must be a positive number.', 'myside');
            $message_class = 'error';
        } else {
            $inserted = $wpdb->insert(
                $table_name,
                array(
                    'name'       => $product_name,
                    'price'      => $product_price,
                    'created_at' => current_time('mysql', 1),
                ),
                array('%s', '%f', '%s')
            );

            if ($inserted) {
                $message = __('Product saved successfully.', 'myside');
                $message_class = 'success';
            } else {
                $message = __('Unable to save the product. Please try again.', 'myside');
                $message_class = 'error';
            }
        }
    }
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article class="page type-page status-publish">
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php if (!empty($message)) : ?>
                    <div class="myside-form-message <?php echo esc_attr($message_class); ?>">
                        <?php echo esc_html($message); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo esc_url(get_permalink()); ?>" class="myside-product-form">
                    <?php wp_nonce_field('myside_product_action', 'myside_product_nonce'); ?>

                    <p>
                        <label for="product_name"><?php _e('Product Name', 'myside'); ?></label><br>
                        <input type="text" id="product_name" name="product_name" value="<?php echo isset($_POST['product_name']) ? esc_attr(wp_unslash($_POST['product_name'])) : ''; ?>" required>
                    </p>

                    <p>
                        <label for="product_price"><?php _e('Product Price', 'myside'); ?></label><br>
                        <input type="text" id="product_price" name="product_price" placeholder="0.00" value="<?php echo isset($_POST['product_price']) ? esc_attr(wp_unslash($_POST['product_price'])) : ''; ?>" required>
                    </p>

                    <p>
                        <button type="submit" name="myside_product_submit"><?php _e('Save Product', 'myside'); ?></button>
                    </p>
                </form>
            </div>
        </article>
    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
