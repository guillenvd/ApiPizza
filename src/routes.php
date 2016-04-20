<?php
// Routes

$app->any('/user/[{data}]', function ($request, $response, $args) {
    header("Content-Type: application/json");
	require_once '../src/lib/user.php';
	$obj = new User;
	switch ($args['data']) {
	    case "signup":
	       $obj->signupCustomer($request->getQueryParams());
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


$app->any('/products/[{data}]', function ($request, $response, $args) {
    header("Content-Type: application/json");
	require_once '../src/lib/products.php';
	$obj = new Products;
	switch ($args['data']) {
	    case "getProducts":
	       $obj->getProducts($request->getQueryParams());
	    break;
	    case "makeOrder":
	       $obj->orderCustomer($request->getQueryParams());
	    break;
	    default:
	        return null;
	    break;
	}
});


