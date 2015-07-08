<? php

	function urlHome(){
	    return get_bloginfo('url');
	}
	add_shortcode('url','urlHome');

	function urlContactUs(){
	    return '<a href="http://domain.jp/contactus/">/contactus/>お問い合せはこちら</a>';
	}
	add_shortcode('contact','urlContactUs');