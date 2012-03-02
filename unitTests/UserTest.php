<?php
use de\zweiradspion\User;

function autoload($className){
    $fileName = dirname(__FILE__) . '/../includes/' . str_replace('\\', '/', $className) . '.php';
    #echo "load Class: $className<br>";
    require $fileName;
}
include 'Assert.php';
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
            spl_autoload_register('autoload');
            $this->user = new User();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function testClass() {
        $post = array(
            'uid' => 2,
            'hash' => '5d0f965ba01c7fe26b6fd1f1c68c2b1f',
            'password' => '917a34072663f9c8beea3b45e8f129c5',
            'email' => 'oliver.christ@web.de',
            'postcode' => '65232',
            'city' => 'Seitzenhahn',
            'lat' => '50.1250784',
            'lng' => '8.11974639999994',
            'datenschutz' => 1,
            'agb' => 1,
            'erstellt' => '0000-00-00 00:00:00',
            'geaendert' => '0000-00-00 00:00:00'
        );
        $this->user->loadFromPost($post);
        $this->assertEquals('oliver.christ@web.de', $this->user->getEmail());
    }

}

?>
