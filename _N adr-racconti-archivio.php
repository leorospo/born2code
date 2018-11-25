<?php
if (!current_user_can('adr_accesso_archivio_racconti') ) {
	wp_die(
		'Non hai accesso a questa pagina.',
		'Non fare il furbo!',
		array( response		=>	'403',
			   back_link	=>	'true')
	);
}

?>

<?php $active_ciclo = isset( $_GET[ 'ciclo' ] ) ? $_GET[ 'ciclo' ] : '' ; ?>

 <div class="wrap">
 	<h2>Archivio racconti</h2>

	 		<br>
			<table class="form-table maxw-600">
				<tbody>

					<!--Header tabella-->
					<tr>
						<th scope="column">Premio</th>
						<th scope="col"><span>Primo Ciclo</span><br>Luglio -> Dicembre</th>
						<th scope="col">Secondo Ciclo<br>Gennaio -> Luglio</th>
					</tr>

					<?php
					
						//Utilizzamo un foreach per definire le righe - C'è qualche escamotage per la prima riga
						$adr_archivio_racconti_anni =  array('2019',
															 '2020',
															 '2021',
															 '2022',
															 '2023',
															 '2024',
															 '2025'
														  );

						// Grazie alla magia del foreach non dobbiamo scriverlo cento volte
						foreach ($adr_archivio_racconti_anni as $anno) {

					?>
					<tr>
						<th scope="row"><?php echo($anno) ?></th>
						<td>
							<button class="button page-title-action button-large minw-100" onclick="location.href='<?php echo (admin_url() . 'edit.php?post_type=racconti&ciclo=' . $anno) ?>-1'" type="button">

							<?php	//Recupera il numero dei racconti in quel ciclo
								$anno_prec = $anno - 1;
								$data_fine_anno_prec = get_option( 'data-fine-' . $anno_prec ) . ' 23:59:60';
								$check_data_fine_anno_prec = get_option( 'data-fine-' . $anno_prec );
								switch ($anno)  {
									case '2019':
										$data_fine_anno_prec = get_option( 'data-inizio-2019' );
										$check_data_fine_anno_prec = $data_fine_anno_prec;
										break;

								}
									
								if ($check_data_fine_anno_prec == '') {

									echo('<span class="dashicons dashicons-warning"></span>');

								} else {

										// The Query
									$the_query = new WP_Query( array('post_type'	=>	'racconti',
																	 'post_status'	=>	'publish',
																	 'meta_query'	=> array(
																							array(
																								'key'		=>	'draft_to_pending_date_time',
																								'value'		=>	array( $data_fine_anno_prec, $anno_prec . '-12-31 23:59:60'),
																								'compare'	=>	'BETWEEN',
																							)
																						)

																	));

									// Se ci sono racconti presenti fai vedere il numero se no 0
									$numero = $the_query->found_posts;

									// The Loop
									if ( $the_query->have_posts() ) {
										echo $numero;

									} else {
										//No post found
										echo('0');
									}

									/* Restore original Post Data */
									wp_reset_postdata();

								}
							?>

							</button>
						</td>
						<td>
							<button class="button page-title-action button-large minw-100" onclick="location.href='<?php echo (admin_url() . 'edit.php?post_type=racconti&ciclo=' . $anno) ?>-2'" type="button">

							<?php
								$data_fine_anno = get_option( 'data-fine-' . $anno) . ' 23:59:60';
									
								if (get_option( 'data-fine-' . $anno) == '') {

									echo('<span class="dashicons dashicons-warning"></span>');

								} else {
									
										// The Query
									$the_query = new WP_Query( array('post_type'	=>	'racconti',
																	 'post_status'	=>	'publish',
																	 'meta_query'	=> array(
																							array(
																								'key'		=>	'draft_to_pending_date_time',
																								'value'		=>	array( $anno . '-01-01', $data_fine_anno ),
																								'compare'	=>	'BETWEEN',
																							)
																						)

																	));

									// Se ci sono racconti presenti fai vedere il numero se no 0
									$numero = $the_query->found_posts;

									// The Loop
									if ( $the_query->have_posts() ) {
										echo $numero;

									} else {
										//No post found
										echo('0');
									}

									/* Restore original Post Data */
									wp_reset_postdata();

								}
							?>

							</button>
						</td>
					</tr>
					<?php
							
						} 
					?>

				</tbody>
			</table>
			<br>

			<p>Se vedi <span class="dashicons dashicons-warning"></span> <?php 

			if ( current_user_can('adr_accesso_pannello_gestione')) {
					echo(' devi ancora impostare le date per quel ciclo. Vai al <a href="' . admin_url() . 'admin.php?page=pannello-gestione ">Pannello gestione</a>');
				} else {
					echo(' non sono ancora state settate le date per quel ciclo. Contatta un amministratore.');
				}
			?> </p>

</div>




 		<style>
			.maxw-600 {
				max-width: 600px;
			}
			
			.minw-100 {
				min-width: 80px;
			}
			
			table td, table th {
				text-align: center !important;
				vertical-align: middle !important;
			}
			
			button span {
				margin-top: 4px;
			}

			
			
			
			
			
			
	 	</style>
