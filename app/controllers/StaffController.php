<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/StaffModel.php';
require_once __DIR__ . '/../models/PlanningModel.php';

class StaffController extends Controller {
    private $staffModel;
    private $planningModel;

    public function __construct() {
        parent::__construct();
        $this->staffModel = new StaffModel();
        $this->planningModel = new PlanningModel();
    }

    public function index() {
       // $this->requireLogin();
        $staff = $this->staffModel->getAll();
        $plannings = $this->planningModel->getAll();
        $this->view('staff/index', ['staff' => $staff, 'plannings' => $plannings]);
    }

    public function assignPlanning($staff_id) {
       // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planning_id = $_POST['planning_id'];
            if ($this->staffModel->updatePlanning($staff_id, $planning_id)) {
                $this->redirect('/staff');
            } else {
                $error = "Failed to assign planning";
                $this->view('staff/assign', ['error' => $error]);
            }
        } else {
            $staff = $this->staffModel->getById($staff_id);
            $plannings = $this->planningModel->getAll();
            $this->view('staff/assign', ['staff' => $staff, 'plannings' => $plannings]);
        }
    }

    public function create() {
      //  $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'matricule' => $_POST['matricule'],
                'name' => $_POST['name'],
                'level' => $_POST['level'],
                'planning_id' => $_POST['planning_id'] ?? null
            ];
            
            if ($this->staffModel->create($data)) {
                $this->redirect('/staff');
            } else {
                $error = "Failed to create staff member";
                $this->view('staff/create', ['error' => $error]);
            }
        } else {
            $plannings = $this->planningModel->getAll();
            $this->view('staff/create', ['plannings' => $plannings]);
        }
    }

    public function edit($id) {
        // $this->requireAdmin();
        
        $staff = $this->staffModel->getById($id);
        if (!$staff) {
            $this->redirect('/staff');
        }
        
        $plannings = $this->planningModel->getAll();
        $this->view('staff/edit', [
            'staff' => $staff,
            'plannings' => $plannings
        ]);
    }

    public function update($id) {
        // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'matricule' => $_POST['matricule'],
                'name' => $_POST['name'],
                'level' => $_POST['level'],
                'planning_id' => $_POST['planning_id'] ?? null
            ];
            
            if ($this->staffModel->update($id, $data)) {
                $this->redirect('/staff');
            } else {
                $error = "Failed to update staff member";
                $staff = $this->staffModel->getById($id);
                $plannings = $this->planningModel->getAll();
                $this->view('staff/edit', [
                    'staff' => $staff,
                    'plannings' => $plannings,
                    'error' => $error
                ]);
            }
        } else {
            $this->redirect('/staff');
        }
    }

    public function delete($id) {
        // $this->requireAdmin();
        
        if ($this->staffModel->delete($id)) {
            $this->redirect('/staff');
        } else {
            $error = "Failed to delete staff member";
            $this->view('staff/index', ['error' => $error]);
        }
    }
}
?>