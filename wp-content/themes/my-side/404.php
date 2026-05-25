<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('Oops! That page can’t be found.', 'myside'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'myside'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
