<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/AboutEvent.php';

    $database = new Database();
    $db = $database->getConnection();
    $event = new AboutEvent($db);

    /**
     * @api {get} /event Request all events
     * @apiVersion 0.1.0
     * @apiName GetEvents
     * @apiGroup Event
     *
     * @apiSuccessExample Success-Response:
     *   HTTP/1.1 200 OK
     *   [
     *     {
     *      "id":"1",
     *      "EvWhen":"2020-07-12 18:00:00",
     *      "id_User":"10",
     *      "EvType":"1",
     *      "EvWhere":"Кинотеатр Юность",
     *      "id_Subject":null,
     *      "id_Theme":null,
     *      "Keywords":"День рождения,праздник",
     *      "Questions":null,
     *      "Homework":null,
     *      "WhenDoHW":"2001-05-10 00:00:00"
     *     }
     *   ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Event was not found"
     *     }
     */

     /**
     * @api {get} /event/:id Request the event
     * @apiVersion 0.1.0
     * @apiName GetEvent
     * @apiGroup Event
     * 
     * @apiExample {url} Example usage with id:
     *      http://api.stuhelp.site/event/12
     * @apiExample {url} Example usage with id of the user:
     *      http://api.stuhelp.site/event?id_User=10
     * @apiExample {url} Example usage by time of the event:
     *      http://api.stuhelp.site/event?EvWhen=2020-07-12 18:00:00
     * 
     * @apiParam {Number} id Event unique ID.
     *
     * @apiSuccess {Number} id Id of the event.
     * @apiSuccess {Datetime} EvWhen Time of the event. YYYY-MM-DD HH:MM:SS
     * @apiSuccess {Number} id_User Id of owner.
     * @apiSuccess {Number} EvType Type of the event.0 = usual, 1 = class in the university( def = 0 )
     * @apiSuccess {String} EvWhere Place of the event( class, street ).
     * @apiSuccess {Number} id_Subject (university)
     * @apiSuccess {Number} id_Theme (university)
     * @apiSuccess {String} Keywords (university)
     * @apiSuccess {String} Questions (university)
     * @apiSuccess {String} Homework (university)
     * @apiSuccess {Datetime} WhenDoHW (university) When you will do homework
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "id":"1",
     *      "EvWhen":"2020-07-12 18:00:00",
     *      "id_User":"10",
     *      "EvType":"1",
     *      "EvWhere":"Кинотеатр Юность",
     *      "id_Subject":null,
     *      "id_Theme":null,
     *      "Keywords":"День рождения,праздник",
     *      "Questions":null,
     *      "Homework":null,
     *      "WhenDoHW":"2001-05-10 00:00:00"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Event was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $event->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $event_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );
                $oneEvent = array(
                    "id" => $id,
                    "EvWhen" => $EvWhen,
                    "id_User" => $id_User,
                    "EvType" => $EvType,
                    "EvWhere" => $EvWhere,
                    "id_Subject" => $id_Subject,
                    "id_Theme" => $id_Theme,
                    "Keywords" => $Keywords,
                    "Questions" => $Questions,
                    "Homework" => $Homework,
                    "WhenDoHW" => $WhenDoHW
                );

                array_push( $event_arr, $oneEvent );
            }

            http_response_code(200);
            echo json_encode($event_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                "id" => $id,
                "EvWhen" => $EvWhen,
                "id_User" => $id_User,
                "EvType" => $EvType,
                "EvWhere" => $EvWhere,
                "id_Subject" => $id_Subject,
                "id_Theme" => $id_Theme,
                "Keywords" => $Keywords,
                "Questions" => $Questions,
                "Homework" => $Homework,
                "WhenDoHW" => $WhenDoHW
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Event was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /event Add a event
     * @apiExample {curl} Example usage:
     *   curl -d "EvWhen=2001-05-08 18:30:30&id_User=10&EvType=1&EvWhere=Кинотеатр Юность&Keywords=День рождения,праздник&WhenDoHW=2001-05-10" -X POST http://api.stuhelp.site/event
     * @apiVersion 0.1.0
     * @apiName AddEvent
     * @apiGroup Event
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
     *       "message": "EvWhen or id_User is empty"
     *     }
     */
    elseif( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( !is_null($_POST["EvWhen"])    && !empty($_POST["EvWhen"]) &&
            !is_null($_POST["id_User"]) && !empty($_POST["id_User"]) ){
            http_response_code(200);
            echo json_encode( array( "message" => $event->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "EvWhen or id_User is empty" ) );
        }

    }
    /**
     * @api {delete} /event Delete an event
     * @apiExample {curl} Example usage with time of hw:
     *   curl -d "WhenDoHW=2002-05-10" -X DELETE http://api.stuhelp.site/event
     * @apiVersion 0.1.0
     * @apiName DeleteEvent
     * @apiGroup Event
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
        parse_str(file_get_contents('php://input'), $_DELETE); 
        if( !is_null( $_DELETE ) ){
            http_response_code(200);
            echo json_encode( array( "message" => $event->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /countries Update information of the event
     * @apiExample {curl} It changes info by the first value(id) Example changing time of the event:
     *   curl -d "id=1&EvWhen=2020-07-12 18:00:00" -X PUT http://api.stuhelp.site/event
     * @apiVersion 0.1.0
     * @apiName UpdateEvent
     * @apiGroup Event
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
            echo json_encode( array( "message" => $event->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    