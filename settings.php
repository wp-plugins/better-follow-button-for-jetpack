<?php 
	// create custom plugin settings menu
	add_action('admin_menu', 'bfbj_create_menu');

	function bfbj_create_menu()
	{
    		// create new top-level menu
    		add_menu_page('Better Follow Button Settings', 'BFBJ Settings', 'manage_options', __FILE__, 'bfbj_settings_page', null);
    
    		// call register settings function
    		add_action('admin_init', 'register_mysettings');
	}

	function register_mysettings()
	{
    		// register our settings
    		register_setting('bfb-settings-group', 'bfbj_buttontext');
    		register_setting('bfb-settings-group', 'bfbj_headingtext');
    		register_setting('bfb-settings-group', 'bfbj_emailplaceholder');
    		register_setting('bfb-settings-group', 'bfbj_signupbuttontext');
    		register_setting('bfb-settings-group', 'bfbj_buttoncolor');
    		register_setting('bfb-settings-group', 'bfbj_buttoncoloropen');
    		register_setting('bfb-settings-group', 'bfbj_modalbackgroundcolor');
    		register_setting('bfb-settings-group', 'bfbj_submitbuttoncolor');
    		register_setting('bfb-settings-group', 'bfbj_modalopacity');
			register_setting('bfb-settings-group', 'bfbj_fontfamily');
			register_setting('bfb-settings-group', 'bfbj_buttonfontsize');
			register_setting('bfb-settings-group', 'bfbj_headingtextfontsize');
	}

	function bfbj_settings_page()
	{
		// settings page template
?>

<div class="wrap">
	<h2>Better Follow Button for JetPack</h2>
    <?php 
    	echo get_option('plugin_error');
    	if (isset($_GET['settings-updated'])) {
	?>
    <div id="message" class="updated">
    	<p><strong><?php _e('Settings saved.');?></strong></p>                        
    </div>
    <?php } ?>
        
<form method="post" action="options.php">
	<?php settings_fields('bfb-settings-group');?>
	<?php do_settings_sections('bfb-settings-group');?>
	<table class="form-table">
		<tr><th><h3>Text</h3></th></tr>
		<tr valign="top">
			<th scope="row">Button text</th>
			<td>
				<input type="text" name="bfbj_buttontext" value="<?php echo esc_attr(get_option('bfbj_buttontext'));?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Heading Text</th>
			<td>
				<input type="text" name="bfbj_headingtext" value="<?php echo esc_attr(get_option('bfbj_headingtext'));?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Email Placeholder Text</th>
			<td>
				<input type="text" name="bfbj_emailplaceholder" value="<?php echo esc_attr(get_option('bfbj_emailplaceholder'));?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Signup Button Text</th>
			<td>
				<input type="text" name="bfbj_signupbuttontext" value="<?php echo esc_attr(get_option('bfbj_signupbuttontext'));?>" />
			</td>
		</tr>
		<tr><th><h3>Colors</h3></th></tr>
		<tr valign="top">
			<th scope="row">Follow Button Color</th>
			<td>
				<input type="color" name="bfbj_buttoncolor" value="<?php echo esc_attr(get_option('bfbj_buttoncolor')) ?: '#252525';?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Follow Button Color</br><em>when expanded</em></th>
			<td>
				<input type="color" name="bfbj_buttoncoloropen" value="<?php echo esc_attr(get_option('bfbj_buttoncoloropen')) ?: '#252525';?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Modal background color</th>
			<td>
				<input type="color" name="bfbj_modalbackgroundcolor" value="<?php echo esc_attr(get_option('bfbj_modalbackgroundcolor')) ?: '#464646';?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Submit Button Color</th>
			<td>
				<input type="color" name="bfbj_submitbuttoncolor" value="<?php echo esc_attr(get_option('bfbj_submitbuttoncolor')) ?: '#282828';?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Modal Opacity</br><em>Enter 0-1 (ex. 0.85)</em></th>
			<td>
				<input type="number" name="bfbj_modalopacity" min="0" max="1" step="0.01" title="Please enter a number between 0 and 1" value="<?php echo esc_attr(get_option('bfbj_modalopacity')) ?: '0.95';?>" />
			</td>
		</tr>
		<tr><th><h3>Fonts</h3></th></tr>
		<tr valign="top">
			<th scope="row">Font Family</br><em>Enter a custom font family like Verdana, Times New Roman, or others</em></th>
			<td valign="top">
				<input type="text" name="bfbj_fontfamily" value="<?php echo esc_attr(get_option('bfbj_fontfamily')) ?: 'Avenir';?>" />
			</td>
		</tr>
	</table>
	<?php submit_button();?>
</form>                  
</div>
<?php } ?>
