<?php 

/**==========Product Viewed============= */
add_action('admin_init', 'gpm_add_meta_boxes', 2);

function gpm_add_meta_boxes() {
add_meta_box( 'gpminvoice-group', 'Custom Repeatable', 'Repeatable_meta_box_display', 'product', 'normal', 'default');
}

function Repeatable_meta_box_display() {
    global $post;
    $gpminvoice_group = get_post_meta($post->ID, 'customdata_group', true);
     wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function( $ ){
        $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
            return false;
        });

        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    });
  </script>
  <table id="repeatable-fieldset-one" width="100%">
  <tbody>
    <?php
     if ( $gpminvoice_group ) :
      foreach ( $gpminvoice_group as $field ) {
    ?>
    <tr>
      <td width="15%">
        <input type="text"  placeholder="Title" name="TitleItem[]" value="<?php if($field['TitleItem'] != '') echo esc_attr( $field['TitleItem'] ); ?>" /></td> 
      <td width="70%">
      <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"> <?php if ($field['TitleDescription'] != '') echo esc_attr( $field['TitleDescription'] ); ?> </textarea></td>
      <td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
    </tr>
    <?php
    }
    else :
    // show a blank one
    ?>
    <tr>
      <td> 
        <input type="text" placeholder="Title" title="Title" name="TitleItem[]" /></td>
      <td> 
          <textarea  placeholder="Description" name="TitleDescription[]" cols="55" rows="5">  </textarea>
          </td>
      <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
    </tr>
    <?php endif; ?>

    <!-- empty hidden one for jQuery -->
    <tr class="empty-row screen-reader-text">
      <td>
        <input type="text" placeholder="Title" name="TitleItem[]"/></td>
      <td>
          <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"></textarea>
          </td>
      <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<p><a id="add-row" class="button" href="#">Add another</a></p>
 <?php
}
add_action('save_post', 'custom_repeatable_meta_box_save');
function custom_repeatable_meta_box_save($post_id) {
    if ( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'customdata_group', true);
    $new = array();
    $invoiceItems = $_POST['TitleItem'];
    $prices = $_POST['TitleDescription'];
     $count = count( $invoiceItems );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $invoiceItems[$i] != '' ) :
            $new[$i]['TitleItem'] = stripslashes( strip_tags( $invoiceItems[$i] ) );
             $new[$i]['TitleDescription'] = stripslashes( $prices[$i] ); // and however you want to sanitize
        endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'customdata_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'customdata_group', $old );


}