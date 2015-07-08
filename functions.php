<? php 
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

// **unfinished**
/*
	if ( function_exists('add_post_type_support') )
	{
	    add_action('init', 'add_page_excerpts');
	    function add_page_excerpts()
	    {
	        add_post_type_support( 'page', 'excerpt' );
	    }
	}
*/
##Title Length
/*
	function titlelength($title){
		if(mb_strlen($title) > 20 && !(is_single()) && !(is_page())){
	    	$title = mb_substr($title,0,20) . "...";
		}
		return $title;
	}
	add_filter( 'the_title', 'titlelength' );
*/