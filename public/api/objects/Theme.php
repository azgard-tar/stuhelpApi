<?php

class Theme{

    private $conn;
    private $general;

    public function __construct( $db ){
        $this->conn = $db;
        include_once '/var/www/api.stuhelp.site/public/api/general_api.php';
        $this->general = new general($db, "Theme");
    }

    function create( $data ){
        return $this->general->create( $data );
    }
    function read( $data ){
        return $this->general->read( $data );
    }
    function update( $data ){
        return $this->general->update( $data );
    }
    function delete( $data ){
        return $this->general->delete( $data );
    }

}