<?php
require_once 'Model.php';

class UserModel extends Model {
    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function login($matricule, $password) {
        $query = "SELECT * FROM {$this->table} WHERE matricule = :matricule";
        $stmt = $this->executeQuery($query, ['matricule' => $matricule]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
       
        if ($user && password_verify($password, $user['password'])) {
           var_dump($user);
            return $user;
        }
        return false;
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table} (matricule, password, name, role) 
                  VALUES (:matricule, :password, :name, :role)";
        return $this->executeQuery($query, $data);
    }

    public function update($id, $data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['id'] = $id;
        $query = "UPDATE {$this->table} SET 
                  matricule = :matricule, 
                  name = :name, 
                  role = :role 
                  WHERE id = :id";
        return $this->executeQuery($query, $data);
    }
}
?>