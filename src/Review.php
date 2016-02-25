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
    }
?>
