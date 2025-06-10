<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Current Planning</h1>
        <a href="<?php echo base_url('planning'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Planning
        </a>
    </div>
    
    <div class="row">
        <!-- Current Planning -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Schedule</h5>
                </div>
                <div class="card-body">
                    <?php if($currentPlanning): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Time</h6>
                            <span class="badge bg-primary">
                                <?php echo date('H:i', strtotime($currentPlanning->start_time)); ?> - 
                                <?php echo date('H:i', strtotime($currentPlanning->end_time)); ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2">Description</h6>
                            <p class="mb-0"><?php echo $currentPlanning->description; ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No current planning schedule</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Next Planning -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Next Schedule</h5>
                </div>
                <div class="card-body">
                    <?php if($nextPlanning): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Time</h6>
                            <span class="badge bg-info">
                                <?php echo date('H:i', strtotime($nextPlanning->start_time)); ?> - 
                                <?php echo date('H:i', strtotime($nextPlanning->end_time)); ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2">Description</h6>
                            <p class="mb-0"><?php echo $nextPlanning->description; ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No upcoming planning schedule</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 