<? php

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