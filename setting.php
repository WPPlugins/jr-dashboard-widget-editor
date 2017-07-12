<?php
  if( ! empty( $_POST ) && ! empty( $_POST['jr_dashboard_widget_editor'] ) && check_admin_referer( 'jr_dashboard_widget_editor-setting', 'jr_dashboard_widget_editor-nonce' ) && current_user_can( 'activate_plugins' ) ) {
    
    $jr_dashboard_widget_editor_update = array();
    
    for( $i = 1; $i <= self::JR_WIDGET_COUNT; $i++ ) {
      if( ! isset( $_POST['jr_dashboard_widget_editor']["{$i}_view"], $_POST['jr_dashboard_widget_editor']["{$i}_title"], $_POST['jr_dashboard_widget_editor']["{$i}_content"] ) )
        continue;
      
      $jr_dashboard_widget_editor_update["dashboard_{$i}"] = array(
        'view'    => stripslashes_deep( $_POST['jr_dashboard_widget_editor']["{$i}_view"] ),
        'title'   => stripslashes_deep( $_POST['jr_dashboard_widget_editor']["{$i}_title"] ),
        'content' => stripslashes_deep( $_POST['jr_dashboard_widget_editor']["{$i}_content"] ),
      );
    }
    
    update_option('jr_dashboard_widget_editor', $jr_dashboard_widget_editor_update);
    
    echo( '<div class="updated"><p>'.__('Settings saved.').'</p></div>' );
  }
  
// -------------------------------------------------------------------------------------------------
  
  $this->update_dashboard_widget();
?>
<div class="wrap">
  <h2><?php _e( 'Dashboard', 'translation' ); echo( ' - ' ); _e( 'Add widgets', 'translation' ); ?></h2>
  <form method="post" action="">
    <table class="form-table">
      
<?php
  $txt_no = 1;
  for( $i = 1; $i <= self::JR_WIDGET_COUNT; $i++) {
?>
      <tr valign="top">
        <th scope="row"><label for="inputtext_<?php echo( $txt_no ); ?>"><?php _e( 'Dashboard', 'translation' ); ?> <?php echo( $i ); ?> - <?php _e( 'Enabled', 'translation' ); ?></label></th>
        <td>
          <input type="hidden" name="jr_dashboard_widget_editor[<?php echo( $i ); ?>_view]" value="0">
          <input type="checkbox" name="jr_dashboard_widget_editor[<?php echo( $i ); ?>_view]" id="inputtext_<?php echo( $txt_no ); $txt_no++; ?>" value="1"<?php if($this->jr_dashboard_widget_editor["dashboard_{$i}"]['view']) echo( ' checked' ); ?>>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="inputtext_<?php echo( $txt_no ); ?>"><?php _e( 'Dashboard', 'translation' ); ?> <?php echo( $i ); ?> - <?php _e( 'Title', 'translation' ); ?></label></th>
        <td><input type="text" name="jr_dashboard_widget_editor[<?php echo( $i ); ?>_title]" id="inputtext_<?php echo( $txt_no ); $txt_no++; ?>" value="<?php echo( $this->jr_dashboard_widget_editor["dashboard_{$i}"]['title'] ); ?>" size="50"></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="inputtext_<?php echo( $txt_no ); ?>"><?php _e( 'Dashboard', 'translation' ); ?> <?php echo( $i ); ?> - <?php _e( 'Content', 'translation' ); ?></label></th>
        <td><textarea name="jr_dashboard_widget_editor[<?php echo( $i ); ?>_content]" id="inputtext_<?php echo( $txt_no ); $txt_no++; ?>" cols="80" rows="10" ><?php echo( $this->jr_dashboard_widget_editor["dashboard_{$i}"]['content'] ); ?></textarea></td>
      </tr>
      
<?php
  }
  wp_nonce_field( 'jr_dashboard_widget_editor-setting','jr_dashboard_widget_editor-nonce' );
?>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
<?php
