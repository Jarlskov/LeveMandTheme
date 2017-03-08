<?php
/**
 * The default template for displaying brewery content.
 *
 * @package Levemand
 */

$cfs = CFS();

$fields = array(
    'homepage'      => [
        'label' => 'Hjemmeside',
        'attrs' => '',
    ],
    'facebook_page' => [
        'label' => 'Facebook',
        'attrs' => '',
    ],
    'untappd_page'  => [
        'label' =>  'Untappd',
        'attrs' => '',
    ],
);

$has_header_content = false;
foreach ($fields as $field => $name) {
    $has_header_content = $has_header_content || $cfs->get($field);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

    <div class="entry-inner" itemscope itemtype="http://schema.org/Brewery">
        <meta itemprop="name" content="<?= $cfs->get('brewery_name');?>">
        <meta itemprop="url" content="<?= $cfs->get('homepage')['url'];?>">
        <?php if (has_post_thumbnail()):?>
            <meta itemprop="logo" content="<?= wp_get_attachment_image_src(get_post_thumbnail_id())[0];?>">
        <?php endif;?>
        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
            <header class="entry-header">
        
                <?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
            
                <?php
                    the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' );
                ?>
            
            </header><!-- .entry-header -->
            
            <div class="entry-content">
                <?php if ($has_header_content): ?>
                    <p>
                        <?php foreach ($fields as $field => $data): ?>
                            <?php $url = $cfs->get($field);?>
                            <?php if (!empty($url['url'])):?>
                                <b><?= $data['label'];?>:</b> <a href="<?= $url['url'] ?>" target="<?= $url['target'];?>"><?= $url['text'];?></a><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>

                <div itemsprop="reviewBody" itemtype="Text">
                    <?php if (has_post_thumbnail()) :?>
                        <a href="<?php the_permalink();?>">
                            <figure class="wp-caption alignright" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                <?php the_post_thumbnail('medium', ['itemprop' => 'contentUrl']);?>
                                <figcaption class="wp-caption-text" itemprop="caption"><?= get_post(get_post_thumbnail_id())->post_excerpt;?></figcaption>
                            </figure>
                        </a>
                    <?php endif;?>
                    <?php
                        /* translators: %s: Name of current post */
                        the_content( sprintf(
                            __( 'Read more %s', 'toivo-lite' ),
                            the_title( '<span class="screen-reader-text">', '</span>', false )
                        ) );
                    ?>
                </div>
                <?php
                    get_template_part('post-entry', get_post_type());

                    if (function_exists('synved_social_share_markup')) echo synved_social_share_markup();
                    
                    wp_link_pages( array(
                        'before'    => '<div class="page-links">' . __( 'Pages:', 'toivo-lite' ),
                        'after'     => '</div>',
                        'pagelink'  => '<span class="screen-reader-text">' . __( 'Page', 'toivo-lite' ) . ' </span>%',
                        'separator' => '<span class="screen-reader-text">,</span> ',
                    ) );
                ?>
            </div><!-- .entry-content -->
        </div>

		<footer class="entry-footer">
			<?php toivo_lite_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'toivo-lite' ) ) ); ?>
			<?php toivo_lite_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'toivo-lite' ), 'before' => '<br />' ) ); ?>
            <hr />
            <?php
            if( function_exists( 'mc4wp_form' ) ) {
                mc4wp_form( 'mc4wp_form' );
            }
            ?>
		</footer><!-- .entry-footer -->
		
	</div><!-- .entry-inner -->
	
</article><!-- #post-## -->
