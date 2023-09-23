<?php

namespace AmigaSource\Data;

class NewsEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchActive($limit = -1)
    {
        $sql = "SELECT * FROM t_news WHERE news_active = 1 ORDER BY news_date DESC";
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
        $sql = "SELECT * FROM t_news ORDER BY news_date DESC";
        $result = $this->db->query($sql);
        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
        return $news;
    }
}
