<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/MachineModel.php';
require_once __DIR__ . '/../models/StaffModel.php';
require_once __DIR__ . '/../models/HistoryModel.php';
require_once __DIR__ . '/../models/PlanningModel.php';
require_once __DIR__ . '/../models/StockModel.php';

class DashboardController extends Controller {
    private $machineModel;
    private $staffModel;
    private $historyModel;
    private $planningModel;
    private $stockModel;

    public function __construct() {
        parent::__construct();
        $this->machineModel = new MachineModel();
        $this->staffModel = new StaffModel();
        $this->historyModel = new HistoryModel();
        $this->planningModel = new PlanningModel();
        $this->stockModel = new StockModel();
    }

    public function index() {
       // $this->requireLogin();
        
        // Get current planning
        $totalMachines = count($this->machineModel->getAll());
        $totalStock = $this->stockModel->getTotalStockCount();
        $totalStaff = count($this->staffModel->getAll());
        $totalHistory = count($this->historyModel->getAll());
        
        // Get current planning
        $currentPlanning = $this->planningModel->getCurrentPlanning();
        $nextPlanning = $this->planningModel->getNextPlanning();
        
        // Get active machines
        $activeMachines = $this->machineModel->getByStatus('active');
        
        // Get recent history
        $recentHistory = $this->historyModel->getRecent(5);
        
        // Get low stock items
        $lowStock = $this->stockModel->getLowStock();
        
        $this->view('dashboard/index', [
            'total_machines' => $totalMachines,
            'total_stock' => $totalStock,
            'total_staff' => $totalStaff,
            'total_history' => $totalHistory,
            'current_planning' => $currentPlanning,
            'next_planning' => $nextPlanning,
            'active_machines' => $activeMachines,
            'recent_history' => $recentHistory,
            'low_stock' => $lowStock
        ]);
    }

    public function statistics() {
       // $this->requireAdmin();
        
        // Get machine statistics
        $machineStats = $this->machineModel->getStatistics();
        
        // Get staff statistics
        $staffStats = $this->staffModel->getStatistics();
        
        // Get history statistics
        $historyStats = $this->historyModel->getStatistics();
        
        // Get stock statistics
        $stockStats = $this->stockModel->getStatistics();
        
        $this->view('dashboard/statistics', [
            'machineStats' => $machineStats,
            'staffStats' => $staffStats,
            'historyStats' => $historyStats,
            'stockStats' => $stockStats
        ]);
    }
}
?>
