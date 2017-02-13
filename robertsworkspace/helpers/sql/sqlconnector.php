<?php
class SQLConnector {
    private $connection;
    
    public function getConnection(){
        return $this->connection;
    }
    
    public function __construct() {
        $this->connection = $this->makeNewConnection();
    }

    private static function makeNewConnection() {
    global $CONFIG;
        try {
            $newConnection = new PDO($CONFIG['database']['connection']
                    .";dbname=".$CONFIG['database']['name'], 
                    $CONFIG['database']['username'], 
                    $CONFIG['database']['password'],
                    $CONFIG['database']['options']);
            return $newConnection;
        } catch (PDOException $e) {
            handleerror("Connection failed: " . $e->getMessage());
            return false;
        }
    }

}
?>


<?php
