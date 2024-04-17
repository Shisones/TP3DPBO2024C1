<?php
// Model to contain all Database-related stuff
class DB {
    /* -- Attributes -- */
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    /* --  Methods -- */
    function __construct($hostname, $username, $password, $dbname) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function open() {
        // Connect to a new database
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    // Honestly, these three is a huge security vulnerability, but ok
    
    function execute($query) {
        // Execute a given query
        $this->result = mysqli_query($this->conn, $query);
    }

    function getResult(){
        // Return the query result
        return mysqli_fetch_array($this->result);
    }

    function executeAffected($query = "")
    {
        // Execute a query and then return the result
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }

    function close() {
        // CLose the database connection
        mysqli_close($this->conn);
    }
}
