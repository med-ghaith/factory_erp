<?php
require_once 'Model.php';

class StockModel extends Model {
    protected $table = 'stock';

    public function __construct() {
        parent::__construct();
    }

    public function getByMatricule($matricule) {
        $query = "SELECT stock.*, machines.name as machine_name 
                  FROM stock 
                  LEFT JOIN machines ON machines.id = stock.machine_id 
                  WHERE stock.matricule = :matricule";
        $stmt = $this->executeQuery($query, ['matricule' => $matricule]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (matricule, machine_id, description, quantity) 
                  VALUES (:matricule, :machine_id, :description, :quantity)";
        return $this->executeQuery($query, $data);
    }

    public function updateQuantity($id, $quantity) {
        $query = "UPDATE {$this->table} SET quantity = :quantity WHERE id = :id";
        return $this->executeQuery($query, ['id' => $id, 'quantity' => $quantity]);
    }

    public function getByMachine($machine_id) {
        $query = "SELECT * FROM {$this->table} WHERE machine_id = :machine_id";
        $stmt = $this->executeQuery($query, ['machine_id' => $machine_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll() {
        $query = "
            SELECT stock.*, machines.matricule AS machine_matricule
            FROM stock
            LEFT JOIN machines ON stock.machine_id = machines.id
        ";
    
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // or FETCH_OBJ if you prefer
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} 
                  SET matricule = :matricule, 
                      machine_id = :machine_id, 
                      description = :description, 
                      quantity = :quantity 
                  WHERE id = :id";
        
        // Add the id to the data array for binding
        $data['id'] = $id;
        
        return $this->executeQuery($query, $data);
    }
    public function getLowStock($threshold = 10) {
        $query = "SELECT stock.*, machines.name as machine_name 
                  FROM stock 
                  LEFT JOIN machines ON machines.id = stock.machine_id 
                  WHERE stock.quantity <= :threshold 
                  ORDER BY stock.quantity ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':threshold', (int)$threshold, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalStockCount() {
        $query = "SELECT SUM(quantity) as total FROM stock";
        $stmt = $this->executeQuery($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
?>