<?php

namespace managers;

use managers\AbstractManager;
use models\Review;

class ReviewManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createReview(Review $review): bool
    {
        $query = $this->db->prepare("INSERT INTO reviews VALUES (:id, :user_id, :album_id, :title, :content, :date)");
    }

}