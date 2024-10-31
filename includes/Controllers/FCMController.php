<?php
class pusherfcm_fcm_controller{

	function sendMsg($sender,$key,$title,$body, $topic,$image=""){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $sender,'status'=>"done",'screen'=>'main');
		$notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
		if($image !=""){
			$notification['image'] = $image;
		}
		$arrayToSend = array('to' => "/topics/".$topic, 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
		$fields = json_encode ($arrayToSend);
		$headers = array (
			'Authorization' => 'key=' . $key,
			'Content-Type' => 'application/json'
		);

		$args = array(
			'body'        => $fields,
			'headers'     => $headers,
		);
		wp_remote_post( 'https://fcm.googleapis.com/fcm/send', $args );
	}

	function saveSettings($post){
		if(get_option('pusherfcm-settings-state') == false) {
			add_option( 'pusherfcm-settings-key', $post['fcm_key'], '', 'yes' );
			add_option( 'pusherfcm-settings-id', $post['fcm_id'], '', 'yes' );
			add_option( 'pusherfcm-settings-topic', $post['fcm_topic'], '', 'yes' );
			add_option( 'pusherfcm-settings-msg', $post['fcm_msg'], '', 'yes' );
			add_option( 'pusherfcm-settings-state', $post['fcm_state'], '', 'yes' );
		}else{
			update_option( 'pusherfcm-settings-key', $post['fcm_key'],  'yes' );
			update_option( 'pusherfcm-settings-id', $post['fcm_id'],  'yes' );
			update_option( 'pusherfcm-settings-topic', $post['fcm_topic'],  'yes' );
			update_option( 'pusherfcm-settings-msg', $post['fcm_msg'], 'yes' );
			update_option( 'pusherfcm-settings-state', $post['fcm_state'], 'yes' );
		}
	}

	function getSettings(){

		$data= array();
		$data['key'] = get_option('pusherfcm-settings-key') == false ? "" : get_option('pusherfcm-settings-key');
		$data['id'] = get_option('pusherfcm-settings-id') == false ? "" : get_option('pusherfcm-settings-id');
		$data['topic'] = get_option('pusherfcm-settings-topic') == false ? "" : get_option('pusherfcm-settings-topic');
		$data['msg'] = get_option('pusherfcm-settings-msg') == false ? "" : get_option('pusherfcm-settings-msg');
		$data['state'] = get_option('pusherfcm-settings-state') == false ? "" : get_option('pusherfcm-settings-state');

		return $data;
	}

}