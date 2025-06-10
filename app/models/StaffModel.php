<?php
require_once 'Model.php';

class StaffModel extends Model {
    protected $table = 'staff';

    public function __construct() {
        parent::__construct();
    }

    public function getByMatricule($matricule) {
        $query = "SELECT staff.*, planning.name as planning_name 
                  FROM staff 
                  LEFT JOIN planning ON planning.id = staff.planning_id 
                  WHERE staff.matricule = :matricule";
        $stmt = $this->executeQuery($query, ['matricule' => $matricule]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (matricule, name, level, planning_id) 
                  VALUES (:matricule, :name, :level, :planning_id)";
        return $this->executeQuery($query, $data);
    }

    public function updatePlanning($id, $planning_id) {
        $query = "UPDATE {$this->table} SET planning_id = :planning_id WHERE id = :id";
        return $this->executeQuery($query, ['id' => $id, 'planning_id' => $planning_id]);
    }

    public function getByPlanning($planning_id) {
        $query = "SELECT * FROM {$this->table} WHERE planning_id = :planning_id";
        $stmt = $this->executeQuery($query, ['planning_id' => $planning_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->executeQuery($query, ['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $data) {
        $query = "UPDATE {$this->table} 
                  SET matricule = :matricule, name = :name, level = :level, planning_id = :planning_id 
                  WHERE id = :id";
        $data['id'] = $id;
        return $this->executeQuery($query, $data);
    }
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->executeQuery($query, ['id' => $id]);
    }
}
?>