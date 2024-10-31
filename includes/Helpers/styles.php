<?php
function pusherfcm_admin_styles(){

	wp_enqueue_style(
		'pusherdcm-admin-css',
		PUSHERFCM_URL.'includes/css/admin-style.css?v='.PUSHERFCM_VS,
		array(),
		time()
	);
	wp_enqueue_style(
		'imdb-admin-awesome-css',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
		array(),
		time()
	);
}