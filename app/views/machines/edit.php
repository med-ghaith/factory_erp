<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Machine</h1>
        <a href="/machines" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Machines
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="/machines/edit/<?php echo htmlspecialchars($machine['id']); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule" 
                                   value="<?php echo htmlspecialchars($machine['matricule']); ?>" required>
                            <?php if (isset($errors['matricule'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['matricule']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo htmlspecialchars($machine['name']); ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['name']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" <?php echo $machine['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $machine['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="maintenance" <?php echo $machine['status'] === 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                            </select>
                            <?php if (isset($errors['status'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['status']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="worktime" class="form-label">Work Time (minutes)</label>
                            <input type="number" class="form-control" id="worktime" name="worktime" 
                                   value="<?php echo htmlspecialchars($machine['worktime']); ?>" required>
                            <?php if (isset($errors['worktime'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['worktime']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($machine['description']); ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($errors['description']); ?></div>
                    <?php endif; ?>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Machine
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
