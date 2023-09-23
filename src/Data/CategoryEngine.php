<?php

namespace AmigaSource\Data;

class CategoryEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_cat_main ORDER BY cat_main_title ASC";
        $result = $this->db->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }
}
