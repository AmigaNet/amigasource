<?php

namespace AmigaSource\Data;

class LinkEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_links ORDER BY links_name ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function fetchByCategory($categoryId)
    {
        $sql = "SELECT * FROM t_links WHERE links_cat_1 = $categoryId OR links_cat_2 = $categoryId OR links_cat_3 = $categoryId OR links_cat_4 = $categoryId OR links_cat_5 = $categoryId OR links_cat_6 = $categoryId OR links_cat_7 = $categoryId OR links_cat_8 = $categoryId OR links_cat_9 = $categoryId OR links_cat_10 = $categoryId ORDER BY links_name ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function search($query)
    {
        $sql = "SELECT * FROM t_links WHERE links_name LIKE '%$query%' OR links_url LIKE '%$query%' OR links_desc LIKE '%$query%' ORDER BY links_name ASC";
        $result = $this->db->query($sql);
        $links = [];
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }
}
