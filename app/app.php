<?php

	require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__.'/../src/Cuisine.php';
	require_once __DIR__.'/../src/Restaurant.php';

	$server = 'mysql:host=localhost;dbname=food';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	$app = new Silex\Application();

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	$app->get('/', function() use ($app) {
		return $app['twig']->render('index.html.twig');
	});

	$app->post('/add_cuisine', function() use ($app) {
		$name = $_POST['name'];
		$test_cuisine = new Cuisine($name);
		$test_cuisine->save();
		$cuisines = Cuisine::getAll();
		return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
	});

	$app->post('/delete_cuisines', function() use ($app) {
		Cuisine::deleteAll();
		return $app['twig']->render('index.html.twig');
	});

	$app->get('/cuisine/{id}', function($id) use ($app) {
		$cuisine = Cuisine::find($id);
		$resturants = Restaurant::getAll();
		return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $restaurants));
	});

	// $app->post('/add_cuisine/{id}', function($id) use ($app) {
	// 	$cuisine = new Cuisine($_POST['name']);
	// 	$cuisine->save();
	// 	return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine));
	// });

	return $app;



?>
