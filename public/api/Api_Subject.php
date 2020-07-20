<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Subject.php';

    $database = new Database();
    $db = $database->getConnection();
    $subject = new Subject($db);

    /**
     * @api {get} /subject Request all subjects
     * @apiVersion 0.1.0
     * @apiName GetSubjects
     * @apiGroup Subject
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *        {
     *          "id":"3",
     *          "Name":"Выш мат",
     *          "id_Discipline":"4"
     *        },
     *        {
     *          "id":"4",
     *          "Name":"Теор мех",
     *          "id_Discipline":"5"
     *        }
     *     ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Subject was not found"
     *     }
     */

     /**
     * @api {get} /subject/:id Request the subject
     * @apiVersion 0.1.0
     * @apiName GetSubject
     * @apiGroup Subject
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/subject/12
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/subject?Name=Тест
     *
     * @apiSuccess {Number} id Id of the subject.
     * @apiSuccess {String} Name Russian name of the subject.
     * @apiSuccess {Number} id_Discipline Id of the subject's discipline
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id":"4",
     *       "Name":"Теор мех",
     *       "id_Discipline":"5"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Subject was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $subject->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $subject_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );

                $oneSubject = array(
                    "id" => $id,
                    "Name" => $Name,
                    "id_Discipline" => $id_Discipline
                );

                array_push( $subject_arr, $oneSubject );
            }

            http_response_code(200);
            echo json_encode($subject_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                    "id" => $id,
                    "Name" => $Name,
                    "id_Discipline" => $id_Discipline
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Subject was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /subject Add a subject
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест&id_Discipline=5" -X POST http://api.stuhelp.site/subject
     * @apiVersion 0.1.0
     * @apiName AddSubject
     * @apiGroup Subject
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
            echo json_encode( array( "message" => $subject->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name is empty" ) );
        }

    }
    /**
     * @api {delete} /subject Delete a subject
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/subject
     * @apiExample {curl} Example usage with name:
     *   curl -d "name=Тест" -X DELETE http://api.stuhelp.site/subject
     * @apiVersion 0.1.0
     * @apiName DeleteSubject
     * @apiGroup Subject
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
            echo json_encode( array( "message" => $subject->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /subject Update information of the subject
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/subject
     * @apiVersion 0.1.0
     * @apiName UpdateSubject
     * @apiGroup Subject
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
            echo json_encode( array( "message" => $subject->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    