<?php

/**
 * Activate the plugin.
 */

 function pluginprefix_activate() {
	jb_custom_post_type();
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );

?>