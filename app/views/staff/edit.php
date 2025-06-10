<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Staff Member</h1>
        <a href="/staff" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Staff
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="/staff/update/<?php echo $staff['id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule" 
                                   value="<?php echo isset($_POST['matricule']) ? htmlspecialchars($_POST['matricule']) : htmlspecialchars($staff['matricule']); ?>" 
                                   required>
                            <?php if (isset($errors['matricule'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['matricule']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : htmlspecialchars($staff['name']); ?>" 
                                   required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['name']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" id="level" name="level" required>
                                <option value="">Select Level</option>
                                <option value="Manager" <?php echo (isset($_POST['level']) ? $_POST['level'] : $staff['level']) === 'Manager' ? 'selected' : ''; ?>>Manager</option>
                                <option value="Technicien" <?php echo (isset($_POST['level']) ? $_POST['level'] : $staff['level']) === 'Technicien' ? 'selected' : ''; ?>>Technicien</option>
                                <option value="Ouvrier" <?php echo (isset($_POST['level']) ? $_POST['level'] : $staff['level']) === 'Ouvrier' ? 'selected' : ''; ?>>Ouvrier</option>
                            </select>
                            <?php if (isset($errors['level'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['level']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="planning_id" class="form-label">Planning</label>
                    <select class="form-select" id="planning_id" name="planning_id">
                        <option value="">Select Planning (Optional)</option>
                        <?php foreach ($plannings as $planning): ?>
                            <option value="<?php echo $planning['id']; ?>" 
                                    <?php echo (isset($_POST['planning_id']) ? $_POST['planning_id'] : $staff['planning_id']) == $planning['id'] ? 'selected' : ''; ?>>
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
                        <i class="bi bi-save"></i> Update Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 