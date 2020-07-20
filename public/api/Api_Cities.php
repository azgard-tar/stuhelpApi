<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Cities.php';

    $database = new Database();
    $db = $database->getConnection();
    $Cities = new City($db);

    /**
     * @api {get} /cities Request all cities
     * @apiVersion 0.1.0
     * @apiName GetCities
     * @apiGroup City
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *        {
     *          "id":"3",
     *          "Name":"Николаев",
     *          "eng_Name":"Mykolaiv"
     *        },
     *        {
     *          "id":"4",
     *          "Name":"Киев",
     *          "eng_Name":"Kiev"
     *        }
     *     ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "City was not found"
     *     }
     */

     /**
     * @api {get} /cities/:id Request the city
     * @apiVersion 0.1.0
     * @apiName GetCity
     * @apiGroup City
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/cities/12
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/cities?Name=Тест
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/cities?eng_Name=temp
     * 
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {Number} id Id of the city.
     * @apiSuccess {String} Name Russian name of the city.
     * @apiSuccess {String} eng_Name English name of the city.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id":"4",
     *       "Name":"Киев",
     *       "eng_Name":"Kiev"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "City was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $Cities->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $cities_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
                extract( $row );

                $city = array(
                    "id" => $id,
                    "Name" => $Name,
                    "eng_Name" => $eng_Name
                );

                array_push( $cities_arr, $city );
            }

            http_response_code(200);
            echo json_encode($cities_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                    "id" => $id,
                    "Name" => $Name,
                    "eng_Name" => $eng_Name
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "City was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /cities Add a city
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест&eng_Name=temp" -X POST http://api.stuhelp.site/cities
     * @apiVersion 0.1.0
     * @apiName AddCity
     * @apiGroup City
     *
     * @apiParam {String} Name Russian name of the city
     * @apiParam {String} eng_Name (optional)English name of the city
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
            echo json_encode( array( "message" => $Cities->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name is empty" ) );
        }

    }
    /**
     * @api {delete} /cities Delete a city
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/cities
     * @apiExample {curl} Example usage with name:
     *   curl -d "name=Тест" -X DELETE http://api.stuhelp.site/cities
     * @apiVersion 0.1.0
     * @apiName DeleteCity
     * @apiGroup City
     *
     * @apiParam {Number} id Id of the city
     * @apiParam {String} Name Russian name of the city
     * @apiParam {String} eng_Name English name of the city
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
            echo json_encode( array( "message" => $Cities->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /cities Update information of the city
     * @apiExample {curl} It changes info by the first value(id) Example changing eng_Name:
     *   curl -d "id=10&eng_Name=temp" -X PUT http://api.stuhelp.site/cities
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/cities
     * @apiVersion 0.1.0
     * @apiName UpdateCity
     * @apiGroup City
     *
     * @apiParam {String} Name Russian name of the city
     * @apiParam {String} eng_Name (optional)English name of the city
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
            echo json_encode( array( "message" => $Cities->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }