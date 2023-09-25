<?php

namespace AmigaSource\Data;

class MagazineEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchOnline()
    {
        $sql = "SELECT * FROM t_mags_online ORDER BY online_name ASC";
        $result = $this->db->query($sql);
        $magazines = [];
        while ($row = $result->fetch_assoc()) {
            $magazines[] = $row;
        }
        return $magazines;
    }

    public function fetchPrint()
    {
        $sql = "SELECT * FROM t_mags_print ORDER BY print_name ASC";
        $result = $this->db->query($sql);
        $magazines = [];
        while ($row = $result->fetch_assoc()) {
            $magazines[] = $row;
        }
        return $magazines;
    }
}
