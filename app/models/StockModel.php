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
        $query = "INSERT INTO {$this->table} (matricule, description, quantity) 
              VALUES (:matricule, :description, :quantity)";
    $stmt = $this->executeQuery($query, $data);
    return $this->db->lastInsertId();  // Return new stock ID
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
        SELECT 
            stock.*, 
            GROUP_CONCAT(machines.matricule SEPARATOR ', ') AS machine_matricules
        FROM stock
        LEFT JOIN stock_machine ON stock.id = stock_machine.stock_id
        LEFT JOIN machines ON machines.id = stock_machine.machine_id
        GROUP BY stock.id
    ";

    $stmt = $this->executeQuery($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
       // 1. Update the stock table
    $query = "UPDATE {$this->table} 
              SET matricule = :matricule, 
                  description = :description, 
                  quantity = :quantity 
              WHERE id = :id";

    $this->executeQuery($query, [
        'matricule' => $data['matricule'],
        'description' => $data['description'],
        'quantity' => $data['quantity'],
        'id' => $id
    ]);

    // 2. Remove old machine links
    $this->executeQuery("DELETE FROM stock_machine WHERE stock_id = :stock_id", [
        'stock_id' => $id
    ]);

    // 3. Insert new machine links
    foreach ($data['machine_ids'] as $machineId) {
        $this->executeQuery("INSERT INTO stock_machine (stock_id, machine_id) VALUES (:stock_id, :machine_id)", [
            'stock_id' => $id,
            'machine_id' => $machineId
        ]);
    }

    return true;
    }
    public function getLowStock($threshold = 10) {
        $query = "
        SELECT 
            stock.*, 
            GROUP_CONCAT(machines.name SEPARATOR ', ') AS machine_names
        FROM stock
        LEFT JOIN stock_machine ON stock.id = stock_machine.stock_id
        LEFT JOIN machines ON machines.id = stock_machine.machine_id
        WHERE stock.quantity <= :threshold
        GROUP BY stock.id
        ORDER BY stock.quantity ASC
    ";

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
    public function getById($id) {
    $query = "SELECT * FROM stock WHERE id = :id";
    $stmt = $this->executeQuery($query, ['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function deductQuantity($stock_id, $used_quantity) {
    $query = "UPDATE stock SET quantity = quantity - :used_quantity WHERE id = :stock_id AND quantity >= :used_quantity";
    return $this->executeQuery($query, [
        'stock_id' => $stock_id,
        'used_quantity' => $used_quantity
    ]);
}
public function attachMachines($stock_id, $machine_ids) {
    $query = "INSERT INTO stock_machine (stock_id, machine_id) VALUES (:stock_id, :machine_id)";
    $stmt = $this->db->prepare($query);
    foreach ($machine_ids as $machine_id) {
        $stmt->execute(['stock_id' => $stock_id, 'machine_id' => $machine_id]);
    }
}

public function getMachinesForStock($stock_id) {
    $query = "SELECT machine_id FROM stock_machine WHERE stock_id = :stock_id";
    $stmt = $this->executeQuery($query, ['stock_id' => $stock_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
public function getByIdWithMachines($id) {
    // Get stock item
    $query = "SELECT * FROM {$this->table} WHERE id = :id";
    $stmt = $this->executeQuery($query, ['id' => $id]);
    $stock = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get associated machines
    $stmt = $this->executeQuery("SELECT machine_id FROM stock_machine WHERE stock_id = :id", ['id' => $id]);
    $machineIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $stock['machine_ids'] = $machineIds;
    return $stock;
}
}
?>