<?php
/**
 * Tests for the Google Ads Console plugin.
 *
 * @package Google Ad Console
 * @author Steve Grunwell
 */

use WP_Mock as M;

class AdConsoleTest extends TestCase {

	public function test_googleadconsole_add_node() {
		$args     = array(
			'id'    => '',
			'title' => 'Google Ad Console',
			'href'  => 'http://example.com?console',
		);
		$expected = array(
			'id'    => 'google-ad-console-toggle',
			'title' => 'Google Ad Console',
			'href'  => 'http://example.com?console',
		);

		$admin_bar = Mockery::mock( 'WP_Admin_Bar' );
		$admin_bar->shouldReceive( 'add_node' )
			->once()
			->with( $expected );

		M::wpFunction( 'is_admin', array(
			'times'  => 1,
			'return' => false,
		) );

		M::wpFunction( 'googleadconsole_toggle_console_url', array(
			'times'  => 1,
			'return' => 'http://example.com?console',
		) );

		M::wpPassthruFunction( 'esc_html__' );
		M::wpPassthruFunction( 'esc_url' );

		M::onFilter( 'googleadconsole_before_add_node' )
			->with( $args )
			->reply( array_merge( $args, array( 'id' => 'google-ad-console-toggle' ) ) );

		googleadconsole_add_node( $admin_bar );
	}

	public function test_googleadconsole_add_node_returns_early_in_admin() {
		M::wpFunction( 'is_admin', array(
			'times'  => 1,
			'return' => true,
		) );

		M::wpFunction( 'googleadconsole_toggle_console_url', array(
			'times'  => 0,
		) );

		googleadconsole_add_node( new stdClass );
	}

	public function test_googleadconsole_register_query_var() {
		$this->assertContains(
			'google_force_console',
			googleadconsole_register_query_var( array() )
		);
	}

	public function test_googleadconsole_toggle_console_url() {
		M::wpFunction( 'get_query_var', array(
			'times'  => 1,
			'args'   => array( 'google_force_console', false ),
			'return' => false,
		) );

		M::wpFunction( 'add_query_arg', array(
			'times'  => 1,
			'args'   => array( 'google_force_console', true ),
			'return' => 'http://example.com?google_force_console',
		) );

		$this->assertEquals(
			'http://example.com?google_force_console',
			googleadconsole_toggle_console_url()
		);
	}

	public function test_googleadconsole_toggle_console_url_removes_query_arg() {
		M::wpFunction( 'get_query_var', array(
			'times'  => 1,
			'args'   => array( 'google_force_console', false ),
			'return' => true,
		) );

		M::wpFunction( 'add_query_arg', array(
			'times'  => 1,
			'args'   => array( 'google_force_console', false ),
			'return' => 'http://example.com',
		) );

		$this->assertEquals(
			'http://example.com',
			googleadconsole_toggle_console_url()
		);
	}

}