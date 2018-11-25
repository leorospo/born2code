<?php	/* Pagina backend - Racconti premiti
		*
		* Per funzionare ha bisogno di:
		*		- Foglio di stile già richiamato
		*
		*/
?>


<?php
	if (!current_user_can('adr_assegna_premio') ) {
		wp_die(
			'Non hai accesso a questa pagina.',
			'Non fare il furbo!',
			array( response		=>	'403',
				   back_link	=>	'true')
		);
	}
?>


<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/bcknd-racconti-premiati.css">


<div class="wrap">
	<h2>Racconti premiati</h2>
	
        <?php
			$adr_racconti_premiati_anni =  array('2019',
												 '2020',
												 '2021',
												 '2022',
												 '2023',
												 '2024',
												 '2025'
											  );
		?>
        
        
        <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : '2019'; ?>
        
        <h2 class="nav-tab-wrapper">
        	<?php
				foreach ($adr_racconti_premiati_anni as $anno) {
					?>
        				<a href="?page=racconti-premiati&tab=<?php echo $anno; ?>" class="nav-tab <?php echo $active_tab == $anno ? 'nav-tab-active' : ''; ?>"><?php echo $anno; ?></a>
					<?php
				} 
			?>

		</h2>
       
			<?php
			
				foreach ($adr_racconti_premiati_anni as $anno) {

					if( $active_tab == $anno ) {
						?>
							<h2>Premiati <?php echo $anno; ?></h2>
							<div class="racconti-premiati">
								
								<?php	//Recupera il numero dei racconti in quel ciclo
						
								$anno_prec = $anno - 1;
								$data_fine_anno_prec = get_option( 'data-fine-' . $anno_prec ) . ' 23:59:60';
								$data_fine_anno = get_option( 'data-fine-' . $anno ) . ' 23:59:60';
								$check_data_fine_anno_prec = get_option( 'data-fine-' . $anno_prec );
								$check_data_fine_anno = get_option( 'data-fine-' . $anno );
								switch ($anno)  {
									case '2019':
										$data_fine_anno_prec = get_option( 'data-inizio-2019' );
										$check_data_fine_anno_prec = $data_fine_anno_prec;
										break;

								}
									
								if ($check_data_fine_anno_prec == '' && $check_data_fine_anno == '') {
									if ( current_user_can('adr_accesso_pannello_gestione')) {
										$custom_message = '<br>Vai al <b><a href="' . admin_url() . 'admin.php?page=pannello-gestione ">Pannello gestione</a></b>';
									} else {
										$custom_message ='<br><b><span>Contatta un amministratore.</span></b>';
									}

									echo '<div class="backend-message"><span style="margin-bottom: 18px; color: red;" class="dashicons dashicons-warning"></span><br><span>Le date di questo premio non sono ancora state settate...</span><span>'. $custom_message . '</span></div>';
								} else {

										// The Query
									$the_query = new WP_Query( array('post_type'	=>	'racconti',
																	 'post_status'	=>	'publish',
																	 'orderby'		=>	'tx_premiati',
																	 'order'		=>	'ASC',
																	 'tax_query'		=>	array(
																								array(
																									'taxonomy' => 'tx_premiati',
																									'operator' => 'EXISTS'
																									)
																								),
																	 'meta_query'	=> array(
																							array(
																								'key'		=>	'draft_to_pending_date_time',
																								'value'		=>	array( $data_fine_anno_prec, $data_fine_anno),
																								'compare'	=>	'BETWEEN',
																							)
																						)

																	));

									// Se ci sono racconti presenti fai vedere il numero se no 0

									// The Loop
									if ( $the_query->have_posts() ) {?>
									
										<div class="mdl-con">
											<div class="mdl-con-tgrid">
										
												<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

													<div class="mdl-con-tgrid-itm<?php echo $racconto_num;?>">
														<?php get_template_part( '/template-parts/tale-single' ); ?>
													</div>


												<?php endwhile; ?>
											</div>
										</div>
								<?php

									} else {
										if (current_user_can('adr_assegna_premio')) {
											$custom_message = '<span><br>Assegna un premio <b><a href="' . get_admin_url() . 'admin.php?page=archivio-racconti ">qui</a></b>.</span>';
										}
										echo('<div class="backend-message"><span style="margin-bottom: 18px;" class="dashicons dashicons-warning"></span><span>Non ci sono ancora racconti premiati per l\'anno ' . $anno . '.</span>' . $custom_message .'</div>');
									}

									/* Restore original Post Data */
									wp_reset_postdata();

								}
						
								?>
								
							</div>
							
			<?php
					} 

				}
            ?>

</div>


<style>
	.racconti-premiati {
		display: flex;
		align-items: center;
		justify-content: center;
		height: 500px;
	}

	.backend-message > span {align-self: center;}

	.backend-message {
		display: flex;
		flex-flow: column wrap;
		align-content: center;
		justify-content: center;
	}
</style>
