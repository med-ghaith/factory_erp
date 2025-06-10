<?php
require_once 'Model.php';

class MachineModel extends Model {
    protected $table = 'machines';

    public function __construct() {
        parent::__construct();
    }

    public function getByMatricule($matricule) {
        $query = "SELECT * FROM {$this->table} WHERE matricule = :matricule";
        $stmt = $this->executeQuery($query, ['matricule' => $matricule]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (matricule, name, status, worktime, description) 
                  VALUES (:matricule, :name, :status, :worktime, :description)";
        return $this->executeQuery($query, $data);
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        return $this->executeQuery($query, ['id' => $id, 'status' => $status]);
    }

    public function getByStatus($status) {
        $query = "SELECT * FROM {$this->table} WHERE status = :status";
        $stmt = $this->executeQuery($query, ['status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $data) {
        $query = "UPDATE {$this->table} 
                  SET matricule = :matricule, 
                      name = :name, 
                      status = :status, 
                      worktime = :worktime, 
                      description = :description 
                  WHERE id = :id";
        
        // Ensure ID is included in parameters
        $data['id'] = $id;
    
        return $this->executeQuery($query, $data);
    }
}
?>