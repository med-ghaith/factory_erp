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
       // $this->requireLogin();
        $reviews = $this->reviewModel->getAllWithDetails();
        
        $this->view('reviews/index', ['reviews' => $reviews]);
    }
    public function selectHistory() {
        // $this->requireLogin();
        $histories = $this->historyModel->getUnreviewedHistories();
        $this->view('reviews/select-history', ['histories' => $histories]);
    }

    public function create($history_id) {
      //  $this->requireAdmin();
        
        $history = $this->historyModel->getById($history_id);
       
        if (!$history) {
            $this->redirect('/reviews');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'history_id' => $history_id,
                'criteria_g' => $_POST['criteria_g'],
                'criteria_f' => $_POST['criteria_f'],
                'criteria_n' => $_POST['criteria_n'],
                'remarque' => $_POST['remarque']
            ];
            
            if ($this->reviewModel->create($data)) {
                $_SESSION['success'] = 'Review created successfully';
                $this->redirect('/reviews');
            } else {
                $error = "Failed to create review";
                $this->view('reviews/create', [
                    'error' => $error,
                    'history' => $history
                ]);
            }
        } else {
            $this->view('reviews/create', ['history' => $history]);
        }
    }

    public function viewReview($id) {
        $this->requireLogin();
        $review = $this->reviewModel->getByHistory($id);
        if (!$review) {
            $this->redirect('/reviews');
        }
        $this->view('reviews/view', ['review' => $review]);
    }
}
?>