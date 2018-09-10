<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       maavuz.com
 * @since      1.0.0
 *
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/admin/partials
 */
$fb_access_token = $this->options['fb_access_token'];
$frontpage_id = get_option( 'page_on_front' );
?>
<div class="wrap">
	<h1>Facebook Comments to WordPress</h1>
	<?php 
	if($fb_access_token){
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">Import comments for</th>
					<td>
						<select id="import_type">
							<?php if($frontpage_id != 0){ ?>
							<option value="home">Homepage</option>
							<?php } ?>
							<option value="post">All Posts</option>
							<option value="page">All Pages</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p>
			<input type="hidden" id="fb_access_token" value="<?php echo $fb_access_token; ?>">
			<a href="javascript:;" id="start_import_comments" class="button button-primary">Start Importing Facebook</a>
		</p>
		<p id="results"></p>
		<?php

	}else{
		?>
		<p>Access token is missing form settings, please go to settings and enter your facebook app's access token. then comeback to this page.</p>
		<?php
	}
	?>
</div>