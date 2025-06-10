<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Production History</h1>
        <a href="/history/create" class="btn btn-primary">
            <i class="bi bi-plus"></i> New Production Record
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th>Machine</th>
                            <th>Staff</th>
                            <th>Stock</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Description</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $record): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($record['machine_name']); ?></td>
                                <td><?php echo htmlspecialchars($record['staff_matricule']); ?></td>
                                <td><?php echo htmlspecialchars($record['stock_matricule']); ?></td>
                                <td><?php echo date('d M Y H:i', strtotime($record['start_time'])); ?></td>
                                <td>
                                    <?php 
                                    echo $record['end_time'] 
                                        ? date('d M Y H:i', strtotime($record['end_time']))
                                        : '<span class="text-muted">In Progress</span>';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($record['end_time']) {
                                        $start = new DateTime($record['start_time']);
                                        $end = new DateTime($record['end_time']);
                                        $duration = $start->diff($end);
                                        echo $duration->format('%Hh %im');
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $record['end_time'] ? 'success' : 'warning'; ?>">
                                        <?php echo $record['end_time'] ? 'Completed' : 'In Progress'; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($record['description']); ?></td>
                                <td>
                                    <?php if (!$record['end_time']): ?>
                                        <a href="/history/complete/<?php echo $record['id']; ?>" 
                                           class="btn btn-sm btn-success" 
                                           title="Mark as Complete">
                                            <i class="bi bi-check-circle"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 