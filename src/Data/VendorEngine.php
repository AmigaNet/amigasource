<?php

namespace AmigaSource\Data;

class VendorEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_vendor ORDER BY vendor_name ASC";
        $result = $this->db->query($sql);
        $shops = [];
        while ($row = $result->fetch_assoc()) {
            $shops[] = $row;
        }
        return $shops;
    }
}
