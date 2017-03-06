<?php get_header(); ?>

<div id="contentwrapper">
  <div id="content">
    <h2 class="page-title">
      <?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'university' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'university' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'university' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'university' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'university' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'university' ) ) . '</span>' );

						else :
							_e( 'Archives', 'university' );

						endif;
					?>
    </h2>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="post">
      <div class="postdate">
       <?php get_the_date(); ?>
      </div>
      <h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></h2>
      <?php the_post_thumbnail('blogthumb'); ?>
      <div class="entry">
        <?php the_excerpt(); ?>
      </div>
      <div class="belowpost"><a class="more-link" href="<?php the_permalink(); ?>" >Read More</a></div>
    </div>
    <?php endwhile; ?>
    <?php if (function_exists("university_pagination")) { university_pagination($post->max_num_pages); } ?>
    <?php else : ?>
    <h2 class="center">
      <?php _e( 'Not Found', 'university' ); ?>
    </h2>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
