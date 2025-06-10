<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/StockModel.php';
require_once __DIR__ . '/../models/MachineModel.php';

class StockController extends Controller {
    private $stockModel;
    private $machineModel;

    public function __construct() {
        parent::__construct();
        $this->stockModel = new StockModel();
        $this->machineModel = new MachineModel();
    }

    public function index() {
       // $this->requireLogin();
        $stock = $this->stockModel->getAll();
        $this->view('stock/index', ['stock' => $stock]);
    }

    public function create() {
      //  $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'matricule' => $_POST['matricule'],
                'machine_id' => $_POST['machine_id'],
                'description' => $_POST['description'],
                'quantity' => $_POST['quantity']
            ];
            
            if ($this->stockModel->create($data)) {
                $this->redirect('/stock');
            } else {
                $error = "Failed to create stock item";
                $machines = $this->machineModel->getAll();
                $this->view('stock/create', ['error' => $error, 'machines' => $machines]);
            }
        } else {
            $machines = $this->machineModel->getAll();
            $this->view('stock/create', ['machines' => $machines]);
        }
    }

    public function edit($id) {
       // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'matricule' => $_POST['matricule'],
                'machine_id' => $_POST['machine_id'],
                'description' => $_POST['description'],
                'quantity' => $_POST['quantity']
            ];
            
            if ($this->stockModel->update($id,$data)) {
                $this->redirect('/stock');
            } else {
                $error = "Failed to update stock item";
                $stock = $this->stockModel->getById($id);
                $machines = $this->machineModel->getAll();
                $this->view('stock/edit', [
                    'error' => $error,
                    'stock' => $stock,
                    'machines' => $machines
                ]);
            }
        } else {
            $stock = $this->stockModel->getById($id);
            $machines = $this->machineModel->getAll();
            $this->view('stock/edit', ['stock' => $stock, 'machines' => $machines]);
        }
    }

    public function updateQuantity($id) {
      //  $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = $_POST['quantity'];
            if ($this->stockModel->updateQuantity($id, $quantity)) {
                $this->redirect('/stock');
            } else {
                $error = "Failed to update quantity";
                $stock = $this->stockModel->getById($id);
                $this->view('stock/edit', ['error' => $error, 'stock' => $stock]);
            }
        }
    }

    public function delete($id) {
     //   $this->requireAdmin();
        $this->stockModel->delete($id);
        $this->redirect('/stock');
    }

    public function byMachine($machine_id) {
       // $this->requireLogin();
        $stock = $this->stockModel->getByMachine($machine_id);
        $machine = $this->machineModel->getById($machine_id);
        $this->view('stock/by_machine', [
            'stock' => $stock,
            'machine' => $machine
        ]);
    }
}
?>
