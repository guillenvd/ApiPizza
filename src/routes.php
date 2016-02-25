<?php
// Routes

$app->any('/user/[{data}]', function ($request, $response, $args) {
    header("Content-Type: application/json");
	require_once '../src/lib/connection.php';
	var_dump($request->getQueryParams());
	$obj = new connection;
	switch ($args['data']) {
	    case "create":
	       $obj->createCustomer($request->getQueryParams());
	    break;
	    case "login":
	       $obj->checkLoginCustomer($request->getQueryParams());
	    break;
	    case "update":
	       $obj->updateCustomer($request->getQueryParams());
	    break;

	    default:
	        return null;
	    break;
	}


});


