<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Machines</h1>
        <a href="<?= base_url('machines/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Machine
    </a>    
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="machinesTable">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Work Time (min)</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($machines as $machine): ?>
    <tr>
        <td><?= htmlspecialchars($machine['matricule']) ?></td>
        <td><?= htmlspecialchars($machine['name']) ?></td>
        <td>
            <span class="badge bg-<?=
                $machine['status'] == 'active' ? 'success' :
                ($machine['status'] == 'inactive' ? 'danger' : 'warning')
            ?>">
                <?= ucfirst($machine['status']) ?>
            </span>
        </td>
        <td><?= htmlspecialchars($machine['worktime']) ?></td>
        <td><?= htmlspecialchars($machine['description']) ?></td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Actions
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/machines/edit/<?= $machine['id'] ?>">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statusModal<?= $machine['id'] ?>">
                            <i class="bi bi-arrow-repeat"></i> Update Status
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" data-bs-toggle="collapse" href="#history<?= $machine['id'] ?>" role="button" aria-expanded="false" aria-controls="history<?= $machine['id'] ?>">
                            <i class="bi bi-clock-history"></i> View History
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $machine['id'] ?>">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            
                                        <div class="modal fade" id="statusModal<?php echo $machine['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Machine Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="/machines/update-status/<?php echo $machine['id']; ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-select" required>
                                                                    <option value="active" <?php echo $machine['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo $machine['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                                    <option value="maintenance" <?php echo $machine['status'] == 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $machine['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Machine</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this machine?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="/machines/delete/<?php echo $machine['id']; ?>" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        </td>
    </tr>

    <!-- Collapsible History Row -->
    <tr class="collapse" id="history<?= $machine['id'] ?>">
        <td colspan="6">
            <div class="p-3 bg-light border rounded">
                <h6 class="mb-3">History for <?= htmlspecialchars($machine['matricule']) ?></h6>
                <?php if (!empty($machineHistories[$machine['id']])): ?>
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Description</th>
                                <th>Staff</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($machineHistories[$machine['id']] as $history): ?>
                                <tr>
                                    <td><?= htmlspecialchars($history['start_time']) ?></td>
                                    <td><?= htmlspecialchars($history['end_time']) ?></td>
                                    <td><?= htmlspecialchars($history['description']) ?></td>
                                    <td><?= htmlspecialchars($history['staff_id']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted mb-0">No history available for this machine.</p>
                <?php endif; ?>
            </div>
        </td>
    </tr>
<?php endforeach; ?>

                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#machinesTable').DataTable({
        "language": {
            "emptyTable": "No machines available"
        }
    });
});
</script>