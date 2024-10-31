<?php
function pusherfcm_admin_menu(){
	add_menu_page(
		__( 'Pusher', 'pusherfcm' ),
		__( 'Pusher', 'pusherfcm' ),
		'manage_options',
		'pusherfcm',
		'pusherfcm_admin_dashboard',
		plugins_url( '../assets/smi.png',__FILE__),
		999
	);
}
