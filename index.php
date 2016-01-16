<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toivo Lite
 */

get_header(); ?>

<?php do_action( 'toivo_before_loop' ); // Action hook before loop. ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

    <?php
        /* Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
        <div class="entry-inner">
            <header class="entry-header">
                <?php 
                    get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template.
                    the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                ?>
            </header>
            <div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
                <?php if (has_post_thumbnail()) :?>
                    <a href="<?php the_permalink();?>">
                        <figure class="wp-caption alignright">
                            <?php the_post_thumbnail('medium');?>
                            <figcaption class="wp-caption-text"><?= get_post(get_post_thumbnail_id())->post_excerpt;?></figcaption>
                        </figure>
                    </a>
                <?php endif;?>
                <?= levemand_excerpt();?>
                <?= toivo_lite_excerpt_more();?>
            </div>
        </div>
    </article>
<?php endwhile; ?>
    
<?php
    the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'toivo-lite' ),
        'next_text'          => __( 'Next page', 'toivo-lite' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'toivo-lite' ) . ' </span>',
    ) );
?>

<?php do_action( 'toivo_after_loop' ); // Action hook after loop. ?>

<?php get_footer(); ?>
