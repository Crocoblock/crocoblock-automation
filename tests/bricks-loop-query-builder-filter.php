<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Bricks_Loop_Query_Builder_Filter extends Lambda_Test {

	/**
	 * Name of the test to verbose results
	 * 
	 * @return [type] [description]
	 */
	public function test_name() {
		return 'Bricks Loop + Query Builder + Filtering';
	}

	public function url() {
		return 'https://ld.crocoblock.com/qa-automation/bricks/brick-loop-query-builder-filter/';
	}

	public function run() {

		$initial_url = $this->get_url();

		$this->web_driver()->get( $initial_url );

		// Filtered Posts Query by Post ID
		try {

			$filter = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '.select-filter-posts option[value="26"]' )
			);
			
			$filter->click();

			sleep( FILTER_RESPONSE_TIME );

			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop .jet-listing-dynamic-field .jet-listing-dynamic-field__content' )
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'Posts Query, AJAX, ID after filtration' );
			} else {
				$this->report_fail( 'Posts Query, AJAX, ID after filtration' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query, AJAX, ID after filtration' );
		}

		// Is correct indexer after filtering
		try {

			$indexed_option = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '.select-filter-posts option[value="26"]' )
			);

			$indexed_option_text = $indexed_option->getText();

			preg_match( '/.*\((\d+)\)/', $indexed_option_text, $matches );

			if ( ! empty( $matches[1] ) && 0 < intval( $matches[1] ) ) {
				$this->report_success( 'Posts Query, AJAX, Indexer Counter after filtering' );
			} else {
				$this->report_fail( 'Posts Query, AJAX, Indexer Counter after filtering' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query, AJAX, Indexer Counter after filtering' );
		}

		// Reset filter
		try {

			$remove_filters = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '.remove-filters button' )
			);

			$remove_filters->click();

			sleep( FILTER_RESPONSE_TIME );

			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop .jet-listing-dynamic-field .jet-listing-dynamic-field__content' )
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'Posts Query, AJAX, Remove Filters' );
			} else {
				$this->report_fail( 'Posts Query, AJAX, Remove Filters' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query, AJAX, Remove Filters' );
		}

		// WC Query + Filtering
		try {

			$filter = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '#wc-query-filter input[value="20"]' )
			);

			$filter_label = $filter->findElement( WebDriverBy::xpath( '..' ) );

			$filter_label->click();

			$button = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '#wc-query-filter .apply-filters__button' )
			);

			$button->click();

			// Wait for the page to load completely by waiting for elementA to be present in DOM.
			$this->web_driver()->wait()->until(
				WebDriverExpectedCondition::urlContains( 'jsf=jet-engine:wc-query-listing' )
			);

			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '#wc-query-listing .jet-listing-dynamic-field .jet-listing-dynamic-field__content' )
			);

			if ( $post_id && 'ID#129' === $post_id->getText() ) {
				$this->report_success( 'WC Query, Mixed, ID after filtration' );
			} else {
				$this->report_fail( 'WC Query, Mixed, ID after filtration' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'WC Query, Mixed, ID after filtration' );
		}

		// URL match for mixed filters after reload
		if ( WebDriverExpectedCondition::urlContains( 'bricks-query-loop:wc-query-listing' ) ) {
			$this->report_success( 'WC Query, Mixed, Change URL filtration' );
		} else {
			$this->report_fail( 'WC Query, Mixed, Change URL filtration' );
		}

		// Reset filter
		try {

			$remove_filters = $this->web_driver()->findElement(
				WebDriverBy::cssSelector( '#wc-remove-filter button' )
			);

			$remove_filters->click();

			$this->web_driver()->wait()->until(
				WebDriverExpectedCondition::urlIs( $initial_url )
			);

			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '#wc-query-listing .jet-listing-dynamic-field .jet-listing-dynamic-field__content' )
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'WC Query, Mixed, Remove Filters' );
			} else {
				$this->report_fail( 'WC Query, Mixed, Remove Filters' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'WC Query, Mixed, Remove Filters' );
		}

		// Change URL after reset filter
		if ( WebDriverExpectedCondition::urlIs( $initial_url ) ) {
			$this->report_success( 'WC Query, Mixed, Reset URL' );
		} else {
			$this->report_fail( 'WC Query, Mixed, Reset URL' );
		}

	}

}
