<?php

/*
* ---CONTENT INDEX---
*
* 1- Theme setup
*
* 2- Resources
*
* 3- Custom Post Types and Custom Taxonomies

*	3.1- Register Custom post types
*		3.1.1- Register Designer
*		3.1.2- Register Aziende
*		3.1.3- Register Storia
*		3.1.4- Register Schede
*		3.1.5- Add capabilities to the admins

* 	3.2- Register Custom Taxonomies
*		3.2.1- Register tx_designer
*		3.2.2- Register tx_aziende
*		3.2.3- Register tx_storia
*
*	3.3- Edit Custom Post Types and Taxonomies
*		3.3.1- Edit designer permalinks
*
*	4- Workflow
*	4.1- Define Roles <--! MISSING !--> (User role editor)
*	4.2- Assign Capabilities <--! MISSING !--> (Edit Flow)
*	4.3- Customize Interface
*		4.3.1- Hide features to all but admin users
*		4.3.2- Edit Flow (plugin) customizations
*		4.3.3- Custom bubble notifications for different roles
*		4.3.4- Media Upload and metabox
*		4.3.5- Customize Anni taxononomy metabox
*		4.3.6- Add 'Fonti' and 'Revisioni' metabox	
*		4.3.7- Hide 'parent box' for non hirerarchical custom tax metaboxes
*		4.3.8- Email Notifications <--! MISSING !-->
*			Daily pending recap (da customizzare per i vari ruoli)
*			Post status changes (da customizzare per i vari ruoli)
*
*	5- Frontend Interface customizations
*		5.1 - <!-- Galleries -->
*
*	6- AJAX Load More
*
*
*
*
*
* Ultimo numero- Appunti
* 	1 farà parte di una cosa più grande, vedi Bento
* 	5+6+7 possono far parte di "Role's interface customizations"
*	link per rimuovere roba dal menù laterale WP (es. categorie e tag sotto articoli)
*	ultimo numero.1- Query di ricerca per tassonomie
*	ultimo numero.1- Query di ricerca per custom post-type
*
*/



// 1- Theme setup													------------------------------------------------ (1)

function argano_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails', array( 'designer', 'aziende', 'storia', 'schede' ) );
	
/*	// Add special capabilities - vedi sotto edit fow customizations vicino(4)
	function epp_add_cap() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles;

    $wp_roles->add_cap( 'revisore_d', 'edit_in-attesa_posts' );
	$wp_roles->add_cap( 'revisore_a', 'edit_in-attesa_posts' );
	$wp_roles->add_cap( 'revisore', 'edit_in-attesa_posts' );
	}*/
		
}
add_action( 'after_setup_theme', 'argano_theme_setup' );





// 2- Resources														------------------------------------------------ (2)

function argano_resources() {
	
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/functions.js', array ( 'jquery' ), 1.1, true);

}
add_action('wp_enqueue_scripts', 'argano_resources');





// 3- Custom Post Types and Custom Taxonomies						------------------------------------------------ (3)
	//3.1- Custom post types
		# Reference: https://generatewp.com/post-type/


		//3.1.1- Register Designer
