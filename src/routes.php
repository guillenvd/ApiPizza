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
	    default:
	        return null;
	    break;
	}
});

$app->any('/order/[{data}]', function ($request, $response, $args) {
    header("Content-Type: application/json");
	require_once '../src/lib/order.php';
	$obj = new Products;
	switch ($args['data']) {
	    case "makeOrder":
	       $obj->orderCustomer($request->getQueryParams());
	    break;
	    case "orderById":
	       $obj->orderById($request->getQueryParams());
	    break;
	    case "orderByCustomer":
	       $obj->orderByCustomer($request->getQueryParams());
	    break;	
	   	case "countOrders":
	       $obj->countOrders($request->getQueryParams());
	    break;	
	    default:
	        return null;
	    break;
	}
});




