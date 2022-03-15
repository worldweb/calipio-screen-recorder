<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Calipio Screen Recorder
 * @since 1.0.0
 */

if( !class_exists( 'Wp_Calipio_Admin' ) ) {
	
	class Wp_Calipio_Admin {

		//class constructor
		function __construct() {
		}

		public function wp_calipio_add_meta_box() {

			add_meta_box( 'wp_calipio_meta', __('Calipio Settings','wpcalipio').'<a target="_blank" class="wp-calipio-link" href="https://calipio.com/knowledge-base/">'.__('Help','wpcalipio').'</a>', array( $this, 'wp_calipio_meta_settings_render' ), WP_CALIPIO_POST_TYPE, 'advanced', 'high' );
			add_meta_box( 'wp_calipio_shortcode_meta', __('Calipio Shortcode','wpcalipio'), array( $this, 'wp_calipio_shortcode_render' ), WP_CALIPIO_POST_TYPE, 'side', 'high' );
		}

		public function wp_calipio_meta_settings_render(){

			global $post;
			$post_id = $post->ID;
			
			$_wp_calipio_token 		= get_post_meta($post_id, '_wp_calipio_token',true);
			$_wp_calipio_screen 	= get_post_meta($post_id, '_wp_calipio_screen',true);
			$_wp_calipio_camera 	= get_post_meta($post_id, '_wp_calipio_camera',true);
			$_wp_calipio_microphone 	= get_post_meta($post_id, '_wp_calipio_microphone',true);
			$_wp_calipio_startmode 	= get_post_meta($post_id, '_wp_calipio_startmode',true);
			$_wp_calipio_endmode 	= get_post_meta($post_id, '_wp_calipio_endmode',true);
			$_wp_calipio_hidepopup 	= get_post_meta($post_id, '_wp_calipio_hidepopup',true);
			$_wp_calipio_pre_select_screen  = get_post_meta($post_id, '_wp_calipio_pre_select_screen',true);
			$_wp_calipio_pre_select_camera  = get_post_meta($post_id, '_wp_calipio_pre_select_camera',true);
			$_wp_calipio_pre_select_mic 	  = get_post_meta($post_id, '_wp_calipio_pre_select_mic',true);
			
			if(empty($_wp_calipio_hidepopup)){
				$_wp_calipio_hidepopup = array();
			}
			
			$_wp_calipio_customcode 	= get_post_meta($post_id, '_wp_calipio_customcode',true);
			?>
			<div class="wp-calipio-meta-wrap">
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Token','wpcalipio') ?></label>
					<div class="wp-calipio-help-wrap">
						<input type="text" class="wp-calipio-txt" name="_wp_calipio_token" value="<?php echo esc_attr($_wp_calipio_token); ?>">
						<div class="wp-calipio-help">
							<i class="dashicons dashicons-editor-help"></i>
							<div style="display:none;"><?php _e('Sets the recorder token to be used. Controls which library and folder the recording will be saved into. If no token is specified, the recordings are created as short-term anonymous recordings.','wpcalipio') ?></div>
						</div>
					</div>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Screen','wpcalipio') ?></label>
					<select class="wp-calipio-select" name="_wp_calipio_screen" data-selected="<?php echo esc_attr($_wp_calipio_screen); ?>">
						<option <?php echo $_wp_calipio_screen == "allowed" ? ' selected="selected" data-selected="allowed" ' : ''  ?> value="allowed"><?php _e('Allowed','wpcalipio'); ?></option>
						<option <?php echo $_wp_calipio_screen == "not-allowed" ? ' selected="selected" data-selected="not-allowed" ' : ''  ?> value="not-allowed"><?php _e('Not Allowed','wpcalipio'); ?></option>
						<option <?php echo $_wp_calipio_screen == "mandatory" ? ' selected="selected" data-selected="mandatory"' : ''  ?> value="mandatory"><?php _e('Mandatory','wpcalipio'); ?></option>
					</select>
					<label style="<?php echo !empty($_wp_calipio_screen) && $_wp_calipio_screen != "allowed"  ? 'display:none' :''; ?>" class="wp-calipio-pre-select-wrap"><input type="checkbox" name="_wp_calipio_pre_select_screen" value="1" <?php echo !empty($_wp_calipio_pre_select_screen) || empty($_wp_calipio_screen)? ' checked="checked" ' : ''  ?>> <?php _e('Preselected','wpcalipio'); ?></label>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Camera','wpcalipio') ?></label>
					<select class="wp-calipio-select" name="_wp_calipio_camera" data-selected="<?php echo esc_attr($_wp_calipio_camera); ?>">
						<option <?php echo $_wp_calipio_camera == "allowed" ? ' selected="selected" ' : ''  ?> value="allowed"><?php _e('Allowed','wpcalipio'); ?></option>	
						<option <?php echo $_wp_calipio_camera == "not-allowed" ? ' selected="selected" ' : ''  ?> value="not-allowed"><?php _e('Not Allowed','wpcalipio'); ?></option>
						<option <?php echo $_wp_calipio_camera == "mandatory" ? ' selected="selected" ' : ''  ?> value="mandatory"><?php _e('Mandatory','wpcalipio'); ?></option>
					</select>
					<label style="<?php echo !empty($_wp_calipio_camera) && $_wp_calipio_camera != "allowed"  ? 'display:none' :''; ?>" class="wp-calipio-pre-select-wrap"><input type="checkbox" name="_wp_calipio_pre_select_camera" value="1" <?php echo !empty($_wp_calipio_pre_select_camera) ? ' checked="checked" ' : ''  ?>> <?php _e('Preselected','wpcalipio'); ?></label>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Microphone','wpcalipio') ?></label>
					<select class="wp-calipio-select" name="_wp_calipio_microphone" data-selected="<?php echo esc_attr($_wp_calipio_microphone); ?>">
						<option <?php echo $_wp_calipio_microphone == "allowed" ? ' selected="selected" ' : ''  ?> value="allowed"><?php _e('Allowed','wpcalipio'); ?></option>	
						<option <?php echo $_wp_calipio_microphone == "not-allowed" ? ' selected="selected" ' : ''  ?> value="not-allowed"><?php _e('Not Allowed','wpcalipio'); ?></option>
						<option <?php echo $_wp_calipio_microphone == "mandatory" ? ' selected="selected" ' : ''  ?> value="mandatory"><?php _e('Mandatory','wpcalipio'); ?></option>
					</select>
					<label style="<?php echo !empty($_wp_calipio_microphone) && $_wp_calipio_microphone != "allowed" ? 'display:none' :''; ?>" class="wp-calipio-pre-select-wrap"><input type="checkbox" name="_wp_calipio_pre_select_mic" value="1" <?php echo !empty($_wp_calipio_pre_select_mic) ? ' checked="checked" ' : ''  ?>> <?php _e('Preselected','wpcalipio'); ?></label>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Start Mode','wpcalipio') ?></label>
					<div class="wp-calipio-help-wrap">
						<select class="wp-calipio-select" name="_wp_calipio_startmode">
							<option <?php echo $_wp_calipio_startmode == "setup" ? ' selected="selected" ' : ''  ?> value="setup"><?php _e('Setup','wpcalipio'); ?></option>
							<option <?php echo $_wp_calipio_startmode == "immediate" ? ' selected="selected" ' : ''  ?> value="immediate"><?php _e('Immediate','wpcalipio'); ?></option>
						</select>
						<div class="wp-calipio-help">
							<i class="dashicons dashicons-editor-help"></i>
							<div style="display:none;"><?php _e('Controls whether recording is set-up by the user before starting or is starting immediately.','wpcalipio') ?></div>
						</div>
					</div>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('End Mode','wpcalipio') ?></label>
					<div class="wp-calipio-help-wrap">
						<select class="wp-calipio-select" name="_wp_calipio_endmode">
							<option <?php echo $_wp_calipio_endmode == "review" ? ' selected="selected" ' : ''  ?> value="review"><?php _e('Review','wpcalipio'); ?></option>
							<option <?php echo $_wp_calipio_endmode == "immediate" ? ' selected="selected" ' : ''  ?> value="immediate"><?php _e('Immediate','wpcalipio'); ?></option>
						</select>
						<div class="wp-calipio-help">
							<i class="dashicons dashicons-editor-help"></i>
							<div style="display:none;"><?php _e('Controls if the user may review and discard the recording after finishing it.','wpcalipio') ?></div>
						</div>
					</div>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Hide Popup','wpcalipio') ?></label>
					<div class="wp-calipio-checkbox-wrap wp-calipio-help-wrap">
						<label><input type="checkbox" <?php echo in_array('during-setup', $_wp_calipio_hidepopup) ? ' checked="checked" ' : ''  ?> class="wp-calipio-checkbox" name="_wp_calipio_hidepopup[]" value="during-setup"> <?php _e('During Setup','wpcalipio') ?></label>
						<label><input type="checkbox" <?php echo in_array('during-recording', $_wp_calipio_hidepopup) ? ' checked="checked" ' : ''  ?> class="wp-calipio-checkbox" name="_wp_calipio_hidepopup[]" value="during-recording"> <?php _e('During Recording','wpcalipio') ?></label>
						<label><input type="checkbox" <?php echo in_array('after-recording', $_wp_calipio_hidepopup) ? ' checked="checked" ' : ''  ?> class="wp-calipio-checkbox" name="_wp_calipio_hidepopup[]" value="after-recording"> <?php _e('After Recording','wpcalipio') ?></label>
						<div class="wp-calipio-help">
							<i class="dashicons dashicons-editor-help"></i>
							<div style="display:none;"><?php _e('Select the states in which the recorder popup should not be shown.','wpcalipio') ?></div>
						</div>
					</div>
				</div>
				<div class="wp-calipio-meta">
					<label class="wp-calipio-label"><?php _e('Custom Code','wpcalipio') ?></label>
					<div class="wp-calipio-help-wrap">
						<textarea rows="6" class="wp-calipio-textarea" name="_wp_calipio_customcode"><?php echo esc_attr($_wp_calipio_customcode); ?></textarea>
						<div class="wp-calipio-help">
							<i class="dashicons dashicons-editor-help"></i>
							<div style="display:none;"><?php _e('This code will be executed when a recording has finished successfully and, depending on the end mode setting, the user has accepted the recording. The event detail contains additional information.','wpcalipio') ?> <a target="_blank" href="https://calipio.com/sdk-docs/recorder-sdk/reference/#recordingended-event">https://calipio.com/sdk-docs/recorder-sdk/reference/#recordingended-event</a></div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		public function wp_calipio_save_meta_box( $post_id ) {

			global $post_type;
			
			$post_type_object = get_post_type_object( $post_type );
			$pages = array( WP_CALIPIO_POST_TYPE);

			if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) // Check Autosave
			|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] ) // Check Revision
			|| ( ! in_array( $post_type, $pages ) )  // Check if current post type is supported.
			|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) ) // Check permission
			{
			  return $post_id;
			}

			if( isset( $_POST['_wp_calipio_token'] ) ) {
				$_wp_calipio_token = sanitize_text_field($_POST['_wp_calipio_token']);
				update_post_meta( $post_id, '_wp_calipio_token', $_wp_calipio_token );
			}
			if( isset( $_POST['_wp_calipio_screen'] ) ) {
				$_wp_calipio_screen = sanitize_text_field($_POST['_wp_calipio_screen']);
				update_post_meta( $post_id, '_wp_calipio_screen', $_wp_calipio_screen );
			}
			if( isset( $_POST['_wp_calipio_camera'] ) ) {
				$_wp_calipio_camera = sanitize_text_field($_POST['_wp_calipio_camera']);
				update_post_meta( $post_id, '_wp_calipio_camera', $_wp_calipio_camera );
			}
			if( isset( $_POST['_wp_calipio_microphone'] ) ) {
				$_wp_calipio_microphone = sanitize_text_field($_POST['_wp_calipio_microphone']);
				update_post_meta( $post_id, '_wp_calipio_microphone', $_wp_calipio_microphone );
			}

			if( !empty( $_POST['_wp_calipio_pre_select_camera'] ) ) {
				$_wp_calipio_pre_select_mic = sanitize_text_field($_POST['_wp_calipio_pre_select_camera']);
				update_post_meta( $post_id, '_wp_calipio_pre_select_camera', $_wp_calipio_pre_select_mic );
			}else{
				update_post_meta( $post_id, '_wp_calipio_pre_select_camera', '' );
			}
			if( !empty( $_POST['_wp_calipio_pre_select_mic'] ) ) {
				$_wp_calipio_pre_select_mic = sanitize_text_field($_POST['_wp_calipio_pre_select_mic']);
				update_post_meta( $post_id, '_wp_calipio_pre_select_mic', $_wp_calipio_pre_select_mic );
			}else{
				update_post_meta( $post_id, '_wp_calipio_pre_select_mic', '' );
			}
			if( !empty( $_POST['_wp_calipio_pre_select_screen'] ) ) {
				$_wp_calipio_pre_select_screen = sanitize_text_field($_POST['_wp_calipio_pre_select_screen']);
				update_post_meta( $post_id, '_wp_calipio_pre_select_screen', $_wp_calipio_pre_select_screen );
			}else{
				update_post_meta( $post_id, '_wp_calipio_pre_select_screen', '' );
			}
			if( isset( $_POST['_wp_calipio_startmode'] ) ) {
				$_wp_calipio_endmode = sanitize_text_field($_POST['_wp_calipio_startmode']);
				update_post_meta( $post_id, '_wp_calipio_startmode', $_wp_calipio_endmode );
			}
			if( isset( $_POST['_wp_calipio_endmode'] ) ) {
				$_wp_calipio_endmode = sanitize_text_field($_POST['_wp_calipio_endmode']);
				update_post_meta( $post_id, '_wp_calipio_endmode', $_wp_calipio_endmode );
			}
			if( !empty( $_POST['_wp_calipio_hidepopup'] ) && is_array($_POST['_wp_calipio_hidepopup']) ) {
				update_post_meta( $post_id, '_wp_calipio_hidepopup', $_POST['_wp_calipio_hidepopup'] );
			}else{
				update_post_meta( $post_id, '_wp_calipio_hidepopup', array() );
			}
			if( isset( $_POST['_wp_calipio_customcode'] ) ) {
				$_wp_calipio_customcode = sanitize_textarea_field($_POST['_wp_calipio_customcode']);
				update_post_meta( $post_id, '_wp_calipio_customcode', $_wp_calipio_customcode );
			}
		}
		
		public function wp_calipio_shortcode_render() {

			global $post;
			
			$post_id = $post->ID;
			
			if(!empty($post_id)){
				$shortcode = '[calipio-record id="'.$post_id.'"]';
				?>
				<div class="wp-calipio-shortcode-wrap">
					<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value='<?php echo esc_attr( $shortcode ); ?>' class="large-text code" /></span>
				</div>
				<?php
			}
		}

		public function wp_calipio_add_shortcode_columns( $columns ) {

			$offset = array_search('author', array_keys($columns));
			return array_merge(array_slice($columns, 0, $offset), ['shortcode' => __('Shortcode', 'wpcalipio')], array_slice($columns, $offset, null));
		}

		public function wp_calipio_add_shortcode_columns_render($column_key, $post_id) {

			if( $column_key == 'shortcode' && !empty($post_id) ) {
				
				$shortcode = '[calipio-record id="'.$post_id.'"]';?>

				<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value='<?php echo esc_attr( $shortcode ); ?>' class="large-text code" /></span>
				<?php
			}
		}


		public function wp_calipio_admin_menu() {
			
			global $submenu;
    		
    		if( isset( $submenu['edit.php?post_type=wp_calipio'][10] ) ) {
    			unset( $submenu['edit.php?post_type=wp_calipio'][10] );
    		}
		}

		/**
		 * Adding Hooks
		 *
		 * @package Calipio Screen Recorder
		 * @since 1.0.0
		 */
		function add_hooks() {

			// Add Metabox
			add_action( 'add_meta_boxes', array( $this, 'wp_calipio_add_meta_box' ) );

			// Save meta fields
			add_action( 'save_post', array( $this, 'wp_calipio_save_meta_box' ) );
			
			// Add Columns on list table
			add_filter( 'manage_'.WP_CALIPIO_POST_TYPE.'_posts_columns', array( $this, 'wp_calipio_add_shortcode_columns' ) );
			add_action( 'manage_'.WP_CALIPIO_POST_TYPE.'_posts_custom_column', array( $this, 'wp_calipio_add_shortcode_columns_render' ),10,2 );
			
			// Remove the add shortcode menu
			add_action( 'admin_menu', array( $this, 'wp_calipio_admin_menu' ) );
		}
	}
}