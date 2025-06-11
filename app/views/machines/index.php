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