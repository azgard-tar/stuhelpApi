<?php

function genUpdQuery( $tableName, $putArray ){
    $query = "UPDATE $tableName SET ";
    $byWhat = array_key_first( $putArray );
    $What = array_shift( $putArray );

    foreach( $putArray as $key=>$value){
        if( strtolower( $key ) == 'id' )
            throw new Exception( "Id cannot be changed" );
        $query .= $key . "='$value'";
        if($key != array_key_last($putArray) )
            $query .= ", ";
    }

    $query .= " WHERE $byWhat = '$What'";
    return $query;
}

function genCreateQuery( $tableName, $data ){
    $partOne = $partTwo = "(";
    foreach( $data as $key=>$value){
        $partOne .= $key;
        $partTwo .= "'$value'";
        if ( $key != array_key_last($data) ){
            $partOne .= ", ";
            $partTwo .= ", ";
        }
        else {
            $partOne .=  " )";
            $partTwo .=  " )";
        }
    }
    return "INSERT INTO $tableName $partOne VALUES$partTwo";
}