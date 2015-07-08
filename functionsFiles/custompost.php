<? php
/*
**unfinished**
Sample : Service
* service-single.php
* archive-service.php

    'label' => 'Sservice',
    'public' => true, //管理画面に表示
    'hierarchical' => true, //親カテゴリーの有無
    'show_ui' => true, //管理画面に表示
    'supports' => array(　//投稿時に表示する項目
*/

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