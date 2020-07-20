<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Countries.php';

    $database = new Database();
    $db = $database->getConnection();
    $Countries = new Country($db);

    /**
     * @api {get} /countries Request all countries
     * @apiVersion 0.1.0
     * @apiName GetCountries
     * @apiGroup Country
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *        {
     *          "id":"3",
     *          "Name":"Украина",
     *          "eng_Name":"Ukraine"
     *        },
     *        {
     *          "id":"4",
     *          "Name":"Польша",
     *          "eng_Name":"Poland"
     *        }
     *     ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Country was not found"
     *     }
     */

     /**
     * @api {get} /countries/:id Request the country
     * @apiVersion 0.1.0
     * @apiName GetCountry
     * @apiGroup Country
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/countries/12
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/countries?Name=Тест
     * @apiExample {curl} Example usage with english name:
     *      http://api.stuhelp.site/countries?eng_Name=temp
     * 
     * @apiParam {Number} id Country unique ID.
     *
     * @apiSuccess {Number} id Id of the country.
     * @apiSuccess {String} Name Russian name of the country.
     * @apiSuccess {String} eng_Name English name of the country.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id":"5",
     *       "Name":"Россия",
     *       "eng_Name":"Russia"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Country was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $Countries->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $countries_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );

                $country = array(
                    "id" => $id,
                    "Name" => $Name,
                    "eng_Name" => $eng_Name
                );

                array_push( $countries_arr, $country );
            }

            http_response_code(200);
            echo json_encode($countries_arr, JSON_UNESCAPED_UNICODE);
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
            echo json_encode(array("message" => "Country was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /countries Add a country
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест&eng_Name=temp" -X POST http://api.stuhelp.site/countries
     * @apiVersion 0.1.0
     * @apiName AddCountry
     * @apiGroup Country
     *
     * @apiParam {String} Name Russian name of the country
     * @apiParam {String} eng_Name (optional)English name of the country
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
            echo json_encode( array( "message" => $Countries->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name is empty" ) );
        }

    }
    /**
     * @api {delete} /countries Delete a country
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/countries
     * @apiExample {curl} Example usage with name:
     *   curl -d "name=Тест" -X DELETE http://api.stuhelp.site/countries
     * @apiVersion 0.1.0
     * @apiName DeleteCountry
     * @apiGroup Country
     *
     * @apiParam {Number} id Id of the country
     * @apiParam {String} Name Russian name of the country
     * @apiParam {String} eng_Name English name of the country
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
            echo json_encode( array( "message" => $Countries->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /countries Update information of the country
     * @apiExample {curl} It changes info by the first value(id) Example changing eng_Name:
     *   curl -d "id=10&eng_Name=temp" -X PUT http://api.stuhelp.site/countries
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/countries
     * @apiVersion 0.1.0
     * @apiName UpdateCountry
     * @apiGroup Country
     *
     * @apiParam {String} Name Russian name of the country
     * @apiParam {String} eng_Name (optional)English name of the country
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
            echo json_encode( array( "message" => $Countries->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    