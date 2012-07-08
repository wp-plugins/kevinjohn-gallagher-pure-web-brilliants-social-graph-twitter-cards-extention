<?php
/*
	Plugin Name: 			Kevinjohn Gallagher: Pure Web Brilliant's Social Graph Twitter Cards Extention
	Description: 			Adds Twitter Card's Open Graph meta tags to your WordPress header
	Version: 				0.8
	Author: 				Kevinjohn Gallagher
	Author URI: 			http://kevinjohngallagher.com/
	
	Contributors:			kevinjohngallagher, purewebbrilliant 
	Donate link:			http://kevinjohngallagher.com/
	Tags: 					kevinjohn gallagher, pure web brilliant, framework, cms, facebook, opengraph, social, social media, twitter, twitter cards, google+
	Requires at least:		3.0
	Tested up to: 			3.4
	Stable tag: 			0.8
*/
/**
 *
 *	Kevinjohn Gallagher: Pure Web Brilliant's Social Graph Twitter Cards Extention
 * ==========================================================
 *
 *	Adds Twitter Card's Open Graph meta tags to your WordPress header
 *
 *
 *	This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 *	General Public License as published by the Free Software Foundation; either version 3 of the License, 
 *	or (at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 *	without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *	See the GNU General Public License (http://www.gnu.org/licenses/gpl-3.0.txt) for more details.
 *
 *	You should have received a copy of the GNU General Public License along with this program.  
 * 	If not, see http://www.gnu.org/licenses/ or http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 *	Copyright (C) 2008-2012 Kevinjohn Gallagher / http://www.kevinjohngallagher.com
 *
 *
 *	@package				Pure Web Brilliant
 *	@version 				0.8
 *	@author 				Kevinjohn Gallagher <wordpress@kevinjohngallagher.com>
 *	@copyright 				Copyright (c) 2012, Kevinjohn Gallagher
 *	@link 					http://kevinjohngallagher.com
 *	@license 				http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 */



 	if ( ! defined( 'ABSPATH' ) )
 	{ 
 			die( 'Direct access not permitted.' ); 
 	}
 	
 	
 	

	define( '_kevinjohn_gallagher___social_graph_twitter_extention', '0.8' );



	if (class_exists('kevinjohn_gallagher')) 
	{
		
		
		class	kevinjohn_gallagher___social_graph_twitter_extention 
		extends kevinjohn_gallagher
		{
		
				/*
				**
				**		VARIABLES
				**
				*/
				const PM		=	'_kevinjohn_gallagher___social_graph_twitter_extention';
				
				var					$instance;
				var 				$plugin_name;
				var					$uniqueID;
				var					$plugin_dir;
				var					$plugin_url;
				var					$plugin_page_title; 
				var					$plugin_menu_title; 					
				var 				$plugin_slug;
				var 				$http_or_https;
				var 				$plugin_options;
				
				var 				$meta_array;
				var 				$post_type;

				

		
				/*
				**
				**		CONSTRUCT
				**
				*/
				public	function	__construct() 
				{
						$this->instance 								=	&$this;
						$this->plugin_dir								=	plugin_dir_path(__FILE__);	
						$this->plugin_url								=	plugin_dir_url(__FILE__);				
						
						$this->plugin_name								=	"Kevinjohn Gallagher: Pure Web Brilliant's Social Graph Twitter extention";
						
						
						add_action( 'init',									array( $this, 'init' ) );
						add_action( 'init',									array( $this, 'init_child' ) );
					
												
				}
				

				
				
				
				/*
				**
				**		INIT_CHILD
				**
				*/
			
				public function init_child() 
				{

					
						add_filter( 	'kjg_pwb_hook_child_settings_sections__kevinjohn_gallagher___social_graph_control', 
										array(	
												$this, 
												'hook_into___kjg_pwb_hook_child_settings_sections__kevinjohn_gallagher___social_graph_control'
											), 	
										100, 	
										1
									);


						add_filter( 	'kjg_pwb_hook_child_settings_array__kevinjohn_gallagher___social_graph_control', 
										array(	
												$this, 
												'hook_into___kjg_pwb_hook_child_settings_array__kevinjohn_gallagher___social_graph_control'
											), 	
										100, 	
										1
									);



						add_filter( 	'kjg_pwb_hook_social_graph_data_get___kevinjohn_gallagher___social_graph_control', 
										array(	
												$this, 
												'hook_into___kjg_pwb_hook_social_graph_data_get___kevinjohn_gallagher___social_graph_control'
											), 	
										100, 	
										2
									);					


						add_filter( 	'kjg_pwb_hook_social_graph_data_set___kevinjohn_gallagher___social_graph_control', 
										array(	
												$this, 
												'hook_into___kjg_pwb_hook_social_graph_data_set___kevinjohn_gallagher___social_graph_control'
											), 	
										100, 	
										2
									);	
									
	

						add_filter(		'user_contactmethods',						array( 	&$this, 	'modernise_contacts'), 				100, 	1);
				}
				
				

						


				public 	function 	hook_into___kjg_pwb_hook_child_settings_sections__kevinjohn_gallagher___social_graph_control($args)
				{
						$this->child_settings_sections['section_tw']			= ' Twitter: ';
						
						$args 													= 	array_merge($args, $this->child_settings_sections);
						
						return $args;					
				}


				

				public 	function 	hook_into___kjg_pwb_hook_child_settings_array__kevinjohn_gallagher___social_graph_control($args)
				{
				
						$this->child_settings_array['twitter_site_name'] 	= array(
																				'id'      		=> 'twitter_site_name',
																				'title'   		=> 'Twitter site username:',
																				'description'	=> 'e.g. @KevinjohnG is the name for "KevinjohnGallagher.com" ',
																				'type'    		=> 'text',
																				'section' 		=> 'section_tw',
																				'choices' 		=> array(																	
																									),
																				'class'   		=> ''
																			);


						$this->child_settings_array['twitter_site_id'] 	= array(
																				'id'      		=> 'twitter_site_id',
																				'title'   		=> 'Twitter site id:',
																				'description'	=> 'Note that user ids never change, while @usernames can be changed by the user. ',
																				'type'    		=> 'text',
																				'section' 		=> 'section_tw',
																				'choices' 		=> array(																	
																									),
																				'class'   		=> ''
																			);
						
						$args 		= 	array_merge($args, $this->child_settings_array);
						
						
						return $args;
					
				}				

				
				


				
				
				
				

				
				/**
				 *		Adds the Open Graph Schema to the Language attributes.
				 *		 
				 * 		@args  		array 		passed args by WP function
				 * 		@return		array
				 */
				public 	function 	modernise_contacts($contact_option)
				{
					//	print_r( $contact_option );

						if ( !isset( $contact_option['twitter'] ) )
						{
									$contact_option['twitter'] 			=	'Twitter';
						}

						if ( !isset( $contact_option['twitter_id'] ) )
						{
									$contact_option['twitter_id'] 		=	'Twitter ID:';
						}		
						
					
						return 		$contact_option;
				}





				
				
				
				
				/**
				 *		Defines type for twitter card.
				 *		 
				 * 		@param  	object	$post
				 * 		@return		string
				 */
				public	function	define_tw_type( $post, $parent )
				{
				
						global 	$post;
						
						
						if ( is_single() ) 
						{
								
								if( $post->post_type == "image" 	|| 	$post->post_type == "gallery"  )
								{
										$this->tw_type 			= 	'photo';
									
									
								} 	elseif( $post->post_type == "video" || 	$post->post_type == "audio" ) 	{
								
										$this->tw_type 			= 	'player';
																			
								}	else {
									
										$this->tw_type 		= 	'summary';										
								}
																
								
						} else {

								$this->tw_type 			= 	'summary';		
						}
						
						
						$parent->tw_type 			= 	esc_attr( $this->tw_type ) ;
						
						
						return		$parent->tw_type;					
				}




				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 
				public 		function 	is_numeric_or_empty($username)
				{
						if( !empty( $username ))
						{
							if( !is_numeric( $username) )
							{
									$username		=	'';
							}
						}
						
						return  $username;
				}
				







				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 
				public 		function 	ensure_twitter_at_symbol($username)
				{
						if( !empty( $username ))
						{
							if( strpos( $username, '@' ) === false )
							{
									$username		=	'@'. $username;
							}
						}
						
						return  $username;
				}
				
				
				
				
				


				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 
				public 		function  	define_page_twitter_site( $post, $parent )
				{
						$this->site_twitter					=		esc_attr( $parent->plugin_options['twitter_site_name'] );
						$this->site_twitter_id				=		esc_attr( $parent->plugin_options['twitter_site_id'] );
						
						$parent->site_twitter				=		$this->ensure_twitter_at_symbol( $this->site_twitter );
						$parent->site_twitter_id			=		$this->is_numeric_or_empty( $this->site_twitter_id );
						
				}
				





				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 
				public 		function  	define_page_twitter_creator( $post, $parent )
				{
						if( is_single() )
						{				
								$this->creator_twitter				=		esc_attr( get_the_author_meta( 'twitter',		 	$post->post_author ) );
								$this->creator_twitter_id			=		esc_attr( get_the_author_meta( 'twitter_id', 		$post->post_author ) );
								
								$parent->creator_twitter			=		$this->ensure_twitter_at_symbol( $this->creator_twitter );
								$parent->creator_twitter_id			=		$this->is_numeric_or_empty( $this->creator_twitter_id );
						}					
				}

				



				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 				
				public 		function  	define_page_twitter_cards( $post, $parent )
				{
						$this->define_tw_type( $post, $parent );
						$this->define_page_twitter_creator( $post, $parent );
						$this->define_page_twitter_site( $post, $parent );
				}				
				



				/**
				 *		
				 *		 
				 * 		
				 * 		
				 */
				 				
				public 		function  	set_page_twitter_cards( $post, $parent )
				{
						
						$parent->add_meta_data_full('twitter:card', 					$parent->tw_type, 					'name', 		'value' );
						$parent->add_meta_data_full('twitter:title', 					$parent->og_title, 					'name', 		'value' );
						$parent->add_meta_data_full('twitter:description', 				$parent->og_description, 			'name', 		'value' );
						$parent->add_meta_data_full('twitter:url', 						$parent->og_url, 					'name', 		'value' );

						$parent->add_meta_data_full('twitter:site', 					$parent->site_twitter, 				'name', 		'value' );
						$parent->add_meta_data_full('twitter:site:id', 					$parent->site_twitter_id, 			'name', 		'value' );	
						
						$parent->add_meta_data_full('twitter:creator', 					$parent->creator_twitter, 			'name', 		'value' );
						$parent->add_meta_data_full('twitter:creator:id', 				$parent->creator_twitter_id, 		'name', 		'value' );	
						
						
						//
						//	This really should be in its own funciton, as it requires a minimum image size.
						//
						$parent->add_meta_data_full('twitter:image', 					$parent->page_featured_image, 		'name', 		'value' );
										
				}					
				
				
				
				
				/**
				 *		Adds Open graph data to the HEAD.
				 *		 
				 * 		@param  	string $image_html
				 * 		@return		string
				 */
				public 	function 	hook_into___kjg_pwb_hook_social_graph_data_get___kevinjohn_gallagher___social_graph_control( $parent, $post )
				{
					
						$this->define_page_twitter_cards( $post, $parent );
				}



				public 	function 	hook_into___kjg_pwb_hook_social_graph_data_set___kevinjohn_gallagher___social_graph_control( $parent, $post )
				{
					
						$this->set_page_twitter_cards( $post, $parent );
						
				}

				
				
		
		}	//	class
		
	
		$kevinjohn_gallagher___social_graph_twitter_extention			=	new kevinjohn_gallagher___social_graph_twitter_extention();
		
	
	} else {
	

			function kevinjohn_gallagher___social_graph_twitter_extention___parent_needed()
			{
					echo	"<div id='message' class='error'>";
					
					echo	"<p>";
					echo	"<strong>Kevinjohn Gallagher: Social Graph Twitter extension</strong> ";	
					echo	"requires the parent framework to be installed and activated";
					echo	"</p>";
			} 

			add_action('admin_footer', 'kevinjohn_gallagher___social_graph_twitter_extention___parent_needed');	
	
	}

