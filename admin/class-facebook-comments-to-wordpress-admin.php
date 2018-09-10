<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       maavuz.com
 * @since      1.0.0
 *
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/admin
 * @author     Maavuz Saif <maavuzsaif@gmail.com>
 */
class Facebook_Comments_To_Wordpress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Facebook_Comments_To_Wordpress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Facebook_Comments_To_Wordpress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/facebook-comments-to-wordpress-admin.css', array(), $this->version, 'all' );

	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Facebook_Comments_To_Wordpress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Facebook_Comments_To_Wordpress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/facebook-comments-to-wordpress-admin.js', array( 'jquery' ), $this->version.'4', false );

	}

	/**
	 * Register the Settings Pages for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_pages() {
		add_menu_page( 'Facebook Comments to WordPress', 'FB Comments to WP', 'manage_options', 'fb-comments-to-wp', array( $this, 'admin_page' ) );
		add_submenu_page('fb-comments-to-wp', __( 'Settings', 'textdomain' ), __( 'Settings', 'textdomain' ), 'manage_options', 'fb-comments-to-wp-settings', array( $this, 'page_options' ));
	}


	/**
	 * Creates the admin page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function admin_page() {
		$this->options = get_option( 'fb_comment_import_setting' );
		include( plugin_dir_path( __FILE__ ) . 'partials/facebook-comments-to-wordpress-admin-display.php' );
	} 
	/**
	 * Creates the options page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function page_options() {
		$this->options = get_option( 'fb_comment_import_setting' );
		include( plugin_dir_path( __FILE__ ) . 'partials/facebook-comments-to-wordpress-admin-settings.php' );
	}

	/**
     * Register and add settings
     */
    public function register_setings()
    {        
        register_setting(
            'fb_comment_import_settings', // Option group
            'fb_comment_import_setting' // Option name
        );

        add_settings_section(
            'fb_comment_import_settings_main', // ID
            'Main Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'fb-comments-to-wp-settings' // Page
        );  

        add_settings_field(
            'fb_app_id', // ID
            'FB App ID', // Title 
            array( $this, 'fb_app_id_callback' ), // Callback
            'fb-comments-to-wp-settings', // Page
            'fb_comment_import_settings_main' // Section           
        );     

        add_settings_field(
            'fb_access_token', // ID
            'Access Token', // Title 
            array( $this, 'fb_access_token_callback' ), // Callback
            'fb-comments-to-wp-settings', // Page
            'fb_comment_import_settings_main' // Section           
        );  
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function fb_app_id_callback()
    {
        printf(
            '<input type="text" id="fb_app_id" name="fb_comment_import_setting[fb_app_id]" value="%s" />',
            isset( $this->options['fb_app_id'] ) ? esc_attr( $this->options['fb_app_id']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function fb_access_token_callback()
    {
        printf(
            '<input type="text" id="fb_access_token" name="fb_comment_import_setting[fb_access_token]" value="%s" />',
            isset( $this->options['fb_access_token'] ) ? esc_attr( $this->options['fb_access_token']) : ''
        );
    }


    public function insert_comment($comment_data, $post_id){

    	if($this->if_comment_already_exists($comment_data->id) == 0){
    		$return = '';
	    	$data = array(
	    		'comment_post_ID' => $post_id,
			    'comment_author' => $comment_data->from->name,
			    'comment_author_email' => $comment_data->from->id."@facebook.com",
			    'comment_author_url' => '',
			    'comment_content' => $comment_data->message,
			    'comment_type' => '',
			    'comment_parent' => 0,
			    'comment_date' => $comment_data->created_time,
			    'comment_approved' => 1,
			);
			if($comment_id = wp_insert_comment($data)){
				add_comment_meta( $comment_id, 'fb_comment_id', $comment_data->id );
				$return = "{$comment_id}: Imported {$comment_data->from->name}'s comment <br />";
			}else{
				$return = "Fail: Importing {$comment_data->from->name}'s comment <br />";
			}
		}else{
			$return = "Duplicate Comment detected.";
		}

		return $return;
    }

    public function if_comment_already_exists($meta_id){
    	global $wpdb;
    	$table_name = $wpdb->prefix . "commentmeta";
    	$count = $wpdb->get_var("SELECT count(*) from $table_name WHERE meta_key='fb_comment_id' AND meta_value='{$meta_id}'");
    	return $count;

    }

    public function get_post_data($what, $paged){
    	$return_arr = [];
    	if($what == 'home'){
    		$frontpage_id = get_option( 'page_on_front' );
    		$return_arr['url'] = get_permalink($frontpage_id);
    		$return_arr['post_id'] = $frontpage_id;
    	}else{
    		$posts = get_posts(['post_type' => $what, 'posts_per_page' => 1, 'paged' => $paged]);
    		if(!empty($posts)){
    			$return_arr['url'] = get_permalink($posts[0]);
    			$return_arr['post_id'] = $posts[0]->ID;
    		}
    	}
    	//print_r($return_arr);
    	return $return_arr;
    }

    public function fetch_data_from_api($token, $call_url, $is_paged, $url){
    	$query = http_build_query([
		 'id' => $url,
		 'fields' => 'og_object{comments}'
		]);
		$request_url = '';
		
		if($is_paged == 1){
			//echo $is_paged.' -----';
			$request_url = $call_url;
			//echo "second";
			//echo "-------- {$request_url} ----";
		}else{
			$request_url = "https://graph.facebook.com/v2.6/?access_token={$token}&{$query}";
		}
    	// echo $request_url;
    	// echo "------------------------------------";
		$data = file_get_contents($request_url);
		// if($is_paged == 1){
		echo $data;
		// }
		
		$json = json_decode($data);
		return $json;
		
    }

    public function import_comments(){
    	$token = $_POST['token'];
    	$paged = $_POST['paged'];
    	$what = $_POST['what'];
    	$cameback = $_POST['go_with'];
    	$return_arr = ['code' => 0];
    	$comback_with = [];
    	$post_data = '';
    	//print_r($_REQUEST);
    	$is_paged = 0;
    	if($cameback['call']){
    		//echo "string";
    		$post_data = $cameback;
    		$is_paged = 1;
    	}else{
    		$post_data = $this->get_post_data($what, $paged);
    	}
    	$json = $this->fetch_data_from_api($token, $post_data['call'], $is_paged, $post_data['url']);
    	$comments = [];
    	$next_page = '';
    	if($is_paged == 1){
    		$comments = $json->data;
			$next_page = $json->paging->next;
    	}else{
			$comments = $json->og_object->comments->data;
			$next_page = $json->og_object->comments->paging->next;
		}

		if($comments){
			if($next_page){
				$comback_with = ['url' => $post_data['url'], 'post_id' => $post_data['post_id'], 'call' => $next_page ];
				$return_arr['comback_with'] = $comback_with;
				$return_arr['code'] = 1;
			}else{
				$return_arr['code'] = 2;
			}
			foreach ($comments as $comment) {
				$message = $this->insert_comment($comment, $post_data['post_id']);
				//echo $message;
				$return_arr['message'][] = $message;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		die();
    }

}
