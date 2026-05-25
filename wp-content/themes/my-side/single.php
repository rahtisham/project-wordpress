<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                        <span class="byline"> <?php _e('by', 'myside'); ?> <?php the_author_posts_link(); ?></span>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </div>

                <footer class="entry-footer">
                    <?php edit_post_link(__('Edit', 'myside'), '<span class="edit-link">', '</span>'); ?>
                </footer>
            </article>

            <?php if (comments_open() || get_comments_number()) : comments_template(); endif; ?>
        <?php endwhile; endif; ?>
    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
