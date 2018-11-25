<?php
//Draft to pending adds
function draft_to_pending_date_time_updater( $post ) {
	
	if ('racconti' == $post->post_type) {
		$meta_value = current_time( 'Y-m-d H:i:s' );
		update_post_meta( $post->ID, 'draft_to_pending_date_time', $meta_value );
	}
	
};
add_action(  'draft_to_pending',  'draft_to_pending_date_time_updater' );

			//Any state to draft removes
function racconti_to_draft_date_time_deleter( $ID, $post ) {
	update_post_meta( $ID, 'draft_to_pending_date_time', '' );
}
add_action(  'draft_racconti',  'racconti_to_draft_date_time_deleter', 10, 2 );

?>
