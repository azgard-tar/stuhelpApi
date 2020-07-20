<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Group.php';

    $database = new Database();
    $db = $database->getConnection();
    $group = new Group($db);

    /**
     * @api {get} /group Request all groups
     * @apiVersion 0.1.0
     * @apiName GetGroups
     * @apiGroup Group
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
     *       "message": "Group was not found"
     *     }
     */

     /**
     * @api {get} /group/:id Request the group
     * @apiVersion 0.1.0
     * @apiName GetGroup
     * @apiGroup Group
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/group/12
     * @apiExample {curl} Example usage with the university:
     *      http://api.stuhelp.site/group?University=Тест
     * 
     * @apiParam {Number} id Group's unique ID.
     * @apiParam {String} Name Group's name.
     * @apiParam {String} University Name of the group's university
     * @apiParam {String} id_ElderStudent Id of the group's manager
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id":"4",
     *       "Name":"171",
     *       "University":"Mohula",
     *       "id_ElderStudent":"7"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Group was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $group->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $group_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );

                $oneGroup = array(
                    "id" => $id,
                    "Name" => $Name,
                    "University" => $University,
                    "id_ElderStudent" => $id_ElderStudent
                );

                array_push( $group_arr, $oneGroup );
            }

            http_response_code(200);
            echo json_encode($group_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                "id" => $id,
                "Name" => $Name,
                "University" => $University,
                "id_ElderStudent" => $id_ElderStudent
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Group was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /group Add a group
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест171" -X POST http://api.stuhelp.site/group
     * @apiVersion 0.1.0
     * @apiName AddGroup
     * @apiGroup Group
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
            echo json_encode( array( "message" => $group->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name is empty" ) );
        }

    }
    /**
     * @api {delete} /group Delete a group
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/group
     * @apiExample {curl} Example usage with name:
     *   curl -d "Name=Тест" -X DELETE http://api.stuhelp.site/group
     * @apiVersion 0.1.0
     * @apiName DeleteGroup
     * @apiGroup Group
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
            echo json_encode( array( "message" => $group->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /group Update information of the group
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/group
     * @apiVersion 0.1.0
     * @apiName UpdateGroup
     * @apiGroup Group
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
            echo json_encode( array( "message" => $group->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    