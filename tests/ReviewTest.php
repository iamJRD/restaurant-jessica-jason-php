<?php
    require_once 'src/Restaurant.php';
    require_once 'src/Review.php';

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Review::deleteAll();
        }

        function testGetUserName()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $restaurant_id, $id);

            // Act
            $result = $test_review->getUserName();

            // Assert
            $this->assertEquals('Bob', $result);
        }

        function testGetUserRating()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);

            // Act
            $result = $test_review->getUserRating();

            // Assert
            $this->assertEquals(4, $result);
        }

        function testGetUserReview()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);

            // Act
            $result = $test_review->getUserReview();

            // Assert
            $this->assertEquals('Yum', $result);
        }

        function testGetRestaurantId()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);

            // Act
            $result = $test_review->getRestaurantId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function testGetId()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);

            // Act
            $result = $test_review->getId();

            // Assert
            $this->assertEquals(null, $result);
        }

        function testSave()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);

            //act
            $test_review->save();

            //assert
            $result = Review::getAll();
            $this->assertEquals($test_review, $result[0]);
        }

        function testGetAll()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);
            $test_review->save();

            $name2 = 'Ann';
            $rating2 = 4;
            $review2 = 'Okay';
            $restaurant_id = 1;
            $id2 = null;
            $test_review2 = new Review($name2, $rating2, $review2, $id2, $restaurant_id);
            $test_review2->save();

            // Act
            $result = Review::getAll();

            // Assert
            $this->assertEquals([$test_review, $test_review2], $result);
        }

        function testDeleteAll()
        {
            // Arrange
            $name = 'Bob';
            $rating = 4;
            $review = 'Yum';
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($name, $rating, $review, $id, $restaurant_id);
            $test_review->save();

            // Act
            Review::deleteAll();

            // Assert
            $result = Review::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
