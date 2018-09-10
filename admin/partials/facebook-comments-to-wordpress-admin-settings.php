<?php

/**
 * Provide a admin settings for the plugin
 *
 *
 * @link       maavuz.com
 * @since      1.0.0
 *
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/admin/partials
 */
?>
<div class="wrap">
	<h1>Facebook Comments to WordPress</h1>
	<form method="post" action="options.php"> 
		<?php
            // This prints out all hidden setting fields
            settings_fields( 'fb_comment_import_settings' );
            do_settings_sections( 'fb-comments-to-wp-settings' );
            submit_button();
        ?>
	</form>
</div>