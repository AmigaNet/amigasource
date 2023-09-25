<?php

namespace AmigaSource\Data;

class RepairShopEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_repair ORDER BY repair_name ASC";
        $result = $this->db->query($sql);
        $shops = [];
        while ($row = $result->fetch_assoc()) {
            $shops[] = $row;
        }
        return $shops;
    }
}
