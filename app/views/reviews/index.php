<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">All Reviews</h1>
        <a href="/reviews/select-history" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Review
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Machine</th>
                            <th>Staff</th>
                           <th>remarks</th>
                            <th>Date</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reviews as $review): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['machine_name']); ?></td>
                            <td><?php echo htmlspecialchars($review['staff_matricule']); ?></td>
                            <td><?php echo htmlspecialchars($review['remarque']); ?></td>
                            
                            <td><?php echo date('Y-m-d', strtotime($review['created_at'])); ?></td>
                           
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>