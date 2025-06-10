<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/ReviewModel.php';
require_once __DIR__ . '/../models/HistoryModel.php';

class ReviewController extends Controller {
    private $reviewModel;
    private $historyModel;

    public function __construct() {
        parent::__construct();
        $this->reviewModel = new ReviewModel();
        $this->historyModel = new HistoryModel();
    }

    public function index() {
        $this->requireLogin();
        $reviews = $this->reviewModel->getAllWithDetails();
        $this->view('reviews/index', ['reviews' => $reviews]);
    }

    public function create($history_id) {
        $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'history_id' => $history_id,
                'quality_score' => $_POST['quality_score'],
                'efficiency_score' => $_POST['efficiency_score'],
                'safety_score' => $_POST['safety_score'],
                'remark' => $_POST['remark']
            ];
            
            if ($this->reviewModel->create($data)) {
                $this->redirect('/reviews');
            } else {
                $error = "Failed to create review";
                $history = $this->historyModel->getById($history_id);
                $this->view('reviews/create', ['error' => $error, 'history' => $history]);
            }
        } else {
            $history = $this->historyModel->getById($history_id);
            $this->view('reviews/create', ['history' => $history]);
        }
    }

    public function viewReview($id) {
        $this->requireLogin();
        $review = $this->reviewModel->getByHistory($id);
        $this->view('reviews/view', ['review' => $review]);
    }
}
?>