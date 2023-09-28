<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;

if ( ! file_exists( 'config.json' ) ) {
	die( 'Create config.json before running tests' );
}

$config = json_decode( file_get_contents( 'config.json' ) );

if ( ! isset( $config->username ) || ! isset( $config->access_key ) ) {
	die( 'config.json should contain valid username and access_key properties' );
}

define( 'FILTER_RESPONSE_TIME', isset( $config->response_time ) ? $config->response_time : 3 );

class Dispatch_Tests {

	private $cases = [];
	private $base_dir = null;
	private $config = [];

	public function __construct( $config = null ) {

		$this->config = $config;
		$this->base_dir = rtrim( __DIR__, '/' ) . '/';

		require_once $this->base_dir . 'lambda-test.php';

		$this->load_cases();
		$this->run_cases();

	}

	public function get_config( $key ) {
		return isset( $this->config->$key ) ? $this->config->$key : null;
	}

	public function load_cases() {

		foreach ( glob( $this->base_dir . 'tests/*.php' ) as $filename ) {
			require_once $filename;
			$class_name = basename( $filename, '.php' );
			$this->cases[] = str_replace( ' ', '_', ucwords( str_replace( '-', ' ' , $class_name ) ) );
		}

	}

	public function run_cases( $allowed_cases = [] ) {

		$this->get_config( 'username' );
		$this->get_config( 'access_key' );

		$url = sprintf(
			'https://%1$s:%2$s@hub.lambdatest.com/wd/hub',
			$this->get_config( 'username' ),
			$this->get_config( 'access_key' )
		);

		$desired_capabilities = new DesiredCapabilities( [
			"browserName" => "Chrome",
			"browserVersion" => "118.0",
			"LT:Options" => array(
				"username" => $this->get_config( 'username' ),
				"accessKey" => $this->get_config( 'access_key' ),
				"platformName" => "Windows 10",
				"project" => "JetEngine",
				"w3c" => true,
				"plugin" => "php-php",
				"video" => true,
			)
		] );

		foreach ( $this->cases as $case ) {
			if ( class_exists( $case ) ) {
				if ( empty( $allowed_cases ) || in_array( $case, $allowed_cases ) ) {
					$test = new $case( $url, $desired_capabilities );
					$test->run();
				}
			}
		}

		// Instantiate base test to close testing session
		// All test uses the same instance of webdriver, so it's finalize them all
		$base_test = new Lambda_Test();
		$base_test->web_driver()->quit();

	}

}

new Dispatch_Tests( $config );
