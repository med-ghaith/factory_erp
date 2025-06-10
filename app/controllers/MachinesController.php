<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/MachineModel.php';

class MachinesController extends Controller {
    private $machineModel;

    public function __construct() {
        parent::__construct();
        $this->machineModel = new MachineModel();
    }

    public function index() {
        //$this->requireLogin();
        $machines = $this->machineModel->getAll();
       
        $this->view('machines/index', ['machines' => $machines]);
    }
    protected function validateMachineData($data) {
        $errors = [];
        
        if (empty($data['matricule'])) {
            $errors['matricule'] = 'Matricule is required';
        }
        
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        
        if (empty($data['status']) || !in_array($data['status'], ['active', 'inactive', 'maintenance'])) {
            $errors['status'] = 'Invalid status';
        }
        
        if (empty($data['worktime']) || !is_numeric($data['worktime'])) {
            $errors['worktime'] = 'Work time must be a number';
        }
        
        return $errors;
    }

    public function create() {
       // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'matricule' => $_POST['matricule'],
                'name' => $_POST['name'],
                'status' => $_POST['status'],
                'worktime' => $_POST['worktime'],
                'description' => $_POST['description']
            ];
            $errors = $this->validateMachineData($_POST);
            if ($this->machineModel->create($data)) {
                $this->redirect('/machines');
            } else {
                $error = "Failed to create machine";
                $this->view('machines/create', ['errors' => $errors,'error' => $error]);
            }
        } else {
            $this->view('machines/create');
        }
    }

    public function updateStatus($id) {
       // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            if ($this->machineModel->updateStatus($id, $status)) {
                $this->redirect('/machines');
            } else {
                $error = "Failed to update machine status";
                $this->view('machines/edit', ['error' => $error]);
            }
        }
    }

    public function edit($id) {
       // $this->requireAdmin();
        $machine = $this->machineModel->getById($id);if (!$machine) {
            $this->redirect('/machines'); // or show 404
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'matricule' => $_POST['matricule'] ?? '',
                'name' => $_POST['name'] ?? '',
                'status' => $_POST['status'] ?? '',
                'worktime' => $_POST['worktime'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];
    
            $errors = $this->validateMachineData($data);
    
            if (empty($errors)) {
                $success = $this->machineModel->update($id, $data);
                if ($success) {
                    $this->redirect('/machines');
                    return;
                } else {
                    $error = "Failed to update machine.";
                }
            }
    
            // Show the form with validation errors
            $data['id'] = $id; // so view has ID
            $this->view('machines/edit', [
                'machine' => $data,
                'errors' => $errors,
                'error' => $error ?? null
            ]);
    
        } else {
            // Show the edit form with existing machine data
            $this->view('machines/edit', ['machine' => $machine]);
        }
    }

    public function delete($id) {
       // $this->requireAdmin();
        $this->machineModel->delete($id);
        $this->redirect('/machines');
    }
}
?>