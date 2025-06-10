<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Stock Item</h1>
        <a href="<?php echo base_url('stock'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Stock
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo base_url('stock/edit/' . (int)$stock['id']); ?>" method="post" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="matricule" 
                                name="matricule" 
                                value="<?php echo htmlspecialchars($stock['matricule']); ?>" 
                                required
                            >
                            <?php if (!empty($errors['matricule'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['matricule']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="machine_id" class="form-label">Machine</label>
                            <select 
                                class="form-select" 
                                id="machine_id" 
                                name="machine_id" 
                                required
                            >
                                <option value="">Select Machine</option>
                                <?php foreach ($machines as $machine): ?>
                                    <option 
                                        value="<?php echo (int)$machine['id']; ?>" 
                                        <?php echo ($machine['id'] == $stock['machine_id']) ? 'selected' : ''; ?>
                                    >
                                        <?php echo htmlspecialchars($machine['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['machine_id'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['machine_id']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="quantity" 
                                name="quantity" 
                                value="<?php echo (int)$stock['quantity']; ?>" 
                                required 
                                min="0"
                            >
                            <?php if (!empty($errors['quantity'])): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($errors['quantity']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control" 
                        id="description" 
                        name="description" 
                        rows="3"
                    ><?php echo htmlspecialchars($stock['description']); ?></textarea>
                    <?php if (!empty($errors['description'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($errors['description']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Stock Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
