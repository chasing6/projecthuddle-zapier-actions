<?php
namespace PH_Zapier_Actions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Init {
	public function __construct() {
		$this->load_hooks();
	}

	private function load_hooks() {
		add_action( 'ph_rest_project_approval', array( $this, 'send_approval_message' ), 1000, 3 );
		add_filter( 'project_huddle_settings_fields', array( $this, 'add_ph_settings' ) );
	}

	public function send_approval_message( $approval_term, $project, $value ) {

		$project_name = html_entity_decode( get_the_title( $project ) );
		$user         = wp_get_current_user();
		$approved_by  = $user->user_email;

		$payload = array(
			'channel'       => get_option( 'ph_approval_channel' ),
			'project_name'  => $project_name,
			'approved_by'   => $approved_by,
			'project_url'   => get_the_permalink( $project ),
			'approval_time' => current_time( 'm-d-Y g:iA' ),
		);

		$response = wp_remote_post(
			get_option( 'ph_za_approval_webhook' ),
			array(
				'body' => $payload,
			)
		);
	}

	public function add_ph_settings( $settings ) {
		$settings['zapier_actions'] = array(
			'title'  => 'Zapier Actions',
			'fields' => array(
				'za_approval_webhook' => array(
					'id'      => 'za_approval_webhook',
					'label'   => __( 'Zapier Approval Webhook URL', 'project-huddle' ),
					'type'    => 'text',
					'default' => get_option( 'ph_za_approval_webhook' ),
				),
			),
		);

		return $settings;
	}
}
