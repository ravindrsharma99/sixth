<?php

birch_ns( 'birchschedule.model.cpt.staff', function( $ns ) {

		global $birchschedule;

		birch_defn( $ns, 'init', function() use ( $ns, $birchschedule ) {

				birch_defmethod( $birchschedule->model, 'pre_save', 'birs_staff', $ns->pre_save );
				birch_defmethod( $birchschedule->model, 'post_get', 'birs_staff', $ns->post_get );
			} );

		birch_defn( $ns, 'pre_save', function( $staff, $config ) {
				birch_assert( is_array( $staff ) && isset( $staff['post_type'] ) );

				if ( isset( $staff['_birs_assigned_services'] ) ) {
					$staff['_birs_assigned_services'] =
					serialize( $staff['_birs_assigned_services'] );
				}

				if ( isset( $staff['_birs_staff_schedule'] ) ) {
					$staff['_birs_staff_schedule'] =
					serialize( $staff['_birs_staff_schedule'] );
				}
				return $staff;
			} );

		birch_defn( $ns, 'post_get', function( $staff ) {
				birch_assert( is_array( $staff ) && isset( $staff['post_type'] ) );
				if ( isset( $staff['post_title'] ) ) {
					$staff['_birs_staff_name'] = $staff['post_title'];
				}
				if ( isset( $staff['_birs_assigned_services'] ) ) {
					$assigned_services = $staff['_birs_assigned_services'];
					$assigned_services = unserialize( $assigned_services );
					$assigned_services = $assigned_services ? $assigned_services : array();
					$staff['_birs_assigned_services'] = $assigned_services;
				}
				if ( isset( $staff['_birs_staff_schedule'] ) ) {
					$schedule = $staff['_birs_staff_schedule'];
					if ( !isset( $schedule ) ) {
						$schedule = array();
					} else {
						$schedule = unserialize( $schedule );
					}
					$schedule = $schedule ? $schedule : array();
					$staff['_birs_staff_schedule'] = $schedule;
				}
				if ( isset( $staff['post_content'] ) ) {
					$staff['_birs_staff_description'] = $staff['post_content'];
				}
				return $staff;
			} );

	} );
