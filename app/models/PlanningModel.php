<?php
require_once 'Model.php';

class PlanningModel extends Model {
    protected $table = 'planning';

    public function __construct() {
        parent::__construct();
    }

    public function getCurrentPlanning() {
        $current_time = date('H:i:s');
        $query = "SELECT * FROM {$this->table} 
                  WHERE start_time <= :current_time 
                  AND end_time > :current_time";
        $stmt = $this->executeQuery($query, ['current_time' => $current_time]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNextPlanning() {
        $current_time = date('H:i:s');
        $query = "SELECT * FROM {$this->table} 
                  WHERE start_time > :current_time 
                  ORDER BY start_time ASC 
                  LIMIT 1";
        $stmt = $this->executeQuery($query, ['current_time' => $current_time]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>