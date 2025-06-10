<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/HistoryModel.php';
require_once __DIR__ . '/../models/MachineModel.php';
require_once __DIR__ . '/../models/StaffModel.php';
require_once __DIR__ . '/../models/StockModel.php';

class HistoryController extends Controller {
    private $historyModel;
    private $machineModel;
    private $staffModel;
    private $stockModel;

    public function __construct() {
        parent::__construct();
        $this->historyModel = new HistoryModel();
        $this->machineModel = new MachineModel();
        $this->staffModel = new StaffModel();
        $this->stockModel = new StockModel();
    }

    public function index() {
       // $this->requireLogin();
        $history = $this->historyModel->getRecent(20);
        $this->view('history/index', ['history' => $history]);
    }

    public function create() {
      //  $this->requireLogin();
        
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'machine_id' => $_POST['machine_id'],
            'staff_id' => $_POST['staff_id'],
            'stock_id' => $_POST['stock_id'],
            'start_time' => $_POST['start_time'] ?? date('Y-m-d H:i:s'),
            'end_time' => $_POST['end_time'] ?? date('Y-m-d H:i:s'),
            'description' => $_POST['description']
        ];

        if ($this->historyModel->create($data)) {
            $this->redirect('/history');
        } else {
            $error = "Failed to create history record";
            $this->loadFormData($error);
        }
    } else {
        $this->loadFormData();
    }
}

private function loadFormData($error = null) {
    $machines = $this->machineModel->getAll();
    $staff = $this->staffModel->getAll();
    $stock = $this->stockModel->getAll();

    $this->view('history/create', [
        'error' => $error,
        'machines' => $machines,
        'staff' => $staff,
        'stock' => $stock
    ]);
}
    public function complete($id) {
     //   $this->requireLogin();
        $end_time = date('Y-m-d H:i:s');
        $this->historyModel->complete($id, $end_time);
        $this->redirect('/history');
    }
}
?>