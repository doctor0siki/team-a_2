<?php
namespace Model\Dao;
use PDO;

class Tours extends Dao {
    public function getTour($_id = 0){
        if(intval($_id) == 0){
            return null;
        }
        $sql = "SELECT  * FROM tours WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->shaped($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function reviews($_id){
        if(intval($_id) == 0){
            return [];
        }
        $sql = "SELECT * FROM reviews WHERE tour_id = :_id
            ORDER BY id DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':_id', $_id, PDO::PARAM_INT);
        $stmt->execute();
        $ret = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $ret[] = $row;
        }
        return $ret;
    }

    protected function shaped($row){
        $locations = explode(',', $row['destination']);
        $row['locations'] = $locations;
        return $row;
    }
}