<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once 'config/database.php';
    include_once 'objects/User.php';

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    /**
     * @api {get} /user Request all users
     * @apiVersion 0.1.0
     * @apiName GetUsers
     * @apiGroup User
     *
     * @apiSuccessExample Success-Response:
     *   HTTP/1.1 200 OK
     *   [
     *     {
     *      "id":"1",
     *      "Name":"Вася",
     *      "Surname":"Фканер",
     *      "Login":"azf",
     *      "Email":"111@111",
     *      "PassHash":"222",
     *      "PassSalt":"111",
     *      "Coins":"10",
     *      "id_Group":null,
     *      "LastLogin":"2020-05-05 16:00:00",
     *      "id_Interface":null,
     *      "ShopInfo":null,
     *      "id_City":null,
     *      "id_Country":null
     *     }
     *   ]
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "User was not found"
     *     }
     */

     /**
     * @api {get} /user/:id Request a user
     * @apiVersion 0.1.0
     * @apiName GetUser
     * @apiGroup User
     * 
     * @apiExample {url} Example usage with id:
     *      http://api.stuhelp.site/user/12
     * @apiExample {url} Example usage with name of the user:
     *      http://api.stuhelp.site/user?Name=Вася
     * 
     * @apiParam {Number} id User's unique ID.
     *
     * @apiSuccess {Number} id Id of a user.
     * @apiSuccess {String} Name User's name
     * @apiSuccess {String} Surname User's surname
     * @apiSuccess {String} Login User's login
     * @apiSuccess {String} Email User's email
     * @apiSuccess {String} PassHash User's hash
     * @apiSuccess {String} PassSalt User's salt for hash
     * @apiSuccess {Number} Coins User's coins( for shop )
     * @apiSuccess {Number} id_Group Id of user's group
     * @apiSuccess {DateTime} LastLogin The last time a user logged in to the site
     * @apiSuccess {Number} id_Interface Id of the current interface
     * @apiSuccess {String} ShopInfo Which interfaces a user have bought
     * @apiSuccess {Number} id_City City of a user
     * @apiSuccess {Number} id_Country Id of the country of a user
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "id":"1",
     *      "Name":"Вася",
     *      "Surname":"Фканер",
     *      "Login":"azf",
     *      "Email":"111@111",
     *      "PassHash":"222",
     *      "PassSalt":"111",
     *      "Coins":"10",
     *      "id_Group":null,
     *      "LastLogin":"2020-05-05 16:00:00",
     *      "id_Interface":null,
     *      "ShopInfo":null,
     *      "id_City":null,
     *      "id_Country":null
     *     }
     *     
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "User was not found"
     *     }
     */

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
        $stmt = $user->read( $_GET );
        $num = $stmt->rowCount();
        if( $num > 1 ){
            $user_arr = array();
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract( $row );
                $oneUser = array(
                    "id" => $id,
                    "Name" => $Name,
                    "Surname" => $Surname,
                    "Login" => $Login,
                    "Email" => $Email,
                    "PassHash" => $PassHash,
                    "PassSalt" => $PassSalt,
                    "Coins" => $Coins,
                    "id_Group" => $id_Group,
                    "LastLogin" => $LastLogin,
                    "id_Interface" => $id_Interface,
                    "ShopInfo" => $ShopInfo,
                    "id_City" => $id_City,
                    "id_Country" => $id_Country
                );

                array_push( $user_arr, $oneUser );
            }

            http_response_code(200);
            echo json_encode($user_arr, JSON_UNESCAPED_UNICODE);
        } else if( $num > 0 ){
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            echo json_encode(array(
                    "id" => $id,
                    "Name" => $Name,
                    "Surname" => $Surname,
                    "Login" => $Login,
                    "Email" => $Email,
                    "PassHash" => $PassHash,
                    "PassSalt" => $PassSalt,
                    "Coins" => $Coins,
                    "id_Group" => $id_Group,
                    "LastLogin" => $LastLogin,
                    "id_Interface" => $id_Interface,
                    "ShopInfo" => $ShopInfo,
                    "id_City" => $id_City,
                    "id_Country" => $id_Country
                ), JSON_UNESCAPED_UNICODE
            );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "User was not found"), JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @api {post} /user Add a user
     * @apiExample {curl} Example usage:
     *   curl -d "Name=Вася&Surname=Фканер&Login=azf&Email=111@111&PassHash=222&PassSalt=111&Coins=10&LastLogin=2020-05-05 16" -X POST http://api.stuhelp.site/user
     * @apiVersion 0.1.0
     * @apiName AddUser
     * @apiGroup User
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
        if( !is_null($_POST["PassHash"])    && !empty($_POST["PassHash"]) &&
            !is_null($_POST["PassSalt"]) && !empty($_POST["PassSalt"]) ){
            http_response_code(200);
            echo json_encode( array( "message" => $user->create( $_POST ) ) );
        } else{
            http_response_code(404);
            echo json_encode( array( "message" => "PassHash or PassSalt is empty" ) );
        }

    }
    /**
     * @api {delete} /user Delete a user
     * @apiExample {curl} Example with id:
     *   curl -d "id=1" -X DELETE http://api.stuhelp.site/user
     * @apiVersion 0.1.0
     * @apiName DeleteUser
     * @apiGroup User
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
            echo json_encode( array( "message" => $user->delete( $_DELETE) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }
    /**
     * @api {post} /user Update information of the user
     * @apiExample {curl} Example changing time of the user's name:
     *   curl -d "id=1&Name=Вася" -X PUT http://api.stuhelp.site/user
     * @apiVersion 0.1.0
     * @apiName UpdateUser
     * @apiGroup User
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
            echo json_encode( array( "message" => $user->update( $_PUT ) ) );
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "Data is empty") );
        }
    }

    