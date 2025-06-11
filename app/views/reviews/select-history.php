<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Select History to Review</h1>
        <a href="/reviews" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Reviews
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
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($histories as $history): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($history['machine_name']); ?></td>
                            <td><?php echo htmlspecialchars($history['staff_matricule']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($history['start_time'])); ?></td>
                            <td><?php echo $history['end_time'] ? date('Y-m-d H:i', strtotime($history['end_time'])) : 'Ongoing'; ?></td>
                            <td>
                                <a href="/reviews/create/<?php echo $history['id']; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Add Review
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>