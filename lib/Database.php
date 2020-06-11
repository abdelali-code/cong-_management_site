<?php 
    class Database {
        public function __construct() {
            try {
                $this->db = new PDO(DB_VENDOR.":host=".DB_HOST.";dbname=".DB_NAME, DB_USR, DB_PWD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch( Exception $e) {
                die("smothing was wrong").$e->getMessage();
            }
        }
    }

?>