<?php
require_once 'Model.php';

class ReviewModel extends Model {
    protected $table = 'reviews';

    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (history_id, quality_score, efficiency_score, safety_score, remark) 
                  VALUES (:history_id, :quality_score, :efficiency_score, :safety_score, :remark)";
        return $this->executeQuery($query, $data);
    }

    public function getByHistory($history_id) {
        $query = "SELECT r.*, h.machine_id, h.staff_id, m.name as machine_name, s.matricule as staff_matricule
                  FROM reviews r
                  JOIN history h ON h.id = r.history_id
                  JOIN machines m ON m.id = h.machine_id
                  JOIN staff s ON s.id = h.staff_id
                  WHERE r.history_id = :history_id";
        $stmt = $this->executeQuery($query, ['history_id' => $history_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllWithDetails() {
        $query = "SELECT r.*, h.machine_id, h.staff_id, m.name as machine_name, s.matricule as staff_matricule
                  FROM reviews r
                  JOIN history h ON h.id = r.history_id
                  JOIN machines m ON m.id = h.machine_id
                  JOIN staff s ON s.id = h.staff_id
                  ORDER BY r.created_at DESC";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>