<?php

/* 
 * Version:     0.1.1
 * 
 * Plugin Name: Dashboard Widget Editor
 * Plugin URI:  
 * 
 * Description: You can add and remove widgets to the dashboard.
 * 
 * Author:      Jack Russell
 * Author URI:  http://tekuaru.jack-russell.jp/
 * 
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * 
 * Text Domain: translation
 * Domain Path: /languages/
 * 
 */

//---------------------------------------------------------------------------
//    ダッシュボード ウィジェット追加 
//---------------------------------------------------------------------------

if( ! class_exists( 'jr_dashboard_widget_editor' ) ) {
  
  load_plugin_textdomain( 'translation', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
  
  class jr_dashboard_widget_editor {
    
    const JR_WIDGET_COUNT = 10;
    
    public $jr_dashboard_widget_editor = array();
    
    function __construct() {
      add_action( 'admin_menu', array( $this, 'add_pages' ) );
      add_action( 'wp_dashboard_setup', array( $this, 'jr_dashboard_widget_editor_render' ) );
    }
    function add_pages() {
      add_options_page( __( 'Dashboard', 'translation' ) . '<br>- ' . __( 'Add widgets', 'translation' ), __( 'Dashboard', 'translation' ) . '<br>- ' . __( 'Add widgets', 'translation' ), 'activate_plugins', 'jr_dashboard_widget_editor', array( $this,'jr_dashboard_widget_editor_option_page' ) );
    }
    function jr_dashboard_widget_editor_option_page() {
      require_once( 'setting.php' );
    }
    
    function jr_dashboard_widget_editor_render() {
      $this->update_dashboard_widget();
      for( $i = 1; $i <= self::JR_WIDGET_COUNT; $i++ ) {
        if( $this->jr_dashboard_widget_editor["dashboard_{$i}"]['view'] ) {
          wp_add_dashboard_widget( "jr_support_widget_{$i}", $this->jr_dashboard_widget_editor["dashboard_{$i}"]['title'], array($this, "dashboard_{$i}_text" ) );
        }
      }
    }
    
    function dashboard_text( $i ) {
      echo( nl2br( $this->jr_dashboard_widget_editor["dashboard_{$i}"]['content'] ) );
    }
    
    function dashboard_1_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_1']['content'] ) );
    }
    function dashboard_2_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_2']['content'] ) );
    }
    function dashboard_3_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_3']['content'] ) );
    }
    function dashboard_4_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_4']['content'] ) );
    }
    function dashboard_5_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_5']['content'] ) );
    }
    function dashboard_6_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_6']['content'] ) );
    }
    function dashboard_7_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_7']['content'] ) );
    }
    function dashboard_8_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_8']['content'] ) );
    }
    function dashboard_9_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_9']['content'] ) );
    }
    function dashboard_10_text() {
      echo( nl2br( $this->jr_dashboard_widget_editor['dashboard_10']['content'] ) );
    }
    
    function update_dashboard_widget() {
      $this->jr_dashboard_widget_editor = get_option( 'jr_dashboard_widget_editor' );
    }
    
  }
  
}

if( class_exists( 'jr_dashboard_widget_editor' ) && is_admin() ) {
  new jr_dashboard_widget_editor;
}
