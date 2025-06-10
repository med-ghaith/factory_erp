<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Staff Members</h1>
        <a href="/staff/create" class="btn btn-primary">
            <i class="bi bi-plus"></i> Add New Staff
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Planning</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff as $member): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($member['matricule']); ?></td>
                                <td><?php echo htmlspecialchars($member['name']); ?></td>
                                <td><?php echo htmlspecialchars($member['level']); ?></td>
                                
                                <td>
                                    <?php 
                                    $planning = array_filter($plannings, function($p) use ($member) {
                                        return $p['id'] == $member['planning_id'];
                                    });
                                    $planning = reset($planning);
                                    echo $planning ? htmlspecialchars($planning['name']) : '<span class="text-muted">Not assigned</span>';
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/staff/assign/<?php echo $member['id']; ?>" 
                                           class="btn btn-sm btn-info" title="Assign Planning">
                                            <i class="bi bi-calendar-check"></i>
                                        </a>
                                        <a href="/staff/edit/<?php echo $member['id']; ?>" 
                                           class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal<?php echo $member['id']; ?>"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $member['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this staff member?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="/staff/delete/<?php echo $member['id']; ?>" 
                                                       class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
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