<?php

namespace Model\Dao;

use PDO;

class Reviews extends Dao
{
    public function get_reviews($seets_available = 1, $page = 0)
    {
        $offset = $page * 10;
        $sql = "SELECT r.image_url, t.name, t.id FROM reviews r
            JOIN tours t ON r.tour_id = t.id
            WHERE t.seats_available >= :seats_available
            ORDER BY r.id DESC
            LIMIT 10 OFFSET :offset
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':seats_available', $seets_available, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    public function validate($_data){
        if($_data["file"] == null){
            return true;
        }
        if($_data["visit_date"] == null ){
            return true;
        }
        if($_data["impressions"] == null ){
            return true;
        }
        if($_data["reserving_id"] == null ){
            return true;
        }

        return false;
    }
}
