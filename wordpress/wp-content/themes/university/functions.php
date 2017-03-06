<?php
function university_setup() {
	global $content_width;
if ( ! isset( $content_width ) ){
      $content_width = 960;
}
	load_theme_textdomain( 'university', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary',  __( 'Main Menu', 'university' ));
	
	add_theme_support( 'custom-background', array(
		'default-color' => '5bc1c3',
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('servicethumb', 300, 160, true);
	add_image_size('slidethumb', 100, 75, true);
	add_image_size('slideimage', 950, 460, true);
	add_image_size('blogthumb', 650, 300, true);
}
add_action( 'after_setup_theme', 'university_setup' );
function university_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

if (!is_admin()) {
if(is_front_page()){
wp_enqueue_script( 'university-slidemobile-script', get_template_directory_uri() . '/js/jquery.mobile.customized.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'university-jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'university-camera-script', get_template_directory_uri() . '/js/camera.js', array( 'jquery' ), '', true );
}
wp_enqueue_script( 'university-superfish-script', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'university-mobilemenu-script', get_template_directory_uri() . '/js/mobilemenu.js', array( 'jquery' ), '', true );
wp_enqueue_style('university-font-opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800', array(), '1', 'screen'); 
wp_enqueue_style('university-arvo-font', '//fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic', array(), '1', 'screen'); 
wp_enqueue_style('university-custom-style', get_template_directory_uri().'/custom.css', array(), '1', 'screen'); 
wp_enqueue_style( 'university-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
wp_enqueue_style( 'university-style', get_stylesheet_uri());
}
}
add_action( 'wp_enqueue_scripts', 'university_scripts_styles' );
function university_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'university' ),
		'id' => 'sidebar-1',
		'description' => __( 'Right sidebar visible in all pages, drag and drop widgets from the left', 'university' ),
		'before_widget' => '<div id="%1$s" class="widgets">',
      	'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'university_widgets_init' );
function university_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'university_page_menu_args' );

if ( ! function_exists( 'university_content_nav' ) ) :

function university_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>

<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
  <h3 class="assistive-text">
    <?php _e( 'Post navigation', 'university'); ?>
  </h3>
  <div class="nav-previous">
    <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'university') ); ?>
  </div>
  <div class="nav-next">
    <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'university') ); ?>
  </div>
</nav>
<!-- #<?php echo $html_id; ?> .navigation -->
<?php endif;
}
endif;

if ( ! function_exists( 'university_comment' ) ) :
function university_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'university'); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'university'), '<span class="edit-link">', '</span>' ); ?>
  </p>
  <?php
			break;
		default :
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <header class="comment-meta comment-author vcard">
      <?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'university') . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __( '%1$s at %2$s', 'university'), get_comment_date(), get_comment_time() )
					);
				?>
    </header>
    <!-- .comment-meta -->
    
    <?php if ( '0' == $comment->comment_approved ) : ?>
    <p class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'university'); ?>
    </p>
    <?php endif; ?>
    <section class="comment-content comment">
      <?php comment_text(); ?>
      <?php edit_comment_link( __( 'Edit', 'university'), '<p class="edit-link">', '</p>' ); ?>
    </section>
    <!-- .comment-content -->
    
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'university'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </article>
  <!-- #comment-## -->
  <?php
		break;
	endswitch; // end comment_type check
}
endif;
add_filter( 'wp_title', 'university_title', 10, 3 );
function university_title( $title, $sep, $seplocation )
{
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
        return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
        $title .= get_bloginfo( 'name' );
    else
        $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'university'), max( $paged, $page ) );
    return $title;
}
function university_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($pages))."'>&raquo;</a>";
         echo "</div>\n";
     }
}
function university_custom_meta () {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'university_meta',
			__( 'Custom Post Features', 'university'  ),
			'university_meta_callback',
			$screen, 'side', 'high'
		);
	}
}
add_action( 'add_meta_boxes', 'university_custom_meta' );
function university_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'university_nonce' );
    $university_stored_meta = get_post_meta( $post->ID );
    ?>
  <p> <span class="university-row-title"><?php _e( 'Check the box below to feature post in the front page slider', 'university' ); ?></span>
  <div class="university-row-content">
    <label for="_university-slider-checkbox">
      <input type="checkbox" name="_university-slider-checkbox" id="_university-slider-checkbox" value="yes" <?php if ( isset ( $university_stored_meta['_university-slider-checkbox'] ) ) checked( $university_stored_meta['_university-slider-checkbox'][0], 'yes' ); ?> />
    </label>
  </div>
  </p>
  <p> <span class="university-row-title"><?php _e( 'Check the box to feature post in featured posts section', 'university' ); ?> </span>
  <div class="university-row-content">
    <label for="_university-services-checkbox">
      <input type="checkbox" name="_university-services-checkbox" id="_university-services-checkbox" value="yes" <?php if ( isset ( $university_stored_meta['_university-services-checkbox'] ) ) checked( $university_stored_meta['_university-services-checkbox'][0], 'yes' ); ?> />
    </label>
  </div>
  </p>
  <?php
}
function university_meta_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'university_nonce' ] ) && wp_verify_nonce( $_POST[ 'university_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ '_university-slider-checkbox' ] ) ) {
    update_post_meta( $post_id, '_university-slider-checkbox', 'yes' );
} else {
    delete_post_meta( $post_id, '_university-slider-checkbox', '' );
}
	if( isset( $_POST[ '_university-services-checkbox' ] ) ) {
    update_post_meta( $post_id, '_university-services-checkbox', 'yes' );
} else {
    delete_post_meta( $post_id, '_university-services-checkbox', '' );
}
    // Checks for input and sanitizes/saves if needed
}
add_action( 'save_post', 'university_meta_save' );
function university_new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'university_new_excerpt_length'); 
function university_new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'university_new_excerpt_more');
add_post_type_support( 'page', 'excerpt');
require get_template_directory() . '/customizer.php';