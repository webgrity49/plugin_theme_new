<?php
defined( 'ABSPATH' ) || die();

/* Search and filters */
$filter             = '';
$filter_items_count = 0;
if ( ( isset( $nonce_verified ) || ( isset( $_POST['apply-filter'] ) && wp_verify_nonce( $_POST['apply-filter'], 'apply-filter' ) ) ) && isset( $_POST['search_key'] ) && isset( $_POST['search_value'] ) ) {
	$filter_items_count = is_array( $_POST['search_key'] ) ? count( $_POST['search_key'] ) : 0;
	if ( $filter_items_count ) {
		$filter .= ' WHERE ';
		foreach ( $_POST['search_key'] as $key => $value ) {
			$search_field = sanitize_text_field( $value );
			$search_value = isset( $_POST['search_value'][ $key ] ) ? sanitize_text_field( $_POST['search_value'][ $key ] ) : '';

			if ( 'subject' === $search_field ) {
				if ( isset( $filter_subject_exist ) ) {
					$filter_subject .= $wpdb->prepare( ' OR subject LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
				} else {
					$filter_subject       = $wpdb->prepare( 'subject LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
					$filter_subject_exist = true;
				}
			} elseif ( 'name' === $search_field ) {
				if ( isset( $filter_name_exist ) ) {
					$filter_name .= $wpdb->prepare( ' OR name LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
				} else {
					$filter_name       = $wpdb->prepare( 'name LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
					$filter_name_exist = true;
				}
			} elseif ( 'email' === $search_field ) {
				if ( isset( $filter_email_exist ) ) {
					$filter_email .= $wpdb->prepare( ' OR email LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
				} else {
					$filter_email       = $wpdb->prepare( 'email LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
					$filter_email_exist = true;
				}
			} elseif ( 'message' === $search_field ) {
				if ( isset( $filter_message_exist ) ) {
					$filter_message .= $wpdb->prepare( ' OR message LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
				} else {
					$filter_message       = $wpdb->prepare( 'message LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
					$filter_message_exist = true;
				}
			} elseif ( 'answered' === $search_field ) {
				if ( preg_match( '/^y/', strtolower( $search_value ) ) ) {
					$search_value = 1;
				} else {
					$search_value = 0;
				}

				if ( isset( $filter_answered_exist ) ) {
					$filter_answered .= $wpdb->prepare( ' OR answered = %d', $search_value );
				} else {
					$filter_answered       = $wpdb->prepare( 'answered = %d', $search_value );
					$filter_answered_exist = true;
				}
			} elseif ( 'note' === $search_field ) {
				if ( isset( $filter_note_exist ) ) {
					$filter_note .= $wpdb->prepare( ' OR note LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
				} else {
					$filter_note       = $wpdb->prepare( 'note LIKE %s', ( '%' . $wpdb->esc_like( $search_value ) . '%' ) );
					$filter_note_exist = true;
				}
			}
		}

		$filter_queries = array();
		if ( isset( $filter_subject ) ) {
			array_push( $filter_queries, $filter_subject );
		}
		if ( isset( $filter_name ) ) {
			array_push( $filter_queries, $filter_name );
		}
		if ( isset( $filter_email ) ) {
			array_push( $filter_queries, $filter_email );
		}
		if ( isset( $filter_message ) ) {
			array_push( $filter_queries, $filter_message );
		}
		if ( isset( $filter_answered ) ) {
			array_push( $filter_queries, $filter_answered );
		}
		if ( isset( $filter_note ) ) {
			array_push( $filter_queries, $filter_note );
		}

		$filter .= implode( 'AND', array_map( function( $filter_query_string ) { return " ($filter_query_string) "; }, $filter_queries ) );
	}
}
/* End search and filters */

$query          = "SELECT ID, subject, message, name, email, answered, created_at FROM {$wpdb->prefix}stcfq_queries$filter";
$total_query    = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total          = $wpdb->get_var( $total_query );
$items_per_page = 25;
$offset         = ( $current_page * $items_per_page ) - $items_per_page;
$messages       = $wpdb->get_results( $query . " ORDER BY ID DESC LIMIT ${offset}, ${items_per_page}" );
$total_pages    = ceil( $total / $items_per_page );
