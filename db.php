<?php
class db
{
    private $host = "localhost";
    private $dbname = "gose_cafeteria";
    private $user = "root";
    private $port=4306;
    private $password = "";
    private $connection = "";

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";
        $this->connection = new PDO($dsn, $this->user, $this->password);
    }
    public function getConnection()
    {
        return $this->connection;
    }
    public function get_data($table, $columns = '*', $condition = null)
{
    $query = "SELECT $columns FROM $table";
    if ($condition) {
        $query .= " WHERE $condition";
    }
    return $this->connection->query($query);
}

    // public function get_data($table,$condition=1)
    // {
    //     return $this->connection->query("select * from $table where $condition");
    // }
    // public function insert_data($table,$cols, $values)
    // {
    //     return $this->connection->query("insert into $table($cols) values( $values)");
    // }
    
  public function insert_data($table, $cols, $values, $params)
    {
        $sql = "INSERT INTO $table ($cols) VALUES ($values)";
        
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($params);
    }
      

    public function update_data($table, $data, $condition)
{
    return $this->connection->query("update $table set $data where $condition");
}
    public function delete_data($table, $condition)
    {
        return $this->connection->query("delete from $table where $condition");
    }
}
?>