if ( ! function_exists('designer_post_type') ) {
// Child theme support

function designer_post_type() {

	$labels = array(
		'name'					=> _x( 'Designer', 'Post Type General Name', 'text_domain' ),
		'singular_name'			=> _x( 'Designer', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Designer', 'text_domain' ),
		'name_admin_bar'        => __( 'Designer', 'text_domain' ),
		'archives'              => __( 'Archivi dei designer', 'text_domain' ),
		'attributes'            => __( 'Attributi dei designer', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent item', 'text_domain' ),
		'all_items'             => __( 'Tutti i designer', 'text_domain' ),
		'add_new_item'          => __( 'Aggiungi nuovo designer', 'text_domain' ),
		'add_new'               => __( 'Aggiungi nuovo', 'text_domain' ),
		'new_item'              => __( 'Nuovo designer', 'text_domain' ),
		'edit_item'             => __( 'Modifica designer', 'text_domain' ),
		'update_item'           => __( 'Aggiorna designer', 'text_domain' ),
		'view_item'             => __( 'Visualizza designer', 'text_domain' ),
		'view_items'            => __( 'Visualizza designer', 'text_domain' ),
		'search_items'          => __( 'Cerca designer', 'text_domain' ),
		'not_found'             => __( 'Non trovato', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trovato nel cestino', 'text_domain' ),
		'featured_image'        => __( 'Foto del designer', 'text_domain' ),
		'set_featured_image'    => __( 'Carica la foto del designer', 'text_domain' ),
		'remove_featured_image' => __( 'Togli immagine in primo piano', 'text_domain' ),
		'use_featured_image'    => __( 'Utilizza come immagine in primo piano', 'text_domain' ),
		'insert_into_item'      => __( 'Inserisci nel designer', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Caricato nel designer', 'text_domain' ),
		'items_list'            => __( 'Elenco designer', 'text_domain' ),
		'items_list_navigation' => __( 'Scorri l\'elenco designer', 'text_domain' ),
		'filter_items_list'     => __( 'Filtra l\'elenco designer', 'text_domain' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_designer',
		'read_post'             => 'read_designer',
		'delete_post'           => 'delete_designer',
		
		'edit_posts'            => 'edit_designers',
		'edit_others_posts'     => 'edit_others_designers',
		'publish_posts'         => 'publish_designers',
		'read_private_posts'    => 'read_private_designers',
	);
	$args = array(
		'label'                 => __( 'Designer', 'text_domain' ),
		'description'           => __( 'Raccolta delle pagine dedicate ai singoli designer', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
		'map_meta_cap'			=> true,
	);
	register_post_type( 'designer', $args );

}
add_action( 'init', 'designer_post_type', 0 );

}


		//3.1.2- Register Aziende
if ( ! function_exists('azienda_post_type') ) {
// Child theme support

function azienda_post_type() {

	$labels = array(
		'name'                  => _x( 'Aziende', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Azienda', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Aziende', 'text_domain' ),
		'name_admin_bar'        => __( 'Azienda', 'text_domain' ),
		'archives'              => __( 'Archivi delle Aziende', 'text_domain' ),
		'attributes'            => __( 'Attributi delle Aziende', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent item', 'text_domain' ),
		'all_items'             => __( 'Tutte le Aziende', 'text_domain' ),
		'add_new_item'          => __( 'Aggiungi nuova Azienda', 'text_domain' ),
		'add_new'               => __( 'Aggiungi nuova', 'text_domain' ),
		'new_item'              => __( 'Nuova Azienda', 'text_domain' ),
		'edit_item'             => __( 'Modifica Azienda', 'text_domain' ),
		'update_item'           => __( 'Aggiorna Azienda', 'text_domain' ),
		'view_item'             => __( 'Visualizza Azienda', 'text_domain' ),
		'view_items'            => __( 'Visualizza Aziende', 'text_domain' ),
		'search_items'          => __( 'Cerca Azienda', 'text_domain' ),
		'not_found'             => __( 'Non trovata', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trovata nel cestino', 'text_domain' ),
		'featured_image'        => __( 'Foto dell\'azienda', 'text_domain' ),
		'set_featured_image'    => __( 'Carica la foto dell\'azienda', 'text_domain' ),
		'remove_featured_image' => __( 'Togli immagine in primo piano', 'text_domain' ),
		'use_featured_image'    => __( 'Utilizza come immagine in primo piano', 'text_domain' ),
		'insert_into_item'      => __( 'Inserisci nell\' Azienda', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Carica nell\' Azienda', 'text_domain' ),
		'items_list'            => __( 'Elenco Aziende', 'text_domain' ),
		'items_list_navigation' => __( 'Scorri l\'elenco Aziende', 'text_domain' ),
		'filter_items_list'     => __( 'Filtra l\'elenco Aziende', 'text_domain' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_azienda',
		'read_post'             => 'read_azienda',
		'delete_post'           => 'delete_azienda',
		
		'edit_posts'            => 'edit_aziende',
		'edit_others_posts'     => 'edit_others_aziende',
		'publish_posts'         => 'publish_aziende',
		'read_private_posts'    => 'read_private_aziende',
	);
	$args = array(
		'label'                 => __( 'Azienda', 'text_domain' ),
		'description'           => __( 'Raccolta delle pagine dedicate alle singole Aziende', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-multisite',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
		'map_meta_cap'			=> true,
	);
	register_post_type( 'aziende', $args );

}
add_action( 'init', 'azienda_post_type', 0 );

}


		//3.1.3- Register Storia
if ( ! function_exists('storia_post_type') ) {
// Child theme support
	
function storia_post_type() {

	$labels = array(
		'name'                  => _x( 'Movimenti storici', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Movimento storico', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Storia', 'text_domain' ),
		'name_admin_bar'        => __( 'Movimento storico', 'text_domain' ),
		'archives'              => __( 'Archivo Storia', 'text_domain' ),
		'attributes'            => __( 'Attributi del movimento', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent item', 'text_domain' ),
		'all_items'             => __( 'Tutti i movimenti storici', 'text_domain' ),
		'add_new_item'          => __( 'Aggiungi un nuovo movimento storico', 'text_domain' ),
		'add_new'               => __( 'Aggiungi nuovo', 'text_domain' ),
		'new_item'              => __( 'Nuovo movimento storico', 'text_domain' ),
		'edit_item'             => __( 'Modifica movimento', 'text_domain' ),
		'update_item'           => __( 'Aggiorna movimento', 'text_domain' ),
		'view_item'             => __( 'Visualizza movimento', 'text_domain' ),
		'view_items'            => __( 'Visualizza movimenti', 'text_domain' ),
		'search_items'          => __( 'Cerca movimento', 'text_domain' ),
		'not_found'             => __( 'Non trovato', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trovato nel cestino', 'text_domain' ),
		'featured_image'        => __( 'Foto del movimento storico', 'text_domain' ),
		'set_featured_image'    => __( 'Carica la foto del movimento storico', 'text_domain' ),
		'remove_featured_image' => __( 'Togli immagine in primo piano', 'text_domain' ),
		'use_featured_image'    => __( 'Utilizza come immagine in primo piano', 'text_domain' ),
		'insert_into_item'      => __( 'Inserisci nel movimento', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Carica nel movimento', 'text_domain' ),
		'items_list'            => __( 'Elenco dei movimenti', 'text_domain' ),
		'items_list_navigation' => __( 'Scorri l\'elenco dei movimenti storici', 'text_domain' ),
		'filter_items_list'     => __( 'Filtra l\'elenco dei movimenti storici', 'text_domain' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_movimento_storico',
		'read_post'             => 'read_movimento_storico',
		'delete_post'           => 'delete_movimento_storico',
		
		'edit_posts'            => 'edit_movimenti_storici',
		'edit_others_posts'     => 'edit_others_movimenti_storici',
		'publish_posts'         => 'publish_movimenti_storici',
		'read_private_posts'    => 'read_private_movimenti_storici',
	);
	$args = array(
		'label'                 => __( 'Movimento storico', 'text_domain' ),
		'description'           => __( 'Raccolta delle pagine dedicate ai movimenti storici', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-backup',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
		'map_meta_cap'			=> true,
	);
	register_post_type( 'storia', $args );

}
add_action( 'init', 'storia_post_type', 0 );

}


		//3.1.4- Register Schede
if ( ! function_exists('schede_post_type') ) {
// Child theme support
	
function schede_post_type() {

	$labels = array(
		'name'                  => _x( 'Schede', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Scheda', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Schede', 'text_domain' ),
		'name_admin_bar'        => __( 'Schede', 'text_domain' ),
		'archives'              => __( 'Archivio schede', 'text_domain' ),
		'attributes'            => __( 'Attributi delle schede', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Tutte le schede', 'text_domain' ),
		'add_new_item'          => __( 'Aggiungi nuova scheda', 'text_domain' ),
		'add_new'               => __( 'Aggiungi nuova', 'text_domain' ),
		'new_item'              => __( 'Nuova scheda', 'text_domain' ),
		'edit_item'             => __( 'Modifica scheda', 'text_domain' ),
		'update_item'           => __( 'Aggiorna scheda', 'text_domain' ),
		'view_item'             => __( 'Visualizza scheda', 'text_domain' ),
		'view_items'            => __( 'Visualizza schede', 'text_domain' ),
		'search_items'          => __( 'Cerca scheda', 'text_domain' ),
		'not_found'             => __( 'Non trovata', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trovata nel cestino', 'text_domain' ),
		'featured_image'        => __( 'Immagine in primo piano', 'text_domain' ),
		'set_featured_image'    => __( 'Imposta immagine in primo piano', 'text_domain' ),
		'remove_featured_image' => __( 'Togli immagine in primo piano', 'text_domain' ),
		'use_featured_image'    => __( 'Utilizza come immagine in primo piano', 'text_domain' ),
		'insert_into_item'      => __( 'Inserisci nella scheda', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Caricato nella scheda', 'text_domain' ),
		'items_list'            => __( 'Elenco delle schede', 'text_domain' ),
		'items_list_navigation' => __( 'Scorri l\'elenco delle schede', 'text_domain' ),
		'filter_items_list'     => __( 'Filtra l\'elenco delle schede', 'text_domain' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_scheda',
		'read_post'             => 'read_scheda',
		'delete_post'           => 'delete_scheda',
		
		'edit_posts'            => 'edit_schede',
		'edit_others_posts'     => 'edit_others_schede',
		'publish_posts'         => 'publish_schede',
		'read_private_posts'    => 'read_private_schede',
	);
	$args = array(
		'label'                 => __( 'Scheda', 'text_domain' ),
		'description'           => __( 'Raccolta di tutte le schede di progetto', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats', ),
		'taxonomies'            => array( 'tx_designers', ' tx_aziende', ' tx_storia' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
		'map_meta_cap'			=> true,
	);
	register_post_type( 'schede', $args );

}
add_action( 'init', 'schede_post_type', 0 );

}


		//3.1.5- Add capabilities to the admins
			#Reference: https://wordpress.stackexchange.com/questions/59719/wordpress-capability-type-arguments
function argano_custom_capabilities() {
	
	$roles = array( get_role('admin'), get_role('administrator') );
	
	foreach($roles as $role) {
		if($role) {
			// Designer capabilities
			$role->add_cap('edit_designer');
			$role->add_cap('read_designer');
			$role->add_cap('delete_designer');
			$role->add_cap('edit_designers');
			$role->add_cap('edit_others_designers');
			$role->add_cap('publish_designers');
			$role->add_cap('read_private_designers');
			// Aziende capabilities
			$role->add_cap('edit_azienda');
			$role->add_cap('read_azienda');
			$role->add_cap('delete_azienda');
			$role->add_cap('edit_aziende');
			$role->add_cap('edit_others_aziende');
			$role->add_cap('publish_aziende');
			$role->add_cap('read_private_aziende');
			// Storia capabilities
			$role->add_cap('edit_movimento_storico');
			$role->add_cap('read_movimento_storico');
			$role->add_cap('delete_movimento_storico');
			$role->add_cap('edit_movimenti_storici');
			$role->add_cap('edit_others_movimenti_storici');
			$role->add_cap('publish_movimenti_storici');
			$role->add_cap('read_private_movimenti_storici');
			// Schede capabilities
			$role->add_cap('edit_scheda');
			$role->add_cap('read_scheda');
			$role->add_cap('delete_scheda');
			$role->add_cap('edit_schede');
			$role->add_cap('edit_others_schede');
			$role->add_cap('publish_schede');
			$role->add_cap('read_private_schede');
		}	
		
	}		
}
add_action( 'after_setup_theme', 'argano_custom_capabilities' );



 	//3.2- Custom Taxonomies
		# Reference: https://generatewp.com/taxonomy/


		//3.2.1- Register tx_designer
if ( ! function_exists( 'tx_designer' ) ) {
// Child theme support

function tx_designer() {

	$labels = array(
		'name'                       => _x( 'Designer', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Designer', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_designer', 'text_domain' ),
		'all_items'                  => __( 'Tutti i designer', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'Nome del nuovo designer', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi un nuovo designer', 'text_domain' ),
		'edit_item'                  => __( 'Modifica designer', 'text_domain' ),
		'update_item'                => __( 'Aggiorna designer', 'text_domain' ),
		'view_item'                  => __( 'Visualizza designer', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa i nomi dei designer con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi designer', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra i più utilizzati', 'text_domain' ),
		'popular_items'              => __( 'Designer più visti', 'text_domain' ),
		'search_items'               => __( 'Cerca designer', 'text_domain' ),
		'not_found'                  => __( 'Non trovato', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono designers', 'text_domain' ),
		'items_list'                 => __( 'Elenco designer', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco dei designer', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-designer',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                    => $labels,
		'hierarchical'              => false,
		'public'					=> true,
		'show_ui'					=> true,
		'show_admin_column'			=> true,
		'show_in_nav_menus'			=> true,
		'show_tagcloud'				=> true,
		'rewrite'					=> $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_designer', array( 'schede', 'designer' ), $args );

}
add_action( 'init', 'tx_designer', 0 );

}


		//3.2.2- Register tx_aziende
if ( ! function_exists( 'tx_aziende' ) ) {
// Child theme support

function tx_aziende() {

	$labels = array(
		'name'                       => _x( 'Aziende', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Azienda', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_aziende', 'text_domain' ),
		'all_items'                  => __( 'Tutti le aziende', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'Nome della nuova azienda', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi una nuova azienda', 'text_domain' ),
		'edit_item'                  => __( 'Modifica azienda', 'text_domain' ),
		'update_item'                => __( 'Aggiorna azienda', 'text_domain' ),
		'view_item'                  => __( 'Visualizza azienda', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa i nomi delle aziende con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi le aziende', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra le più utilizzate', 'text_domain' ),
		'popular_items'              => __( 'Aziende più viste', 'text_domain' ),
		'search_items'               => __( 'Cerca aziende', 'text_domain' ),
		'not_found'                  => __( 'Non trovata', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono aziende', 'text_domain' ),
		'items_list'                 => __( 'Elenco aziende', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco delle aziende', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-aziende',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_aziende', array( 'schede', 'aziende' ), $args );

}
add_action( 'init', 'tx_aziende', 0 );

}


		//3.2.3- Register tx_storia
if ( ! function_exists( 'tx_storia' ) ) {
// Child theme support

function tx_storia() {

	$labels = array(
		'name'                       => _x( 'Movimenti storici', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Movimenti storici', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_storia', 'text_domain' ),
		'all_items'                  => __( 'Tutti i movimenti storici', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'Nome del nuovo movimento storico', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi un nuovo movimento storico', 'text_domain' ),
		'edit_item'                  => __( 'Modifica movimento storico', 'text_domain' ),
		'update_item'                => __( 'Aggiorna movimento storico', 'text_domain' ),
		'view_item'                  => __( 'Visualizza movimento storico', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa i nomi dei movimenti storici con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi movimenti storici', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra i più utilizzati', 'text_domain' ),
		'popular_items'              => __( 'Movimenti storici più visti', 'text_domain' ),
		'search_items'               => __( 'Cerca movimenti storici', 'text_domain' ),
		'not_found'                  => __( 'Non trovato', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono movimenti storici', 'text_domain' ),
		'items_list'                 => __( 'Elenco dei movimenti storici', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco degli movimenti storici', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-storia',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_storia', array( 'schede', 'storia' ), $args );

}
add_action( 'init', 'tx_storia', 0 );

}


		//3.2.4- Register tx_anni
if ( ! function_exists( 'tx_anni' ) ) {
// Child theme support

function tx_anni() {

	$labels = array(
		'name'                       => _x( 'Anni', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Anno', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_anni', 'text_domain' ),
		'all_items'                  => __( 'Tutti gli anni', 'text_domain' ),
		'parent_item'                => __( 'Decade', 'text_domain' ),
		'parent_item_colon'          => __( 'Decade:', 'text_domain' ),
		'new_item_name'              => __( 'Nome del nuovo anno', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi un nuovo anno', 'text_domain' ),
		'edit_item'                  => __( 'Modifica anno', 'text_domain' ),
		'update_item'                => __( 'Aggiorna anno', 'text_domain' ),
		'view_item'                  => __( 'Visualizza anno', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa gli anni con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi anni', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra i più utilizzati', 'text_domain' ),
		'popular_items'              => __( 'Anni più viste', 'text_domain' ),
		'search_items'               => __( 'Cerca anni', 'text_domain' ),
		'not_found'                  => __( 'Non trovato', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono anni', 'text_domain' ),
		'items_list'                 => __( 'Elenco anni', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco degli anni', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-anni',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_anni', array( 'schede' ), $args );

}
add_action( 'init', 'tx_anni', 0 );

}


		//3.2.5 Register tx_tipologie
if ( ! function_exists( 'tx_tipologie' ) ) {
// Child theme support

function tx_tipologie() {

	$labels = array(
		'name'                       => _x( 'Tipologie', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tipologia', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_tipologie', 'text_domain' ),
		'all_items'                  => __( 'Tutti le tipologie', 'text_domain' ),
		'parent_item'                => __( 'Tipologia madre', 'text_domain' ),
		'parent_item_colon'          => __( 'Tipologia madre:', 'text_domain' ),
		'new_item_name'              => __( 'Nome della nuova tipologia', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi nuova tipologia', 'text_domain' ),
		'edit_item'                  => __( 'Modifica tipologia', 'text_domain' ),
		'update_item'                => __( 'Aggiorna tipologia', 'text_domain' ),
		'view_item'                  => __( 'Visualizza tipologia', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa i nomi delle tipologie con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi tipologie', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra le più utilizzate', 'text_domain' ),
		'popular_items'              => __( 'Tipologie più viste', 'text_domain' ),
		'search_items'               => __( 'Cerca tipologie', 'text_domain' ),
		'not_found'                  => __( 'Non trovata', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono tipologie', 'text_domain' ),
		'items_list'                 => __( 'Elenco tipologie', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco delle tipologie', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-tipologie',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_tipologie', array( 'schede' ), $args );

}
add_action( 'init', 'tx_tipologie', 0 );

}


		//3.2.6- Register tx_materiali
if ( ! function_exists( 'tx_materiali' ) ) {
// Child theme support

function tx_materiali() {

	$labels = array(
		'name'                       => _x( 'Materiali', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Materiale', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'tx_materiali', 'text_domain' ),
		'all_items'                  => __( 'Tutti i materiali', 'text_domain' ),
		'parent_item'                => __( 'Materiale generico', 'text_domain' ),
		'parent_item_colon'          => __( 'Materiale generico:', 'text_domain' ),
		'new_item_name'              => __( 'Nome del nuovo materiale', 'text_domain' ),
		'add_new_item'               => __( 'Aggiungi nuovo materiale', 'text_domain' ),
		'edit_item'                  => __( 'Modifica materiale', 'text_domain' ),
		'update_item'                => __( 'Aggiorna materiale', 'text_domain' ),
		'view_item'                  => __( 'Visualizza materiale', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separa i nomi dei materiali con delle virgole', 'text_domain' ),
		'add_or_remove_items'        => __( 'Aggiungi o rimuovi materiali', 'text_domain' ),
		'choose_from_most_used'      => __( 'Scegli tra i più utilizzati', 'text_domain' ),
		'popular_items'              => __( 'Materiali più visti', 'text_domain' ),
		'search_items'               => __( 'Cerca materiali', 'text_domain' ),
		'not_found'                  => __( 'Non trovato', 'text_domain' ),
		'no_terms'                   => __( 'Non ci sono materiali', 'text_domain' ),
		'items_list'                 => __( 'Elenco materiali', 'text_domain' ),
		'items_list_navigation'      => __( 'Scorri l\'elenco delle materiali', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'tx-materiali',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'meta_box_cb'				=> "post_categories_meta_box",
	);
	register_taxonomy( 'tx_materiali', array( 'schede' ), $args );

}
add_action( 'init', 'tx_materiali', 0 );

}



	//3.3- Edit CPT and CT
		
		//3,3.1- Add name and surname metaboxes
/*
function designer_name_metaboxes() {
	add_meta_box( 'des_name', 'Nome', 'designer_name_content', 'designer', 'normal', 'high');
	add_meta_box( 'des_surname', 'Congnome', 'designer_surname_content', 'designer', 'normal', 'high');
 }
add_action( 'add_meta_boxes', 'designer_name_metaboxes');

function designer_name_content() {
	
	?>
    <input id='des_name_input' type="text" name='des_name_input' value=""/>
    <?php    
}
*/
#https://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336
#https://wordpress.stackexchange.com/questions/94364/set-post-title-from-two-meta-fields
//metabox
#https://wordpress.stackexchange.com/questions/144041/title-and-post-url-based-on-custom-fields
//save
//display?



/*
		//3.3.1- Edit designer fields and permalinks
function w2w_customers_set_title( $data , $postarr ) {

    if( $data[ 'post_type' ] === 'designer' ) {

        // get the customer name from _POST or from post_meta
        $customer_name = ( ! empty( $_POST[ 'customer_name' ] ) ) ? $_POST[ 'customer_name' ] : get_post_meta( $postarr[ 'ID' ], 'customer_name', true );

        // if the name is not empty, we want to set the title
        if( $customer_name !== '' ) {

            // sanitize name for title
            $data[ 'post_title' ] = $customer_name;
            // sanitize the name for the slug
            $data[ 'post_name' ]  = sanitize_title( sanitize_title_with_dashes( $customer_name, '', 'save' ) );
        }
    }
    return $data;
}
add_filter( 'wp_insert_post_data' , 'w2w_customers_set_title' , '99', 2 );
*/

//4- Workflow														------------------------------------------------ (4)
	//4.1- Define Capabilities
/**
 * Allow editing others pending posts only with "edit_pending_posts" capability.
 * Administrators can still edit those posts.
 *
 * @wp-hook user_has_cap
 * @param   array $allcaps All the capabilities of the user
 * @param   array $caps    [0] Required capability ('edit_others_posts')
 * @param   array $args    [0] Requested capability
 *                         [1] User ID
 *                         [2] Post ID
 * @return  array
 */



/*
function argano_filter_cap( $allcaps, $caps, $args )
	{
		// Not our capability
		if ( ( 'edit_post' !== $args[0] && 'delete_post' !== $args[0] )
			or empty ( $allcaps['edit_in-attesa_posts'] )
		)
			return $allcaps;

		$post = get_post( $args[2] );


		// Let users edit their own posts
		if ( (int) $args[1] === (int) $post->post_author
			and in_array(
				$post->post_status,
				array ( 'draft', 'al-revisore', 'auto-draft', 'al-redattore' )
			)
		)
		{
			$allcaps[ $caps[0] ] = TRUE;
		}
		elseif ( 'al-revisore' !== $post->post_status )
		{ // Not our post status
			$allcaps[ $caps[0] ] = FALSE;
		}
		
	}
add_filter( 'user_has_cap', 'argano_filter_cap', 10, 3 );
*/


	//4.2- Assign Capabilities <--! MISSING !--> (Edit Flow)



	//4.3- Customize Interface
		//4.3.1- Hide features to all but admin users
			// Most of the things
function hide_features_to_all_but_admin() {
	
	global $post;

    if (!current_user_can('update_core')) {
		
        	remove_action( 'admin_notices', 'update_nag', 3 ); // Hide update notification
				
		// Metabox bacheca
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );		// Right Now
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );	// Recent Comments
			remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );	// Incoming Links
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );			// Plugins
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );		// Quick Press
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );		// Recent Drafts
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );			// WordPress blog
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );			// Other WordPress News
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');			// Activity
			
		// Metabox CPT
			remove_meta_box( 'tagsdiv-tx_designer', 'designer', 'side' );	// tx_designer metabox
			remove_meta_box( 'tagsdiv-tx_aziende', 'aziende', 'side' );		// tx_aziende metabox
			remove_meta_box( 'tagsdiv-tx_storia', 'storia', 'side' );		// tx_storia metabox
		
			remove_meta_box( 'slugdiv', 'schede', 'normal' );			// slug metabox
			remove_meta_box( 'slugdiv', 'designer', 'normal' );			// slug metabox
			remove_meta_box( 'slugdiv', 'aziende', 'normal' );			// slug metabox
			remove_meta_box( 'slugdiv', 'storia', 'normal' );			// slug metabox
		
			remove_meta_box( 'revisioni_box', 'schede', 'advanced' );		// revisioni metabox
			remove_meta_box( 'revisioni_box', 'designer', 'advanced' );		// revisioni metabox
			remove_meta_box( 'revisioni_box', 'aziende', 'advanced' );		// revisioni metabox
			remove_meta_box( 'revisioni_box', 'storia', 'advanced' );		// revisioni metabox
		
			remove_meta_box( 'fonti_box', 'schede', 'advanced' );			// fonti metabox
			remove_meta_box( 'fonti_box', 'designer', 'advanced' );			// fonti metabox
			remove_meta_box( 'fonti_box', 'aziende', 'advanced' );			// fonti metabox
			remove_meta_box( 'fonti_box', 'storia', 'advanced' );			// fonti metabox
			
		// Voci del menu
			remove_menu_page( 'index.php' );					//Dashboard
			remove_menu_page( 'edit.php' );						//Posts
			remove_menu_page( 'upload.php' );					//Media
			remove_menu_page( 'edit.php?post_type=page' );		//Pages
			remove_menu_page( 'edit-comments.php' );			//Comments
			remove_menu_page( 'tools.php' );					//Tools
			remove_menu_page( 'profile.php' );					//Profile
			
		// Sottovoci del menu
			# Reference: https://stackoverflow.com/questions/7610702/wordpress-remove-submenu-from-custom-post-type
			global $submenu;
			unset(	$submenu['edit-tags.php?taxonomy=category'][15],	//Post -> Categorie				non porprio necessario perchè c'è style sotto
					$submenu['edit-tags.php?taxonomy=category'][16],	//Post -> Tag					non porprio necessario perchè c'è style sotto
					$submenu['edit.php?post_type=designer'][15],		//Designer -> tx_designer
					$submenu['edit.php?post_type=aziende'][15],			//Aziende -> tx_aziende
					$submenu['edit.php?post_type=storia'][15],			//Storia -> tx_storia
					$submenu['edit.php?post_type=schede'][15],			//Schede -> Tutte...
					$submenu['edit.php?post_type=schede'][16],
					$submenu['edit.php?post_type=schede'][17],
					$submenu['edit.php?post_type=schede'][18],	
					$submenu['edit.php?post_type=schede'][19],	
					$submenu['edit.php?post_type=schede'][20]
				 );
		
		// Via CSS
			?><style>
				#menu-posts,
				#edit-slug-box
				{display: none;}
			</style><?php
		
		//Media Button for Designer and Aziende CPT
		if (($post->post_type == 'designer' || $post->post_type == 'aziende' || $post->post_type == 'storia') && (current_user_can('edit_designers') || current_user_can('edit_aziende') ) ){
			remove_action( 'media_buttons', 'media_buttons' );
		}
		
		// Tab in alto a dx - Help e screen options
			get_current_screen()->remove_help_tabs();
			add_filter('screen_options_show_screen', '__return_false');

		// Remove quick edit from post and post-based CPT in edit.php
			function remove_quick_edit($actions, $post) {
						unset($actions['inline hide-if-no-js']);
						return $actions;
			}
			add_filter('post_row_actions', 'remove_quick_edit', 10, 2);
		
	}
}
add_action( 'admin_head', 'hide_features_to_all_but_admin', 1 );

			// Hide features to redattori and curatore
function hide_features_to_redattori_and_curatore() {
		$user = wp_get_current_user();
		if (in_array( 'redattore', (array) $user->roles ) || in_array( 'curatore', (array) $user->roles )) {
		
			remove_meta_box( 'revisionsdiv', 'schede', 'normal' );		// revisions metabox
			remove_meta_box( 'revisionsdiv', 'designer', 'normal' );	// revisions metabox
			remove_meta_box( 'revisionsdiv', 'aziende', 'normal' );		// revisions metabox
			remove_meta_box( 'revisionsdiv', 'storia', 'normal' );		// revisions metabox

					// Via CSS
			?><style>
				.misc-pub-revisions
				{display: none;}
			</style><?php
			
		}
}
add_action( 'admin_head', 'hide_features_to_redattori_and_curatore', 1 );

			// Hide features to curatore
function hide_features_to_curatore() {
		$user = wp_get_current_user();
		if (in_array( 'curatore', (array) $user->roles )) {
		
		// Via CSS
			?><style>
				.misc-pub-revisions,
				.misc-pub-curtime,
				.misc-pub-visibility
				{display: none;}
			</style><?php
			
		}
}
add_action( 'admin_head', 'hide_features_to_curatore', 1 );

			// Hide admin bar nodes to all but admin users
function edit_admin_bar( $wp_admin_bar ) {
	
	if (!current_user_can('update_core')) {
		
			$wp_admin_bar->remove_node( 'wp-logo' );
			$wp_admin_bar->remove_node( 'comments' );
			$wp_admin_bar->remove_node( 'new-post' );
			$wp_admin_bar->remove_node( 'new-page' );
			$wp_admin_bar->remove_node( 'new-media' );
	}
}
add_action( 'admin_bar_menu', 'edit_admin_bar', 999 );

			// Editing profile restriction
function remove_fields_from_edit_profile_page() {
	/*	Il commento è qui per non apparire nel css:
				Website as contact info
				Theme color picker
				Rich editing toggle
				Shortcut toggle
				Language
				First name
				Last name
				Nickname
				Display name
				Bio
	*/
    ?><style>	tr.user-url-wrap,
				tr.user-admin-color-wrap,
				tr.user-rich-editing-wrap,
				tr.user-comment-shortcuts-wrap,
				tr.user-language-wrap,
				tr.user-first-name-wrap,
				tr.user-last-name-wrap,
				tr.user-nickname-wrap,
				tr.user-display-name-wrap,
				tr.user-description-wrap
				{ display: none; }
	</style><?php
	
}
add_action( 'admin_head-user-edit.php', 'remove_fields_from_edit_profile_page' );
add_action( 'admin_head-profile.php',   'remove_fields_from_edit_profile_page' );


		//4.3.2- Edit Flow (plugin) customizations
			// Hide "Publish" button for certain custom statuses
function efx_hide_publish_button_until() {
 
    if ( ! function_exists( 'EditFlow' ) )
        return;
	
    if ( ! EditFlow()->custom_status->is_whitelisted_page() )
        return;
 
    // Show the publish button if the post has one of these statuses
    $show_publish_button_for_status = array(
			'al-curatore',
			// The statuses below are WordPress' public statuses
			'future',
			'publish',
			'schedule',
			'private',
        );
    if ( ! in_array( get_post_status(), $show_publish_button_for_status ) ) {
        ?>
        <style>
            #publishing-action { display: none; }
        </style>
        <?php
    }
}
add_action( 'admin_head', 'efx_hide_publish_button_until' );

			// Limit usable custom statuses based on user role
function efx_limit_custom_statuses_by_role( $custom_statuses ) {
 
	$current_user = wp_get_current_user();
	switch( $current_user->roles[0] ) {
		// Only allow a redattore_d, redattore_a or redattore to access specific statuses from the dropdown
		case 'redattore_d':
		case 'redattore_a':
		case 'redattore':
			$permitted_statuses = array(
					'al-redattore',
					'al-revisore',
			);
			// Remove the custom status if it's not whitelisted
			foreach( $custom_statuses as $key => $custom_status ) {
				if ( !in_array( $custom_status->slug, $permitted_statuses ) )
					unset( $custom_statuses[$key] );
			}
			break;
			
		// Only allow a revisore_d, revisore_a, revisore or curatore to access specific statuses from the dropdown
		case 'revisore_d':
		case 'revisore_a':
		case 'revisore':
		case 'curatore':
			$permitted_statuses = array(
					'al-redattore',
					'al-revisore',
					'al-curatore',
			);
			// Remove the custom status if it's not whitelisted
			foreach( $custom_statuses as $key => $custom_status ) {
				if ( !in_array( $custom_status->slug, $permitted_statuses ) )
					unset( $custom_statuses[$key] );
			}
			break;

    }
    return $custom_statuses;
}
add_filter( 'ef_custom_status_list', 'efx_limit_custom_statuses_by_role' );


		//4.3.3- Custom bubble notifications for different roles
function show_pending_number($menu) {

			// Revisore_d riceve notifiche post al-revisore
	if (current_user_can ('revisore_d')) {

		$types = array("post", "page", "designer", "storia", "schede");
		$status = "al-revisore";
		foreach($types as $type) {
			$num_posts = wp_count_posts($type, 'readable');
			$pending_count = 0;
			if (!empty($num_posts->$status)) $pending_count = $num_posts->$status;

			if ($type == 'post') {
				$menu_str = 'edit.php';
			} else {
				$menu_str = 'edit.php?post_type=' . $type;
			}

			foreach( $menu as $menu_key => $menu_data ) {
				if( $menu_str != $menu_data[2] )
					continue;
				$menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
				}
			}
	}

			// Revisore_a riceve notifiche post al-revisore
	if (current_user_can ('revisore_a')) {

		$types = array("post", "page", "aziende", "storia", "schede");
		$status = "al-revisore";
		foreach($types as $type) {
			$num_posts = wp_count_posts($type, 'readable');
			$pending_count = 0;
			if (!empty($num_posts->$status)) $pending_count = $num_posts->$status;

			if ($type == 'post') {
				$menu_str = 'edit.php';
			} else {
				$menu_str = 'edit.php?post_type=' . $type;
			}

			foreach( $menu as $menu_key => $menu_data ) {
				if( $menu_str != $menu_data[2] )
					continue;
				$menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
				}
			}
	}
	
				// Revisore riceve notifiche post al-revisore
	if (current_user_can ('revisore')) {

		$types = array("post", "page", "designer", "aziende", "storia", "schede");
		$status = "al-revisore";
		foreach($types as $type) {
			$num_posts = wp_count_posts($type, 'readable');
			$pending_count = 0;
			if (!empty($num_posts->$status)) $pending_count = $num_posts->$status;

			if ($type == 'post') {
				$menu_str = 'edit.php';
			} else {
				$menu_str = 'edit.php?post_type=' . $type;
			}

			foreach( $menu as $menu_key => $menu_data ) {
				if( $menu_str != $menu_data[2] )
					continue;
				$menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
				}
			}
	}

			// Curatore riceve notifiche post al-curatore
	if (current_user_can ('curatore')) {

		$types = array("post", "page", "designer", "aziende", "storia", "schede");
		$status = "al-curatore";
		foreach($types as $type) {
			$num_posts = wp_count_posts($type, 'readable');
			$pending_count = 0;
			if (!empty($num_posts->$status)) $pending_count = $num_posts->$status;

			if ($type == 'post') {
				$menu_str = 'edit.php';
			} else {
				$menu_str = 'edit.php?post_type=' . $type;
			}

			foreach( $menu as $menu_key => $menu_data ) {
				if( $menu_str != $menu_data[2] )
					continue;
				$menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
				}
			}
	}
	
	return $menu;
	
}
add_filter('add_menu_classes', 'show_pending_number');


		//4.3.4- Media Upload and metabox
			// Add a metabox to display attachments
/*
function argano_add_attach_thumbs_meta_box (){

add_meta_box ('att_thumb_display', 'Galleria della scheda','argano_render_attach_meta_box','schede');

}
add_action( 'add_meta_boxes', 'argano_add_attach_thumbs_meta_box' );

function argano_render_attach_meta_box( $post ) {
$output = '<p>ATTENZIONE: Questo box si aggiorna solo dopo aver salvato. Per aggiungere immagini fare riferimento al box laterale</p><hr>';
$args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_parent' => $post->ID
    );
    
     $images = get_posts( $args );
    foreach(  $images as $image) {
        $output .= '<img src="' . wp_get_attachment_thumb_url( $image->ID ) . '" />';
    }
  echo $output;
}
*/

		//4.3.5- Customize Anni taxononomy metabox
		#Reference: https://code.tutsplus.com/articles/how-to-use-radio-buttons-with-taxonomies--wp-24779
			// Replace default metabox with a custom one
function argano_remove_meta_box(){
	remove_meta_box('tx_annidiv', 'schede', 'side');
}
add_action( 'admin_menu', 'argano_remove_meta_box');

 function argano_add_meta_box() {
     add_meta_box( 'tx_anni_id', 'Seleziona l\'anno','argano_tx_anni_metabox','schede' ,'side','default');
 }
add_action( 'add_meta_boxes', 'argano_add_meta_box');

			// Define custom metbox for 'Anni' Taxonomy
function argano_tx_anni_metabox( $post ) {

    $taxonomy = 'tx_anni';
    $terms = get_terms($taxonomy,array('hide_empty' => 0));
    $name = 'tax_input[' . $taxonomy . ']';
 
    $postterms = get_the_terms( $post->ID,$taxonomy );
    $current = ($postterms ? array_pop($postterms) : false);
    $current = ($current ? $current->term_id : 0);
    ?>
 
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv" style='display:block'>
 
        <!-- Display taxonomy terms -->
        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php   foreach($terms as $term){
                    $id = $taxonomy.'-'.$term->term_id;
                    echo "<li id='$id'><label class='selectit'>";
                    echo "<input type='radio' id='in-$id' name='{$name}'".checked($current,$term->term_id,false)."value='$term->term_id' />$term->name<br />";
					echo "</label></li>";
                }?>
           </ul>
		</div>
    </div>

    	<!-- Display 'Unknown' checkbox -->
<!--
	<ul>
		<li>
			<label for="tx_anni-unknown-field" class="selectit">
				<input type="checkbox" id="tx_anni-unknown-field" name="anno_sconosciuto" value="1"/>Anno sconosciuto
			</label>
		</li>
	</ul>
-->
   
    <?php
}

			// Hide Parent categories in Anni metabox.
/*Modificare gli id del CSS dopo aver aggiunto i termini alla tassonomia anni*/
function argano_hide_cat(){
?>
    <style type="text/css">
        input#in-tx_anni-18, 
		input#in-tx_anni-27, 
		input#in-tx_anni-39,
		input#in-tx_anni-50,
		input#in-tx_anni-61,
		input#in-tx_anni-72,
		input#in-tx_anni-83,
		input#in-tx_anni-94,
		input#in-tx_anni-105,
		input#in-tx_anni-116,
		input#in-tx_anni-127,
		input#in-tx_anni-138,
		
		li#tx_anni-18,
		li#tx_anni-27,
		li#tx_anni-39,
		li#tx_anni-50,
		li#tx_anni-61,
		li#tx_anni-72,
		li#tx_anni-83,
		li#tx_anni-94,
		li#tx_anni-105,
		li#tx_anni-116,
		li#tx_anni-127,
		li#tx_anni-138
		{
            display:none !important;
        }
    </style>
<?php
}
add_action( 'add_meta_boxes', 'argano_hide_cat');

			// Check if user checked the 'Unknown' checkbox
/*
if checkbox checked
	hide #taxonmy-tx_anni
	deselect any term in the #taxonmy-tx_anni
	
else
	make taxonomy-tx_anni required to update post
*/

/*----------------------inea da togliere quando finito con anni metabox--------------------*/
		


		//4.3.6- Add 'Fonti' and 'Revisioni' metabox														Fonti box content deve essere modificato (più nidificazione per farlo più bellocon css)
		#Reference: https://wordpress.stackexchange.com/questions/23344/why-wont-my-metabox-data-save/
			// Fonti
			// Adds a box to the main column on the Post and Page edit screens
function argano_add_fonti_box() {
    add_meta_box(
        'fonti_box',
        __( 'Fonti', 'myplugin_textdomain' ),
        'fonti_box_content',
        array('schede', 'designer', 'aziende', 'storia'));
}
add_action( 'add_meta_boxes', 'argano_add_fonti_box' );

			// Prints the box content
function fonti_box_content() {
    global $post;
    			// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner">
    <?php

    			//get the saved meta as an array
    $fonti = get_post_meta($post->ID,'fonti',true);

    $c = 0;
    if ( count( $fonti ) > 0 ) {
        foreach((array) $fonti as $links ) {
            if ( isset( $links['title'] ) || isset( $links['link'] ) ) {
                printf( '<p>Fonte:	<input type="text" name="fonti[%1$s][title]" value="%2$s" />		Link alla fonte:	<input type="text" name="fonti[%1$s][link]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $links['title'], $links['link'], __( 'Elimina' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<span id="aggiungi-fonte-qui"></span>
<span class="add"><?php _e('+ Aggiungi Fonte'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add").click(function() {
            count = count + 1;

            $('#aggiungi-fonte-qui').append('<p> Fonte:	<input type="text" name="fonti['+count+'][title]" value="" />	Link alla fonte:	<input type="text" name="fonti['+count+'][link]" value="" /><span class="remove">Elimina</span></p>' );
            return false;
        });
        $(".remove").live('click', function() {
            $(this).parent().remove();
        });
    });
    </script>
</div><?php

}

			//When the post is saved, saves our custom data
function salva_fonti( $post_id ) {
				// verify if this is an auto save routine. 
				// If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

				// verify this came from the our screen and with proper authorization,
				// because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    			// OK, we're authenticated: we need to find and save the data

    $fonti = $_POST['fonti'];

    update_post_meta($post_id,'fonti',$fonti);
}
add_action( 'save_post', 'salva_fonti' );

			// Revisioni
			// Adds a box to the main column on the Post and Page edit screens
function argano_add_revisioni_box() {
    add_meta_box(
        'revisioni_box',
        __( 'Revisioni', 'myplugin_textdomain' ),
        'revisioni_box_content',
        array('schede', 'designer', 'aziende', 'storia'));
}
add_action( 'add_meta_boxes', 'argano_add_revisioni_box' );

			// Prints the box content
function revisioni_box_content() {
    global $post;
    			// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner_revisioni">
    <?php

    			//get the saved meta as an array
    $nome = get_post_meta($post->ID,'revisioni',true);

    $co = 0;
    if ( count( $nome ) > 0 ) {
        foreach((array) $nome as $anni ) {
            if ( isset( $anni['nome'] ) || isset( $anni['aa'] ) ) {
                printf( '<p>A.A.:<input type="text" name="revisioni[%1$s][aa]" value="%3$s" />Studente:<input type="text" name="revisioni[%1$s][nome]" value="%2$s" /><span class="remove">%4$s</span></p>', $co, $anni['nome'], $anni['aa'], __( 'Elimina' ) );
                $co = $co +1;
            }
        }
    }

    ?>
<span id="aggiungi-revisione-qui"></span>
<span class="add_revisione"><?php _e('+ Aggiungi Revisione'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $co; ?>;
        $(".add_revisione").click(function() {
            count = count + 1;

            $('#aggiungi-revisione-qui').append('<p>A.A.:<input type="text" name="revisioni['+count+'][aa]" value="" />Studente:<input type="text" name="revisioni['+count+'][nome]" value="" /><span class="remove">Elimina</span></p>' );
            return false;
        });
        $(".remove").live('click', function() {
            $(this).parent().remove();
        });
    });
    </script>
</div><?php

}

			//When the post is saved, saves our custom data
function salva_revisioni( $post_id ) {
				// verify if this is an auto save routine. 
				// If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

				// verify this came from the our screen and with proper authorization,
				// because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    			// OK, we're authenticated: we need to find and save the data

    $nome = $_POST['revisioni'];

    update_post_meta($post_id,'revisioni',$nome);
}
add_action( 'save_post', 'salva_revisioni' );


		//4.3.7- Hide 'parent box' for non hirerarchical custom tax metaboxes
		#Reference: https://gist.github.com/gschoppe/29ba81a1f676d7802cb8#file-cat-like-custom-taxonomy-php
function argano_hide_newcategory_parent_box() {
	?>
	<style type="text/css">
		#newtx_designer_parent, 
		#newtx_aziende_parent, 
		#newtx_storia_parent {
			display: none;
		}
	</style>
	<?php
}
add_action( 'admin_head-post.php',		'argano_hide_newcategory_parent_box');
add_action( 'admin_head-post-new.php',	'argano_hide_newcategory_parent_box');

function argano_category_add() {
	if( isset( $_POST['tax_input'] ) && is_array( $_POST['tax_input'] ) ) {
		$new_tax_input = array();
		foreach( $_POST['tax_input'] as $tax => $terms) {
			if( is_array( $terms ) ) {
			  $taxonomy = get_taxonomy( $tax );
			  if( !$taxonomy->hierarchical ) {
				  $terms = array_map( 'intval', array_filter( $terms ) );
			  }
			}
			$new_tax_input[$tax] = $terms;
		}
		$_POST['tax_input'] = $new_tax_input;
	}
}
add_action( 'admin_init', 'argano_category_add');




/*
			//Edit the media upload screen. Only show the attached images.
function only_show_post_attached_images( $query = array() ) {
		
		$include = array();
        $exclude = array();
        $temp_query = new WP_Query( $query );
        if ( $temp_query->have_posts() ) {
          while ( $temp_query->have_posts() ) {
            $temp_query->the_post();
			
			$current_post_id = $query;						// --- ATTENZIONE --- Così mostra tutti i media senza genitore. Deve mostrare quelli il cui genitore è il post in questione
			$parent_id = wp_get_post_parent_id( $post_ID );
            if ( $parent_id == $current_post_id ) {
				
				
              $include[] = get_the_ID();
            } else {
              $exclude[] = get_the_ID();
            }
          }
        }
        wp_reset_query();

        $query['post__in'] = $include;
        $query['post__not_in'] = $exclude;

        return $query;
	
}
add_filter( 'ajax_query_attachments_args', 'only_show_post_attached_images', 10, 1 );
*/



		//4.3.5- Email Notifications <--! MISSING !-->
			//Daily pending recap (da customizzare per i vari ruoli)

			//Post status changes (da customizzare per i vari ruoli)







//5- Frontend Interface customizations								------------------------------------------------ (5)
	// 5.1 - Galleries
		// 5.1.1 - Register size for the display of gallery images
add_image_size( 'argano-gallery-size', '400', '400', true );




//6- AJAX Load More
#Resources: https://rudrastyh.com/wordpress/load-more-posts-ajax.html

function argano_my_load_more_scripts() {
 
	global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
	/*wp_enqueue_script('jquery');*/

	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'argano_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
	wp_enqueue_script( 'my_loadmore' );
}
add_action( 'wp_enqueue_scripts', 'argano_my_load_more_scripts' );

function argano_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/schede/card-element' );
			// for the test purposes comment the line above and uncomment the below one
			//the_title();
 
 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'argano_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'argano_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}





























?>
