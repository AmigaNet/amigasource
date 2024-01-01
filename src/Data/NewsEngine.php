<?php

namespace AmigaSource\Data;

class NewsEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM news_articles WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function fetchActive($limit = -1)
    {
        $sql = "SELECT * FROM news_articles WHERE is_active = 1 ORDER BY date_added DESC";
        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->db->query($sql);
        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM news_articles ORDER BY date_added DESC";
        $result = $this->db->query($sql);
        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }

    public function fetch($id)
    {
        $sql = "SELECT * FROM news_articles WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = $result->fetch_assoc();
        return $news;
    }

    public function insert($title, $story, $is_active)
    {
        $sql = "INSERT INTO news_articles (`title`, `story`, `is_active`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssi', $title, $story, $is_active);
        $stmt->execute();
        $id = $this->db->insert_id;

        return $id;
    }

    public function update($id, $title, $story, $is_active)
    {
        $sql = "UPDATE news_articles SET title = ?, story = ?, is_active = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssii', $title, $story, $is_active, $id);
        $stmt->execute();
    }
}
