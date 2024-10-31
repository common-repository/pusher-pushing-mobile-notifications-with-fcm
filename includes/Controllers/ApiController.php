<?php
class pusherfcm_api_controller{

	function content_checker($url,$api){
		$response = wp_remote_get(
			esc_url_raw( $url.$api ),
			array(
				'headers' => array(
					'referer' => $this->get_my_url(),
				)
			)
		);
		return json_decode($response['body']);
	}

	//Base URL
	function baseUrl(){
		return 'https://pluginpress.net/api/member/';
	}

	//GET site URL
	function get_my_url(){
		$result = home_url();
		$url = "xxx.xx";
		if($result!=""){
			$url = $result;
			$url = str_replace('https://',"",$url);
			$url = str_replace('http://',"",$url);
			$url = str_replace('www.',"",$url);
			$url = explode("/",$url);
			$url = $url[0];
		}
		return $url;
	}

	//get Extention list
	function getExList(){
		return [
			'pusherPost'
		];
	}

	function exCheck($api){
		global $wpdb;
		$result = false;
		$wpdb->query('DELETE FROM '.$wpdb->prefix.'options WHERE option_name LIKE "pusherfcm-ex%"');

		$ex = $this->content_checker($this->baseUrl(),$api);
		if(isset($ex->secret)){
				$result = true;
				$wpdb->insert($wpdb->prefix.'options',[
					'option_name' => 'pusherfcm-ex-secret',
					'option_value' => $ex->secret
				]);
				$wpdb->insert($wpdb->prefix.'options',[
					'option_name' => 'pusherfcm-ex-api',
					'option_value' => $api
				]);
				$exs = $this->getExList();
				foreach ($exs as $e){
					if(isset($ex->$e)) {
						$wpdb->insert($wpdb->prefix.'options',[
							'option_name' => 'pusherfcm-ex-'.$e,
							'option_value' => $ex->$e
						]);
					}
				}
		}
		return $result;
	}

	function decrypt($data, $key, $method='AES-256-CBC')
	{
		$data = base64_decode($data);
		$ivSize = openssl_cipher_iv_length($method);
		$iv = substr($data, 0, $ivSize);
		$data = openssl_decrypt(substr($data, $ivSize), $method, $key, OPENSSL_RAW_DATA, $iv);

		return $data;
	}

}