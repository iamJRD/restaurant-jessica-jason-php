<?php

	require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__.'/../src/Cuisine.php';
	require_once __DIR__.'/../src/Restaurant.php';
	require_once __DIR__.'/../src/Review.php';

	$server = 'mysql:host=localhost;dbname=food';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	$app = new Silex\Application();

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	use Symfony\Component\HttpFoundation\Request;
	Request::enableHttpMethodParameterOverride();

	$app->get('/', function() use ($app) {
		return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
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
		$restaurants = $cuisine->getRestaurants();
		return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $restaurants));
	});

	$app->post('/add_restaurant', function() use ($app){
		$restaurant_name = $_POST['restaurant_name'];
		$restaurant_location = $_POST['location'];
		$cuisine_id = $_POST['cuisine_id'];

		$restaurant = new Restaurant($restaurant_name, $restaurant_location, $cuisine_id, $id = null);
		$restaurant->save();
		$cuisine = Cuisine::find($cuisine_id);
		return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
	});

	$app->get('/restaurant/{id}', function($id) use ($app) {
		$restaurant = Restaurant::find($id);
		$cuisine = Cuisine::find($restaurant->getCuisineId());
		$reviews = $restaurant->getReviews();
		return $app['twig']->render('restaurant.html.twig', array('cuisine' => $cuisine, 'restaurant' => $restaurant, 'reviews'=>$reviews));
	});

	$app->delete('/delete_restaurant/{id}', function($id) use ($app) {
		$deleted_restaurant = Restaurant::find($id);
		$cuisines = Cuisine::find($deleted_restaurant->getCuisineId());
		$deleted_restaurant->deleteRestaurant();
		$restaurants = $cuisines->getRestaurants();

		return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisines, 'restaurants' => $restaurants));
	});

	$app->post('/delete_restaurants', function() use ($app) {
		Restaurant::deleteAll();
		$cuisines = Cuisine::getAll();
		return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
	});

	$app->patch('/cuisine/{id}/edit', function($id) use ($app){
		$name = $_POST['cuisine_name'];
		$cuisine = Cuisine::find($id);
		$cuisine->updateCuisine($name);
		return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
	});

	$app->get('/restaurant/{id}/verify', function($id) use ($app) {
		$new_restaurant_name = $_GET['restaurant_name'];
		$new_restaurant_location = $_GET['restaurant_location'];
		$restaurant = Restaurant::find($id);
		return $app['twig']->render('restaurant_edit_verify.html.twig', array('restaurant' => $restaurant, 'new_restaurant_name' => $new_restaurant_name, 'new_restaurant_location' => $new_restaurant_location));
	});

	$app->patch('/restaurant/{id}/edit', function($id) use ($app){
		$name = $_POST['restaurant_name'];
		$location = $_POST['restaurant_location'];
		$restaurant = Restaurant::find($id);
		$cuisine = Cuisine::find($restaurant->getCuisineId());
		$restaurant->updateRestaurant($name, $location);
		return $app['twig']->render('restaurant.html.twig', array('cuisine' => $cuisine, 'restaurant' => $restaurant));
	});
	$app->post('/restaurant/{id}/review', function($id) use ($app){
		$user_name = $_POST['user_name'];
		$rating = $_POST['user_rating'];
		$restaurant_id = $_POST['restaurant_id'];
		$user_review = $_POST['user_review'];
		$new_review = new Review($user_name, $rating, $user_review, NULL, $restaurant_id );
		$new_review->save();
		$restaurant = Restaurant::find($restaurant_id);
		$reviews = $restaurant->getReviews();
		$cuisine = Cuisine::find($restaurant->getCuisineId());
		return $app['twig']->render('restaurant.html.twig', array('cuisine' => $cuisine, 'restaurant' => $restaurant, 'reviews'=>$reviews));
	});

	return $app;

?>
