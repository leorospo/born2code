<?php
// 7.1- adr_get_prize
function adr_get_prize ($draft_to_pending_date_time) {
	
	$date = $draft_to_pending_date_time;
	
	if ( empty($date) ) {
		return('');
		
	} elseif ( get_option( 'data-inizio-2019' ) <= $date && $date <= get_option( 'data-fine-2019' ) ) {
		return('2019');
		
	} elseif( get_option( 'data-fine-2019' ) <= $date && $date <= get_option( 'data-fine-2020' ) ) {
		return('2020');
		
	} elseif( get_option( 'data-fine-2020' ) <= $date && $date <= get_option( 'data-fine-2021' ) ) {
		return('2021');
		
	} elseif( get_option( 'data-fine-2021' ) <= $date && $date <= get_option( 'data-fine-2022' ) ) {
		return('2022');
		
	} elseif( get_option( 'data-fine-2022' ) <= $date && $date <= get_option( 'data-fine-2023' ) ) {
		return('2023');
		
	} elseif( get_option( 'data-fine-2023' ) <= $date && $date <= get_option( 'data-fine-2024' ) ) {
		return('2024');
		
	} elseif( get_option( 'data-fine-2024' ) <= $date && $date <= get_option( 'data-fine-2025' ) ) {
		return('2025');

	} else {
		return('Error -> functions.php -> adr_get_prize()');
		
	}
	
}

?>
