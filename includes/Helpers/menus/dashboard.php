<?php
function pusherfcm_admin_dashboard(){

	if (!current_user_can('manage_options')) {
		return;
	}
	$fcm = new pusherfcm_fcm_controller();
	$api = new pusherfcm_api_controller();
	$check_img ="";
	$msg = "";
	$style = "";
	$button_value = "Check";
	$postEx = PUSHERFCM_URL.'includes/assets/postoff.png';
	$apikeyvalue = "";
	if(get_option('pusherfcm-ex-api')!=false){
		$check_img = '<img src="' . PUSHERFCM_URL . 'includes/assets/check.png" style="float:left;"/>&nbsp;';
		$style = 'style="border-color:#3a9551;color: #3a9551"';
		$button_value = "Update";
		$apikeyvalue = get_option('pusherfcm-ex-api');
		//EXTENTIONS
		if(get_option('pusherfcm-ex-pusherPost')!=false){
			$postEx = PUSHERFCM_URL.'includes/assets/post.png';
		}
    }

    //EXTENTIONS END
    if(isset($_POST['pusher-api'])){
        $apikey = trim($_POST['pusher-api']);
	    $apikeyvalue = $apikey;
        $result = $api->exCheck($apikey);
        if($result){
            $check_img = '<img src="' . PUSHERFCM_URL . 'includes/assets/check.png" style="float:left;"/>&nbsp;';
	    	$style = 'style="border-color:#3a9551;color: #3a9551"';
	    	$button_value = "Update";
	        if(get_option('pusherfcm-ex-pusherPost')!=false){
		        $postEx = PUSHERFCM_URL.'includes/assets/post.png';
	        }

        }else{
	        $style = 'style="border-color:red;color: red"';
	        $button_value = "Check";
	        $msg = "<br><small style='color: red'>Api-Key is not valid or you cannot use it on this domain...<br>Did you add your web address on pluginpress.net?</small>";
	        $check_img = '<img src="' . PUSHERFCM_URL . 'includes/assets/error.png" style="float:left;"/>&nbsp;';
	        //EXTENTIONS
	        $postEx = PUSHERFCM_URL.'includes/assets/postoff.png';
        }
    }

	if(isset($_POST['save_push'])){
	    $fcm->saveSettings($_POST);
    }
	$data = $fcm->getSettings();
	?>
	<h1><?php esc_html_e('Pusher - Pushing mobile notifications with FCM'); ?></h1>
	<div class="pusher-container">
        <main>
            <input id="tab1" type="radio" name="tabs" class="none-imdb" checked>
            <label for="tab1">Dashboard</label>
            <input id="tab2" type="radio" name="tabs" class="none-imdb">
            <label for="tab2">News</label>
            <input id="tab3" type="radio" name="tabs" class="none-imdb">
            <label for="tab3">Changelog</label>
            <input id="tab4" type="radio" name="tabs" class="none-imdb">
            <label for="tab4">Documentation</label>
            <section id="content1">
                <h2 style="">API-KEY</h2>
                <form action="admin.php?page=pusherfcm" method="post">
                    <label>
				        <?php if (get_option('pusherfcm-ex-secret') == false): ?>
                            <h3 style="">Register on <a href="https://pluginpress.net" target="_blank">PluginPress</a>
                                and get your key</h3>
				        <?php endif; ?>
			        	<?php echo $check_img ?>
                        <input type="text" placeholder="Enter your API-Key here" value="<?php echo $apikeyvalue ?>"
                               name="pusher-api" class="regular-text" <?php echo $style; ?>>
                        <input type="submit" value="<?php echo $button_value ?>"
                           class="button" <?php echo $style; ?>>
				        <?php echo $msg; ?>
                        </label>
                </form>
                <br/>
                <br/>
                <small><b>Note: Try running the basic notification message. If your settings are correct, you can purchase premium extensions.</b></small>
                <br>
                <a href="https://pluginpress.net/product/pusher-post-notification" target="_blank"><img src="<?php echo $postEx?>"></a>
                <hr/>
                <h2 style="">FIREBASE SETTINGS</h2>
		        <form action="<?php echo admin_url('admin.php?page=pusherfcm')?>" method="post">
			        <table class="form-table">
				        <tbody>
				            <tr>
                                <th><label>Firebase Server Key</label></th>
					            <td>
						            <input type="text" style="width: 100%" name="fcm_key" value="<?php echo $data['key']?>">
					            </td>
				            </tr>
				            <tr>
					            <th><label>Firebase Sender ID</label></th>
					            <td>
						            <input type="text" class="regular-text" name="fcm_id" value="<?php echo $data['id']?>">
					            </td>
				            </tr>
                            <tr>
                                <th><label>Topic</label></th>
                                <td>
                                    <input type="text" class="regular-text" name="fcm_topic" value="<?php echo ($data['topic'] !="" ? $data['topic'] : "all")?>">
                                </td>
                            </tr>
                            <tr>
                                <th><label>Basic Post Notification Message</label></th>
                                <td>
                                    <input type="text" style="width: 100%" name="fcm_msg" value="<?php echo ($data['msg'] !="" ? $data['msg'] : "New post has been added.")?>">
                                </td>
                            </tr>
                            <tr>
                                <th><label>Post Notifications</label></th>
                                <td>
                                    <select name="fcm_state">
                                        <option value="opened" <?php echo ($data['state'] == "opened" ? "selected" : "")?>>Opened</option>
                                        <option value="closed" <?php echo ($data['state'] == "closed" ? "selected" : "")?>>Closed</option>
                                    </select>
                                </td>
                            </tr>
				        </tbody>
			        </table>
                    <input class="button" value="Save" type="submit" name="save_push">
		        </form>
        </section>
            <section id="content2">...</section>
            <section id="content3">...</section>
            <section id="content4">
                <h2>How to find Server Key and Sender ID</h2>
                <p>You must already have a Google Firebase account to use this plugin. Your mobile application must also use the Firebase Cloud Messaging system.</p>

                <p>First of all, when you open your console, you need to go to the Project Settings page.<br/><img src="<?php echo PUSHERFCM_URL.'includes/assets/doc1.jpg'?>" style="width: 600px"></p>
                <br/>
                <p>You can find your Server key and Sender ID when you click on the Cloud Messaging link on the following page<br><img src="<?php echo PUSHERFCM_URL.'includes/assets/doc2.jpg'?>"></p>

                <h2>How to push notification to mobile app</h2>
                <p>You can send a notification to all users who have subscribed to the topic you set from within your application.</p>
                <p><a href="https://firebase.google.com/docs/cloud-messaging/ios/topic-messaging" target="_blank">Send messages to topics on iOS</a></p>
                <p><a href="https://firebase.google.com/docs/cloud-messaging/android/topic-messaging" target="_blank">Topic messaging on Android</a></p>


            </section>
        </main>
	</div>


	<?php
    pushercm_side_menu();
}

