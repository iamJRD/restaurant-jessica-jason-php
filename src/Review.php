<?php
    class Review
    {
        private $user_name;
        private $user_rating;
        private $user_review;
        private $id;
        private $restaurant_id;

        function __construct($user_name, $user_rating, $user_review, $id = null, $restaurant_id)
        {
            $this->user_name = $user_name;
            $this->user_rating = $user_rating;
            $this->user_review = $user_review;
            $this->id = $id;
            $this->restaurant_id = $restaurant_id;
        }
// SETTERS
        function setUserName($new_user_name)
        {
            $this->user_name = $new_user_name;
        }

        function setUserRating($new_user_rating)
        {
            $this->user_rating = $new_user_rating;
        }

        function setUserReview($new_user_review)
        {
            $this->user_review = $new_user_review;
        }
// GETTERS
        function getUserName()
        {
            return $this->user_name;
        }

        function getUserRating()
        {
            return $this->user_rating;
        }

        function getUserReview()
        {
            return $this->user_review;
        }

        function getId()
        {
            return $this->id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (user_name, user_rating, user_review, restaurant_id) VALUES ('{$this->getUserName()}', {$this->getUserRating()}, '{$this->getUserReview()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query('SELECT * FROM reviews');
            $reviews = array();
            foreach($returned_reviews as $review) {
                $user_name = $review['user_name'];
                $user_rating = $review['user_rating'];
                $user_review = $review['user_review'];
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review($user_name, $user_rating, $user_review, $id, $restaurant_id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function find($search_id)
        {
            $found_review = null;
            $reviews = Review::getAll();
            foreach($reviews as $review)
            {
                $review_id = $review->getId();
                if($review_id == $search_id)
                {
                    $found_review = $review;
                }
            }
            return $found_review;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM reviews');
        }

        function deleteReview()
		{
			$GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = {$this->getId()};");
		}

    }
?>
