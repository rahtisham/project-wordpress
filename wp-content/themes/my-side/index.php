<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                    <header class="entry-header">
                        <?php the_title('<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="entry-footer">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php _e('Continue reading', 'myside'); ?></a>
                    </footer>
                </article>
            <?php endwhile; ?>

            <?php the_posts_pagination(array(
                'prev_text' => __('Previous', 'myside'),
                'next_text' => __('Next', 'myside'),
            )); ?>
        <?php else : ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php _e('Nothing Found', 'myside'); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php _e('It seems we can’t find what you’re looking for. Perhaps searching can help.', 'myside'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
