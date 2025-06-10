<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard</h1>
    
    <div class="row">
        <!-- Machine Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Machines</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($total_machines); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-gear fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stock Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Stock Items</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($total_stock); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Staff Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Staff</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($total_staff); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- History Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total History</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($total_history); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Planning Section -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Current Planning</h6>
                </div>
                <div class="card-body">
                    <?php if($current_planning): ?>
                        <h4><?php echo htmlspecialchars($current_planning['name']); ?></h4>
                        <p>Time: <?php echo date('h:i A', strtotime($current_planning['start_time'])); ?> - <?php echo date('h:i A', strtotime($current_planning['end_time'])); ?></p>
                    <?php else: ?>
                        <p>No current planning</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Next Planning</h6>
                </div>
                <div class="card-body">
                    <?php if($next_planning): ?>
                        <h4><?php echo htmlspecialchars($next_planning['name']); ?></h4>
                        <p>Time: <?php echo date('h:i A', strtotime($next_planning['start_time'])); ?> - <?php echo date('h:i A', strtotime($next_planning['end_time'])); ?></p>
                    <?php else: ?>
                        <p>No next planning</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent History Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent History</h6>
                    <a href="/history" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Machine</th>
                                    <th>Staff</th>
                                    <th>Stock</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_history as $history): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($history['machine_name']); ?></td>
                                        <td><?php echo htmlspecialchars($history['staff_matricule']); ?></td>
                                        <td><?php echo htmlspecialchars($history['stock_matricule']); ?></td>
                                        <td><?php echo date('Y-m-d H:i', strtotime($history['start_time'])); ?></td>
                                        <td><?php echo $history['end_time'] ? date('Y-m-d H:i', strtotime($history['end_time'])) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars($history['description']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Low Stock Section -->
    <?php if(!empty($low_stock)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">Low Stock Items (≤ 10 remaining)</h6>
                    <a href="/stock" class="btn btn-sm btn-danger">Manage Stock</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Machine</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($low_stock as $item): ?>
                                    <tr class="<?php echo $item['quantity'] <= 5 ? 'table-danger' : 'table-warning'; ?>">
                                        <td><?php echo htmlspecialchars($item['matricule']); ?></td>
                                        <td><?php echo htmlspecialchars($item['machine_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}
</style>