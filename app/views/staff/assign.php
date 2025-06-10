<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Assign Planning</h1>
        <a href="/staff" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Staff
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Staff Information</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Matricule:</th>
                            <td><?php echo htmlspecialchars($staff['matricule']); ?></td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo htmlspecialchars($staff['name']); ?></td>
                        </tr>
                        <tr>
                            <th>Level:</th>
                            <td><?php echo htmlspecialchars($staff['level']); ?></td>
                        </tr>
                       
                    </table>
                </div>
            </div>
            
            <form method="POST" action="/staff/assign/<?php echo $staff['id']; ?>">
                <div class="mb-3">
                    <label for="planning_id" class="form-label">Select Planning</label>
                    <select class="form-select" id="planning_id" name="planning_id" required>
                        <option value="">Select Planning</option>
                        <?php foreach ($plannings as $planning): ?>
                            <option value="<?php echo $planning['id']; ?>" 
                                    <?php echo ($staff['planning_id'] == $planning['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($planning['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['planning_id'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($errors['planning_id']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Assign Planning
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 