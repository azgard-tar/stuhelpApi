<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Discipline.php';

    $database = new Database();
    $db = $database->getConnection();
    $discipline = new Discipline($db);

    /**
     * @api {get} /discipline Request all disciplines
     * @apiVersion 0.1.0
     * @apiName GetDisciplines
     * @apiGroup Discipline
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *        {
     *          "id":"3",
     *          "Name":"Математика",
     *        },
     *        {
     *          "id":"4",
     *          "Name":"Биология",
     *        }
     *     ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Discipline was not found"
     *     }
     */

     /**
     * @api {get} /discipline/:id Request the discipline
     * @apiVersion 0.1.0
     * @apiName GetDiscipline
     * @apiGroup Discipline
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/discipline/12
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/discipline?Name=Тест
     * 
     * @apiParam {Number} id Discipline's unique ID.
     *
     * @apiSuccess {Number} id Id of the discipline.
     * @apiSuccess {String} Name Name of the discipline.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id":"4",
     *       "Name":"Биология",
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Discipline was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $discipline->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $discipline_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );

                $oneDiscipline = array(
                    "id" => $id,
                    "Name" => $Name
                );

                array_push( $discipline_arr, $oneDiscipline );
            }

            http_response_code(200);
            echo json_encode($discipline_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                    "id" => $id,
                    "Name" => $Name
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Discipline was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /discipline Add a discipline
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест" -X POST http://api.stuhelp.site/discipline
     * @apiVersion 0.1.0
     * @apiName AddDiscipline
     * @apiGroup Discipline
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message":"Done. New id: 1"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Name is empty"
     *     }
     */
    elseif( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( !is_null($_POST["Name"]) && !empty($_POST["Name"]) ){
            http_response_code(200);
            echo json_encode( array( "message" => $discipline->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name is empty" ) );
        }

    }
    /**
     * @api {delete} /discipline Delete a discipline
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/discipline
     * @apiExample {curl} Example usage with name:
     *   curl -d "Name=Тест" -X DELETE http://api.stuhelp.site/discipline
     * @apiVersion 0.1.0
     * @apiName DeleteDiscipline
     * @apiGroup Discipline
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message":"Done"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Data is empty"
     *     }
     */
    elseif( $_SERVER['REQUEST_METHOD'] === 'DELETE' ){ 
        parse_str(file_get_contents('php://input'), $_DELETE); // Get data by unusual request method
        if( !is_null( $_DELETE ) ){
            http_response_code(200);
            echo json_encode( array( "message" => $discipline->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /discipline Update information of the discipline
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/discipline
     * @apiVersion 0.1.0
     * @apiName UpdateDiscipline
     * @apiGroup Discipline
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "message":"Done"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Data is empty"
     *     }
     */
    elseif( $_SERVER['REQUEST_METHOD'] === 'PUT' ){
        parse_str(file_get_contents('php://input'), $_PUT); 
        if( !is_null( $_PUT ) && count( $_PUT ) > 1 ){
            http_response_code(200);
            echo json_encode( array( "message" => $discipline->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    