<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Add Stock Item</h1>
        <a href="/stock" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Stock
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="/stock/create">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control <?php echo isset($errors['matricule']) ? 'is-invalid' : ''; ?>" 
                                   id="matricule" name="matricule" 
                                   value="<?php echo isset($data['matricule']) ? htmlspecialchars($data['matricule']) : ''; ?>" 
                                   required>
                            <?php if (isset($errors['matricule'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['matricule']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="machine_id" class="form-label">Machine</label>
                            <select class="form-select <?php echo isset($errors['machine_id']) ? 'is-invalid' : ''; ?>" 
                                    id="machine_id" name="machine_id" required>
                                <option value="">Select Machine</option>
                                <?php foreach($machines as $machine): ?>
                                    <option value="<?php echo htmlspecialchars($machine['id']); ?>"
                                        <?php echo (isset($data['machine_id']) && $data['machine_id'] == $machine['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($machine['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['machine_id'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['machine_id']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control <?php echo isset($errors['quantity']) ? 'is-invalid' : ''; ?>" 
                                   id="quantity" name="quantity" 
                                   value="<?php echo isset($data['quantity']) ? htmlspecialchars($data['quantity']) : ''; ?>" 
                                   required min="0">
                            <?php if (isset($errors['quantity'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['quantity']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" 
                              id="description" name="description" rows="3"><?php 
                        echo isset($data['description']) ? htmlspecialchars($data['description']) : ''; 
                    ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($errors['description']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Stock Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>