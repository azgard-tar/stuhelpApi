<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/Theme.php';

    $database = new Database();
    $db = $database->getConnection();
    $theme = new Theme($db);

    /**
     * @api {get} /theme Request all themes
     * @apiVersion 0.1.0
     * @apiName GetThemes
     * @apiGroup Theme
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *        {
     *          "id":"3",
     *          "Name":"Производная",
     *          "id_Subject":"4",
     *          "id_User":"5"
     *        },
     *        {
     *          "id":"4",
     *          "Name":"Фермы",
     *          "id_Subject":"5",
     *          "id_User":"5"
     *        }
     *     ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Theme was not found"
     *     }
     */

     /**
     * @api {get} /theme/:id Request the theme
     * @apiVersion 0.1.0
     * @apiName GetTheme
     * @apiGroup Theme
     * 
     * @apiExample {curl} Example usage with id:
     *      http://api.stuhelp.site/theme/12
     * @apiExample {curl} Example usage with name:
     *      http://api.stuhelp.site/theme?Name=Тест
     *
     * @apiSuccess {Number} id Id of the theme.
     * @apiSuccess {String} Name Name of the theme.
     * @apiSuccess {Number} id_Subject Id of the theme's subject
     * @apiSuccess {Number} id_User Id of the theme's owner
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "id":"4",
     *          "Name":"Фермы",
     *          "id_Subject":"5",
     *          "id_User":"5"
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Theme was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $theme->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $theme_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );

                $oneTheme = array(
                    "id" => $id,
                    "Name" => $Name,
                    "id_Subject" => $id_Subject,
                    "id_User" => $id_User
                );

                array_push( $theme_arr, $oneTheme );
            }

            http_response_code(200);
            echo json_encode($theme_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                    "id" => $id,
                    "Name" => $Name,
                    "id_Subject" => $id_Subject,
                    "id_User" => $id_User
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Theme was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /theme Add a theme
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Тест&id_Subject=5" -X POST http://api.stuhelp.site/theme
     * @apiVersion 0.1.0
     * @apiName AddTheme
     * @apiGroup Theme
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
        if( !is_null($_POST["Name"]) && !empty($_POST["Name"]) &&
            !is_null($_POST["id_User"]) && !empty($_POST["id_User"]) ){
            http_response_code(200);
            echo json_encode( array( "message" => $theme->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "Name or id_User is empty" ) );
        }

    }
    /**
     * @api {delete} /theme Delete a theme
     * @apiExample {curl} Example usage with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/theme
     * @apiExample {curl} Example usage with name:
     *   curl -d "name=Тест" -X DELETE http://api.stuhelp.site/theme
     * @apiVersion 0.1.0
     * @apiName DeleteTheme
     * @apiGroup Theme
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
            echo json_encode( array( "message" => $theme->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /theme Update information of the theme
     * @apiExample {curl} Example changing Name:
     *   curl -d "id=10&Name=Тест" -X PUT http://api.stuhelp.site/theme
     * @apiVersion 0.1.0
     * @apiName UpdateTheme
     * @apiGroup Theme
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
            echo json_encode( array( "message" => $theme->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    