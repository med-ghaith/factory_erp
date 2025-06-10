<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/PlanningModel.php';

class PlanningController extends Controller {
    private $planningModel;

    public function __construct() {
        parent::__construct();
        $this->planningModel = new PlanningModel();
    }

    public function index() {
       // $this->requireLogin();
        $plannings = $this->planningModel->getAll();
        $this->view('planning/index', ['plannings' => $plannings]);
    }

    public function create() {
       // $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'description' => $_POST['description']
            ];
            
            if ($this->planningModel->create($data)) {
                $this->redirect('/planning');
            } else {
                $error = "Failed to create planning";
                $this->view('planning/create', ['error' => $error]);
            }
        } else {
            $this->view('planning/create');
        }
    }

    public function edit($id) {
      //  $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'description' => $_POST['description']
            ];
            
            if ($this->planningModel->update($data)) {
                $this->redirect('/planning');
            } else {
                $error = "Failed to update planning";
                $planning = $this->planningModel->getById($id);
                $this->view('planning/edit', ['error' => $error, 'planning' => $planning]);
            }
        } else {
            $planning = $this->planningModel->getById($id);
            $this->view('planning/edit', ['planning' => $planning]);
        }
    }

    public function delete($id) {
       // $this->requireAdmin();
        $this->planningModel->delete($id);
        $this->redirect('/planning');
    }

    public function current() {
      //  $this->requireLogin();
        $currentPlanning = $this->planningModel->getCurrentPlanning();
        $nextPlanning = $this->planningModel->getNextPlanning();
        $this->view('planning/current', [
            'currentPlanning' => $currentPlanning,
            'nextPlanning' => $nextPlanning
        ]);
    }
}
?>
