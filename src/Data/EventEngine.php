<?php

namespace AmigaSource\Data;

class EventEngine
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function fetchUpcoming()
    {
        $sql = "SELECT * FROM t_cal WHERE cal_date_start >= CURDATE() ORDER BY cal_date_start ASC";

        $result = $this->db->query($sql);
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        return $events;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM t_cal ORDER BY cal_date_start ASC";
        $result = $this->db->query($sql);
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        return $events;
    }
}
