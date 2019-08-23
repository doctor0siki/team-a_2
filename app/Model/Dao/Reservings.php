<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

class Reservings extends Dao{
  public function validate($data=[]){
    if($data["tour_id"] == ""){
      return true;
    }

    if($data["cs_name"] == ""){
      return true;
    }

    if($data["tell"] == ""){
      return true;
    }

    if($data["agent_store_id"] == ""){
      return true;
    }

    return false;
  }
}
