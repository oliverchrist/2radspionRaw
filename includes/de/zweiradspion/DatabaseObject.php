<?php
namespace de\zweiradspion;

/**
 * Database Object Inferface
 *
 * @author christ
 */
interface DatabaseObject {
    public function loadFromDatabase($uid);
    public function loadFromPost($post);
    public function updateInDatabase();
    public function insertInDatabase();
}
?>