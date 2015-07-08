**Chack WordPress Version**

<a style="float:right;margin: 0 6rem 0 0;" href="#functionsphp">
	<p style="position:fixed;top:3.8rem;right:2rem;font-weight:bold;">↑Contnts</p>
</a>

#functions.php
- [width of contents](#width-of-contents)
- [editor-style.css](#editor-stylecss)
- [Remove tags : Posting](#remove-tags-postting)
- [Thumbnails](#thumbnails)
- [Add other img size](#add-other-img-size)
- [Change messeage in adminstation](#change-messeage-in-adminstation)
- [Excerpt](#Excerpt)
- [Title Length](#title-length)

#include
- [ReadingFiles](#readingfiles)
- [custompost.php](#custompostphp)
- [widget.php](#widgetphp)
- [shortCode.php](#shortcodephp)
- [comment.php](#commentphp)

---

##width of contents
functions.php

    if ( ! isset( $content_width ) )
    $content_width = 640;
    
css

    .size-auto, 
	.size-full,
	.size-large,
	.size-medium,
	.size-thumbnail {
		max-width: 100%;
		height: auto;
	}

##editor-style.css

    add_editor_style('editor-style.css');

    // Directory：Theme/editor-style.css

##Remove tags : Postting
// &lt;p&gt;&lt;img...&gt;&lt;/p&gt;

    function filter_ptags_on_images($content){
    	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    	}
    add_filter('the_content', 'filter_ptags_on_images');


// &lt;p&gt; and &lt;br&gt;

    // remove_filter('the_content', 'wpautop');

##Thumbnails
    
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 72, 72 );

##Add other img size

    add_image_size( 'm-img', 200, 9999, false );
    add_image_size( 'l-img', 420, 9999, false );

##Change messeage in adminstation

	function remove_footer_admin () {
		echo 'お問い合わせ : <a href="http://domain.com" target="_blank">xxxxx</a>';
	}

##Excerpt

	add_post_type_support( 'page', 'excerpt' );

	//Change letters after excerpt.
	function new_excerpt_more($more) {
		return ' ... <a class="moreread" href="' . get_permalink() . '">more</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	//Limit to letters.
	function new_excerpt_mblength($length) {
	     return 78;
	}
	add_filter('excerpt_mblength', 'new_excerpt_mblength');

**unfinished**

	if ( function_exists('add_post_type_support') )
	{
	    add_action('init', 'add_page_excerpts');
	    function add_page_excerpts()
	    {
	        add_post_type_support( 'page', 'excerpt' );
	    }
	}

##Title Length

	function titlelength($title){
		if(mb_strlen($title) > 20 && !(is_single()) && !(is_page())){
	    	$title = mb_substr($title,0,20) . "...";
		}
		return $title;
	}
	add_filter( 'the_title', 'titlelength' );


---

#include
##ReadingFiles 
`locate_template('functionsFiles/"functions".php', true);`

##custompost.php
**unfinished**
Sample : Service
* service-single.php
* archive-service.php

    'label' => 'Sservice',
    'public' => true, //管理画面に表示
    'hierarchical' => true, //親カテゴリーの有無
    'show_ui' => true, //管理画面に表示
    'supports' => array(　//投稿時に表示する項目

Code

    function new_post_type() {
	    register_post_type('service',
			array(
				'label' => 'Service',
				'public' => true,
				'hierarchical' => true,
				'has_archive' => true,
				'capability_type' => 'page',
				'menu_position' => 5,
				'supports' => array(
					'title','editor','author','thumbnail','revisions',
					'excerpt','comments','custom-fields','page-attributes',
				)
			)
		);
	    register_post_type('service2',
			array(
				'label' => 'Service2',
				'public' => true,
				'hierarchical' => true,
				'has_archive' => true,
				'capability_type' => 'page',
				'menu_position' => 6,
				'supports' => array(
					'title','editor','author','thumbnail','revisions',
					'excerpt','page-attributes',
				)
			)
		);

		// Custom taxonomy by Service
		register_taxonomy('SERVICE','service',
			array(
				'label' => 'SERVICE Cate',
				'public' => true,
				'show_ui' => true,
				'hierarchical' => true,
				'has_archive' => true,
				'rewrite' => true,

			)		
		);

		// catagory Custom
		register_taxonomy('service-cat','service',
			array(
				'label' => 'Category',
				'public' => true,
				'show_ui' => true,
				'hierarchical' => true,
				'has_archive' => true,
				'rewrite' => array (
					'hierarchical' => true
				),
			)
		);
		// tag Custom
		register_taxonomy('service-tag', 'service',
			array(
				'label' => 'Tag',
				'public' => true,
				'show_ui' => true,
				'hierarchical' => false, //tag
			)
		);
	}
    add_action( 'init', 'new_post_type' );


##widget.php
**unfinished**

    if ( function_exists('register_sidebar') )
	{
	register_sidebar( array(
	     'name' => 'フッターエリア',
	     'id' => 'footer',
	     'description' => 'フッターエリアのウィジェット'
	)); 
	}


##shortcode.php

	function urlHome(){
	    return get_bloginfo('url');
	}
	add_shortcode('url','urlHome');

	function urlContactUs(){
	    return '<a href="http://domain.jp/contactus/">/contactus/>お問い合せはこちら</a>';
	}
	add_shortcode('contact','urlContactUs');


##show article in archive

	function my_post_queries( $query ) {
	    if ( is_admin() || ! $query->is_main_query() )
	        return;
	 	 
	    if ( is_home() ) {
	        $query->set('posts_per_page', 3);
	        return;
	    }
	 
	    if ( is_category() ) {
	        $query->set('posts_per_page', 5);
	        return;
	    }
	}
	add_action( 'pre_get_posts', 'my_post_queries' );

##comment.php
Customize by css

	if ( ! function_exists( 'dwp_comment' ) ) :

	function dwp_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
	    
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'dwp' ); ?>
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'dwp' ), '<span class="edit-link">', '</span>' ); ?></p>

			<?php break; default :	?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	   		<aside id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php echo 'このコメントは承認待ちです。'; ?></em>
					<br />
				<?php endif; ?>
	            
	            <p class="mb10"><?php echo get_comment_date(); ?></p>

			<aside id="comment_text"><?php comment_text(); ?></aside>

			<div class="reply">
	    		<?php comment_reply_link( array_merge( $args, array(
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
			</div><!-- .reply -->
			</aside><!-- #comment-##  -->

		<?php
			break;
			endswitch;
	}
	endif;

