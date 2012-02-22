<?php
namespace de\zweiradspion;

/**
 * Das Rad
 *
 * @author christ
 */
class Kontakt extends Persistenz {

    protected $uid;
    protected $hash;
    protected $password;
    protected $email;
    protected $postcode;
    protected $city;
    protected $latLng;
    protected $lat;
    protected $lng;

    protected $post;

    public function __construct($uid = NULL) {
        if(isset($uid)){
            $this->loadFromDatabase($uid);
        }
    }

    public function loadFromDatabase($uid) {
        new DatabaseHelper();
        $this->uid = \mysql_real_escape_string($uid);

        # hole Fahrrad Daten aus DB
        $sql    = "select * from user where uid=" . $this->uid;
        $result = mysql_query($sql);
        $row    = mysql_fetch_assoc($result);
        foreach($row as $key => $val){
            $setterFunction = 'set' . $key;
            $this->$setterFunction($val);
        }
    }

    public function loadFromPost($post) {
        $this->post = $post;
        
        $this->uid = $post['uid'];
        $this->hash = $post['hash'];
        $this->password = $post['password'];
        $this->email = $post['email'];
        $this->postcode = $post['postcode'];
        $this->city = $post['city'];
        $this->latLng = $post['latLng'];
        $this->lat = $post['lat'];
        $this->lng = $post['lng'];
    }

    public function updateInDatabase() {
        new DatabaseHelper();
        $sql = 'UPDATE user SET '
            . 'password="' . mysql_real_escape_string(trim($this->password)) . '", '
            . 'email="' . mysql_real_escape_string(trim($this->email)) . '", '
            . 'postcode="' . mysql_real_escape_string(trim($this->postcode)) . '", '
            . 'city="' . mysql_real_escape_string(trim($this->city)) . '", '
            . 'latLng="' . mysql_real_escape_string(trim($this->latLng)) . '", '
            . 'lat="' . mysql_real_escape_string(trim($this->lat)) . '", '
            . 'lng="' . mysql_real_escape_string(trim($this->lng)) . '", '
            . 'geaendert = CURRENT_TIMESTAMP '
            . 'WHERE uid=' . mysql_real_escape_string(trim($this->uid));
        #echo $sql;
        $result = mysql_query($sql);
        if(!$result){
            $exceptionText = 'User konnte nicht in der Datenbank user upgedated werden<br>';
            if(DEBUG){
                $exceptionText .= $sql . '<br>';
            }
            throw new \Exception($exceptionText);
        }
    }

    public function insertInDatabase() {
        new DatabaseHelper();
        
        
        $sql    = 'INSERT INTO bike (hash,password,email,postcode,city,latLng,lat,lng,erstellt,geaendert) VALUES ('
            . $_SESSION['uid'] . ', '
            . '"' . mysql_real_escape_string(trim($this->hash)) . '", '
            . '"' . mysql_real_escape_string(trim($this->password)) . '", '
            . '"' . mysql_real_escape_string(trim($this->email)) . '", '
            . mysql_real_escape_string(trim($this->postcode)) . ', '
            . '"' . mysql_real_escape_string(trim($this->city)) . '", '
            . '"' . mysql_real_escape_string(trim($this->latLng)) . '", '
            . mysql_real_escape_string(trim($this->lat)) . ', '
            . mysql_real_escape_string(trim($this->lng)) . '", '
            . ' CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
        $result = mysql_query($sql);
        if(!$result){
            $exceptionText = 'User konnte nicht in die Datenbank user geschrieben werden<br>';
            if(DEBUG){
                $exceptionText .= $sql . '<br>';
            }
            throw new \Exception($exceptionText);
        }
    }


    public function getUid() { return $this->uid; }
    public function getHash() { return $this->hash; }
    public function getPassword() { return $this->password; }
    public function getEmail() { return $this->email; }
    public function getPostcode() { return $this->postcode; }
    public function getCity() { return $this->city; }
    public function getLatLng() { return $this->latLng; }
    public function getLat() { return $this->lat; }
    public function getLng() { return $this->lng; }
        
    public function setUid($uid) { $this->uid                = $uid; }
    public function setHash($hash) { $this->hash             = $hash; }
    public function setPassword($password) { $this->password = $password; }
    public function setEmail($email) { $this->email          = $email; }
    public function setPostcode($postcode) { $this->postcode = $postcode; }
    public function setCity($city) { $this->city             = $city; }
    public function setLatLng($latLng) { $this->latLng       = $latLng; }
    public function setLat($lat) { $this->lat                = $lat; }
    public function setLng($lng) { $this->lng                = $lng; }
        
}
?>