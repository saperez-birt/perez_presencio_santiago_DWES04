<?php

class DatabaseSingleton {
    private static $instance = null;
    private $connection;

    private $config = [];

    private function __construct() {
        $this->loadConfig();
        $this->connection = new PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['db_name']};charset=utf8", 
            $this->config['user'], 
            $this->config['password']
        );
    }

    private function loadConfig() {
        $json_file = file_get_contents('../config/db-conf.json');
        $this->config = json_decode($json_file, true);
    }

    public static function getInstance() {
        if (self::$instance == null) { // !isset(self::$instance) || is_null(self::$instance) || empty(self::$instance) || !self::$instance
            self::$instance = new DatabaseSingleton(); // new self();
        }

        return self::$instance;
    }

    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
};
?>