<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Stock Inventory</h1>
        <a href="<?php echo base_url('stock/create'); ?>" class="btn btn-primary">
            <i class="bi bi-plus"></i> Add Stock Item
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="stockTable">
                    <thead class="table-light">
                        <tr>
                            <th>Matricule</th>
                            <th>Machine</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stock as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['matricule']); ?></td>
                                <td><?php echo htmlspecialchars($item['machine_matricules']); ?></td>
                                <td><?php echo htmlspecialchars($item['description']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $item['quantity'] <= 5 ? 'danger' : 'success'; ?>">
                                        <?php echo (int)$item['quantity']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="<?php echo base_url('stock/edit/' . (int)$item['id']); ?>">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#quantityModal<?php echo (int)$item['id']; ?>">
                                                    <i class="bi bi-arrow-repeat"></i> Update Quantity
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo (int)$item['id']; ?>">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Quantity Modal -->
                                    <div class="modal fade" id="quantityModal<?php echo (int)$item['id']; ?>" tabindex="-1" aria-labelledby="quantityModalLabel<?php echo (int)$item->id; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="quantityModalLabel<?php echo (int)$item['id']; ?>">Update Stock Quantity</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="<?php echo base_url('stock/update-quantity/' . (int)$item['id']); ?>" method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity<?php echo (int)$item['id']; ?>" class="form-label">Quantity</label>
                                                            <input 
                                                                type="number" 
                                                                name="quantity" 
                                                                id="quantity<?php echo (int)$item['id']; ?>" 
                                                                class="form-control" 
                                                                value="<?php echo (int)$item['quantity']; ?>" 
                                                                min="0" 
                                                                required
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Quantity</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo (int)$item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo (int)$item->id; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo (int)$item['id']; ?>">Delete Stock Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($item['matricule']); ?></strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="<?php echo base_url('stock/delete/' . (int)$item['id']); ?>" class="btn btn-danger">Delete</a>
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

<!-- DataTables JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#stockTable').DataTable();
    });
</script>
