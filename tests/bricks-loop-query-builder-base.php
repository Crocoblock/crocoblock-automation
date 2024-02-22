<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class Bricks_Loop_Query_Builder_Base extends Lambda_Test {

	/**
	 * Name of the test to verbose results
	 * 
	 * @return [type] [description]
	 */
	public function test_name() {
		return 'Bricks Loop + Query Builder';
	}

	public function url() {
		return 'https://ld.crocoblock.com/qa-automation/bricks/brick-loop-query-builder/';
	}

	public function run() {

		$this->web_driver()->get( $this->get_url() );

		// Posts Query With Bricks tokens by Img and ID
		try {
			$posts_image = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop-tokens img' ) 
			);

			$image_src = ( $posts_image ) ? $posts_image->getAttribute( 'src' ) : false;

			if ( $image_src && false !== strpos( $image_src, 'https://ld.crocoblock.com/qa-automation/bricks/wp-content/uploads/' ) ) {
				$this->report_success( 'Posts Query by post IDs from meta field + Bricks Tokens, Image' );
			} else {
				$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, Image' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, Image' );
		}

		try {
			
			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop-tokens .brxe-heading' ) 
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
			} else {
				$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
		}

		// Bricks Query With Bricks tokens by Img and ID
		try {
			$posts_image = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-bricks-query-tokens img' ) 
			);

			$image_src = ( $posts_image ) ? $posts_image->getAttribute( 'src' ) : false;

			if ( $image_src && false !== strpos( $image_src, 'https://ld.crocoblock.com/qa-automation/bricks/wp-content/uploads/' ) ) {
				$this->report_success( 'Bricks Query by post IDs from meta field + Bricks Tokens, Image' );
			} else {
				$this->report_fail( 'Bricks Query by post IDs from meta field + Bricks Tokens, Image' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Bricks Query by post IDs from meta field + Bricks Tokens, Image' );
		}

		try {
			
			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-bricks-query-tokens .brxe-heading' ) 
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
			} else {
				$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query by post IDs from meta field + Bricks Tokens, ID' );
		}

		// Posts Query by Img and ID
		try {
			$posts_image = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop .brxe-jet-engine-listing-dynamic-image img' ) 
			);

			$image_src = ( $posts_image ) ? $posts_image->getAttribute( 'src' ) : false;

			if ( $image_src && false !== strpos( $image_src, 'https://ld.crocoblock.com/qa-automation/bricks/wp-content/uploads/' ) ) {
				$this->report_success( 'Posts Query, Image' );
			} else {
				$this->report_fail( 'Posts Query, Image' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query, Image' );
		}

		try {
			
			$post_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.posts-loop .jet-listing-dynamic-field .jet-listing-dynamic-field__content' ) 
			);

			if ( $post_id && preg_match( '/ID\#\d/', $post_id->getText() ) ) {
				$this->report_success( 'Posts Query, ID' );
			} else {
				$this->report_fail( 'Posts Query, ID' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'Posts Query, ID' );
		}

		// CCT Query by Img and Title
		try {
			$cct_image = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.cct-loop .brxe-jet-engine-listing-dynamic-image img' ) 
			);

			$image_src = ( $cct_image ) ? $cct_image->getAttribute( 'src' ) : false;

			if ( $image_src && false !== strpos( $image_src, 'https://ld.crocoblock.com/qa-automation/bricks/wp-content/uploads/' ) ) {
				$this->report_success( 'CCT Query, Image' );
			} else {
				$this->report_fail( 'CCT Query, Image' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'CCT Query, Image' );
		}

		try {
			$cct_title = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.cct-loop .jet-listing-dynamic-field .jet-listing-dynamic-field__content' ) 
			);

			if ( $cct_title && ( 'Item 5' === $cct_title->getText() ) ) {
				$this->report_success( 'CCT Query, Title' );
			} else {
				$this->report_fail( 'CCT Query, Title' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'CCT Query, Title' );
		}

		// WC Query by Img and ID and Price
		try {
			$wc_image = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.wc-loop .brxe-jet-engine-listing-dynamic-image img' ) 
			);

			$wc_image_class = ( $wc_image ) ? $wc_image->getAttribute( 'class' ) : false;

			if ( $wc_image_class && false !== strpos( $wc_image_class, 'jet-listing-dynamic-image__img' ) ) {
				$this->report_success( 'WC Query, Image' );
			} else {
				$this->report_fail( 'WC Query, Image' );
			}
		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'WC Query, Image' );
		}

		try {
			
			$wc_id = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.wc-loop .jet-listing-dynamic-field .jet-listing-dynamic-field__content' )
			);

			if ( $wc_id && preg_match( '/ID\#\d/', $wc_id->getText() ) ) {
				$this->report_success( 'WC Query, ID' );
			} else {
				$this->report_fail( 'WC Query, ID' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'WC Query, ID' );
		}

		try {
			
			$wc_price = $this->web_driver()->findElement( 
				WebDriverBy::cssSelector( '.wc-loop .wc-price .jet-listing-dynamic-field__content' )
			);

			if ( $wc_price && preg_match( '/\$\d/', $wc_price->getText() ) ) {
				$this->report_success( 'WC Query, Price' );
			} else {
				$this->report_fail( 'WC Query, Price' );
			}

		} catch ( \Facebook\WebDriver\Exception\NoSuchElementException $e ) {
			$this->report_fail( 'WC Query, Price' );
		}

	}

}
