<?php

require_once dirname(__FILE__) . '/../includes/de/zweiradspion/User.php';

/**
 * Test class for User.
 * Generated by PHPUnit on 2012-01-03 at 16:31:37.
 */
class UserTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Anagrams
	 */
	protected $user;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
        echo 'foo';
		$this->user = new User();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

    public function testClass() {
		$this->assertInstanceOf('User', $this->user);
	}

}

?>