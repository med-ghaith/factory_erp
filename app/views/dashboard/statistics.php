<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">System Statistics</h1>
        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
    
    <div class="row">
        <!-- Machine Statistics -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Machine Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Total Machines</h6>
                                <h3><?php echo $machineStats['total']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Active Machines</h6>
                                <h3><?php echo $machineStats['active']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Inactive Machines</h6>
                                <h3><?php echo $machineStats['inactive']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">In Maintenance</h6>
                                <h3><?php echo $machineStats['maintenance']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Staff Statistics -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Staff Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Total Staff</h6>
                                <h3><?php echo $staffStats['total']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">On Duty</h6>
                                <h3><?php echo $staffStats['on_duty']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Average Experience</h6>
                                <h3><?php echo $staffStats['avg_experience']; ?> years</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- History Statistics -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">History Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Total Records</h6>
                                <h3><?php echo $historyStats['total']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Completed Today</h6>
                                <h3><?php echo $historyStats['completed_today']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Average Duration</h6>
                                <h3><?php echo $historyStats['avg_duration']; ?> min</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stock Statistics -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Stock Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Total Items</h6>
                                <h3><?php echo $stockStats['total']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Low Stock Items</h6>
                                <h3><?php echo $stockStats['low_stock']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="mb-2">Total Quantity</h6>
                                <h3><?php echo $stockStats['total_quantity']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 