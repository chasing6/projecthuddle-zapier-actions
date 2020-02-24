<?php
/**
 * @link              http://c6creative.com
 * @since             1.0.0
 * @package           PH_Zapier
 *
 * @wordpress-plugin
 * Plugin Name:       ProjectHuddle Zapier Actions
 * Plugin URI:        http://innovatedentalmarketing.com/
 * Description:       Send ProjectHuddle actions to Zapier
 * Version:           1.0.0
 * Author:            Scott McCoy
 * Author URI:        https://github.com/chasing6/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       innovate-client
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/chasing6/projecthuddle-zapier-actions
 */

require_once plugin_dir_path( __FILE__ ) . 'libraries/autoloader.php';

new PH_Zapier_Actions\Init();
