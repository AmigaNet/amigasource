<?php

namespace AmigaSource\Data;

class LinkRatingEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function updateRatingForLink($id)
    {
        // Sum all of the ratings for the link
        $rating = $this->fetchRatingForLink($id);

        // Update the link with the new rating
        $sql = "UPDATE links SET rating = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $rating, $id);
        $stmt->execute();

        return true;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM link_ratings ORDER BY user_id, link_id ASC";
        $result = $this->db->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function fetchForLink($id)
    {
        $sql = "SELECT * FROM link_ratings WHERE link_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = [];
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        return $ratings;
    }

    public function fetchForUser($id)
    {
        $sql = "SELECT * FROM link_ratings WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = [];
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        return $ratings;
    }

    public function fetchRatingForLinkAndUser($link_id, $user_id)
    {
        $sql = "SELECT * FROM link_ratings WHERE link_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $link_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = [];
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
        if (sizeof($ratings) > 0) {
            return $ratings[0];
        }
        return null;
    }

    public function fetchRatingForLink($id)
    {
        $sql = "SELECT SUM(rating) AS rating FROM link_ratings WHERE link_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rating = $result->fetch_assoc();
        if ($rating !== null) {
            return $rating['rating'];
        }
        return 0;
    }

    public function insertRating($link_id, $user_id, $rating)
    {
        $sql = "INSERT INTO link_ratings (link_id, user_id, rating) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $link_id, $user_id, $rating);
        $stmt->execute();
        return true;
    }

    public function rateLink($link_id, $user_id, $rating)
    {
        // Check to see if the user has already rated the link
        $ratings = $this->fetchRatingForLinkAndUser($link_id, $user_id);

        // If the user has already rated the link, update the rating
        if ($ratings !== null) {
            $sql = "UPDATE link_ratings SET rating = ? WHERE link_id = ? AND user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('iii', $rating, $link_id, $user_id);
            $stmt->execute();
        } else {
            // If the user has not already rated the link, insert a new rating
            $this->insertRating($link_id, $user_id, $rating);
        }

        // Update the rating for the link
        $this->updateRatingForLink($link_id);

        return true;
    }

    public function updateAllRatings()
    {
        // In one SQL statement, update all of the ratings for all of the links
        $sql = "UPDATE links SET rating = (SELECT SUM(rating) FROM link_ratings WHERE link_id = links.id)";
        $this->db->query($sql);
        return true;
    }
}
