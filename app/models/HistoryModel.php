<?php
require_once 'Model.php';

class HistoryModel extends Model {
    protected $table = 'history';

    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (machine_id, staff_id, stock_id, start_time, end_time, description) 
                  VALUES (:machine_id, :staff_id, :stock_id, :start_time, :end_time, :description)";
        return $this->executeQuery($query, $data);
    }

    public function complete($id, $end_time) {
        $query = "UPDATE {$this->table} SET end_time = :end_time WHERE id = :id";
        return $this->executeQuery($query, ['id' => $id, 'end_time' => $end_time]);
    }

    public function getRecent($limit = 5) {
        $query = "SELECT h.*, m.name as machine_name, s.matricule as staff_matricule, st.matricule as stock_matricule
                  FROM history h
                  JOIN machines m ON m.id = h.machine_id
                  JOIN staff s ON s.id = h.staff_id
                  JOIN stock st ON st.id = h.stock_id
                  ORDER BY h.start_time DESC
                  LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByMachine($machine_id) {
        $query = "SELECT * FROM {$this->table} WHERE machine_id = :machine_id ORDER BY start_time DESC";
        $stmt = $this->executeQuery($query, ['machine_id' => $machine_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnreviewedHistories() {
        $query = "SELECT h.*, m.name as machine_name, s.matricule as staff_matricule
                  FROM history h
                  JOIN machines m ON m.id = h.machine_id
                  JOIN staff s ON s.id = h.staff_id
                  LEFT JOIN reviews r ON r.history_id = h.id
                  WHERE r.id IS NULL
                  ORDER BY h.start_time DESC";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getHistoryByMachine($machine_id) {
        $query = "SELECT h.*, s.matricule as staff_matricule 
                  FROM history h
                  JOIN staff s ON s.id = h.staff_id
                  WHERE h.machine_id = :machine_id
                  ORDER BY h.start_time DESC";
        $stmt = $this->executeQuery($query, ['machine_id' => $machine_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>