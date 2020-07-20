<?php
class general{

    private $conn;
    private $table_name;

    public function __construct( $db, $table_name ){
        $this->conn = $db;
        $this->table_name = $table_name;
    }

    public function getTableName(){
        return $this->table_name;
    }

    public function create( $data ){
        include_once 'utils.php';
        try{
            $query = genCreateQuery( $this->table_name, $data );
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            $temp = $this->conn->lastInsertId();
        } catch(PDOException $e) {
            return $query . "<br>" . $e->getMessage();
        }
        return "Done. New id: " . $temp;
    }

    public function read( $data ){
        if( count( $data ) > 0 ){
            $query = "SELECT * FROM $this->table_name WHERE ". array_key_first($data) ." = '". array_shift($data) . "'";
        }
        else{
            $query = "SELECT * FROM $this->table_name";
        }
        try{
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
        } catch(PDOException $e) {
            return $query . "<br>" . $e->getMessage();
        }

        return $stmt;
    }

    public function update( $data ){
        include_once 'utils.php';
        try{
            try{
                $query = genUpdQuery( $this->table_name, $data );
            }catch( Exception $e ){
                return $e->getMessage();
            }
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
        } catch(PDOException $e) {
            return $query . "<br>" . $e->getMessage();
        }
        
        return "Done";
    }

    public function delete( $data ){
        try{
            $query = "DELETE FROM $this->table_name WHERE ". array_key_first($data)  ." = '". array_shift( $data ) ."'";
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
        } catch(PDOException $e) {
            return $query . "<br>" . $e->getMessage();
        }
        return "Done";
    }
}