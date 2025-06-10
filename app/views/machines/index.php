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
                        <?php if (!empty($machines) && is_array($machines)): ?>
                            <?php foreach($machines as $machine): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($machine['matricule'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($machine['name'] ?? ''); ?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo $machine['status'] == 'active' ? 'success' : 
                                                ($machine['status'] == 'inactive' ? 'danger' : 'warning'); 
                                        ?>">
                                            <?php echo ucfirst($machine['status'] ?? 'unknown'); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($machine['worktime'] ?? '0'); ?></td>
                                    <td><?php echo htmlspecialchars($machine['description'] ?? ''); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="/machines/edit/<?php echo $machine['id']; ?>">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $machine['id']; ?>">
                                                        <i class="bi bi-arrow-repeat"></i> Update Status
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $machine['id']; ?>">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <!-- Status Modal -->
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
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="py-4">
                                        <i class="bi bi-gear-wide-connected fs-1 text-muted"></i>
                                        <p class="mt-2 text-muted">No machines found</p>
                                        <a href="/machines/create" class="btn btn-primary">
                                            <i class="bi bi-plus"></i> Add Your First Machine
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
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