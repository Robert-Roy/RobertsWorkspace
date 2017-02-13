<?php
Class util {

    //If uninitialized, static functions are useful all over the website.
    //If initialized, creates a mysql connection ($conn) using sqlconnector.php
    //Pages
    private $conn = false;

    public function __construct() {
        $sqlconnector = new SQLConnector();
        $this->conn = $sqlconnector->getConnection();
        if ($this->conn === null) {
            handleerror("Could not make SQL connection");
        }
    }

    public function &getConn() {
        return $this->conn;
    }

    public function query($query) {
        //Avoid use of this if at all possible. Use prepared statements.
        try {
            return $this->conn->query($query);
        } catch (Exception $e) {
            handleerror("PDO: " . $e->getMessage());
        }
        return false;
    }

}
?>