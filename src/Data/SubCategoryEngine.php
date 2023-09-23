<?php

namespace AmigaSource\Data;

class SubCategoryEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_cat_sub ORDER BY cat_sub_title ASC";
        $result = $this->db->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function fetchByParent($parent)
    {
        $sql = "SELECT * FROM t_cat_sub WHERE cat_sub_ref_main_id = $parent ORDER BY cat_sub_title ASC";
        $result = $this->db->query($sql);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }
}
