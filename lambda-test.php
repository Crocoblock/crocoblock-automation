<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class Lambda_Test {

	protected static $driver = null;

	protected $url;
	protected $desired_capabilities;

	public function __construct( $url = '', $desired_capabilities = [] ) {

		if ( ! $url ) {
			return;
		}

		echo 'Running: ' . $this->test_name() . PHP_EOL;

		$this->url = $url;

		if ( ! $desired_capabilities ) {
			$this->desired_capabilities = $desired_capabilities;
		} else {
			$options = new ChromeOptions();
			$options->addArguments( ['--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36'] );

			$capabilities = DesiredCapabilities::chrome();
			$capabilities->setCapability( ChromeOptions::CAPABILITY, $options );

			$this->desired_capabilities = $capabilities;
		}
	}

	public function web_driver() {
		
		if ( null === self::$driver ) {
			self::$driver = RemoteWebDriver::create( $this->url, $this->desired_capabilities );;
		}

		return self::$driver;
	}

	/**
	 * Name of the test to verbose results
	 * 
	 * @return [type] [description]
	 */
	public function test_name() {
		return 'Sampte Test Name. Override it in your test case to view correct info';
	}

	public function url() {
		return 'https://ld.crocoblock.com/qa-automation/bricks/sample-page/';
	}

	public function get_url() {
		return $this->url() . '?' . time();
	}

	public function report( $sub_test = '', $report = '' ) {

		if ( $sub_test ) {
			$sub_test = '/' . $sub_test;
		}

		echo $this->test_name() . $sub_test . $report . PHP_EOL;

	}

	public function report_success( $sub_test = '' ) {
		$this->report( $sub_test, ": \033[32m✓ Success!\033[0m" );
	}

	public function report_fail( $sub_test = '' ) {

		if ( $sub_test ) {
			$sub_test .= ', ';
		}

		$sub_test .= $this->url();

		$this->report( $sub_test, ": \033[31m ✖ Fail!\033[0m" );
	}

	// Basic example
	public function run() {

		$this->web_driver()->get( $this->get_url() );

		$element1 = $this->web_driver()->findElement( WebDriverBy::cssSelector( '.test-case' ) );

		if ( 'Hello world' == $element1->getText() ) {
			$this->report_success();
		} else {
			$this->report_fail();
		}

	}

}
