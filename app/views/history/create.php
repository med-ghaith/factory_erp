<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">New Production Record</h1>
        <a href="/history" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to History
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="/history/create">
                <div class="row">
                    <!-- Machine -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="machine_id" class="form-label">Machine</label>
                            <select class="form-select" id="machine_id" name="machine_id" required>
                                <option value="">Select Machine</option>
                                <?php foreach ($machines as $machine): ?>
                                    <option value="<?php echo $machine['id']; ?>"
                                            <?php echo (isset($_POST['machine_id']) && $_POST['machine_id'] == $machine['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($machine['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Staff -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="staff_id" class="form-label">Staff Member</label>
                            <select class="form-select" id="staff_id" name="staff_id" required>
                                <option value="">Select Staff Member</option>
                                <?php foreach ($staff as $member): ?>
                                    <option value="<?php echo $member['id']; ?>"
                                            <?php echo (isset($_POST['staff_id']) && $_POST['staff_id'] == $member['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($member['name']); ?>
                                        (<?php echo htmlspecialchars($member['level']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="stock_id" class="form-label">Stock Item</label>
                            <select class="form-select" id="stock_id" name="stock_id" required>
                                <option value="">Select Stock Item</option>
                                <?php foreach ($stock as $item): ?>
                                    <option value="<?php echo $item['id']; ?>"
                                            <?php echo (isset($_POST['stock_id']) && $_POST['stock_id'] == $item['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($item['matricule']); ?>
                                        (Qty: <?php echo htmlspecialchars($item['quantity']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
    <label for="used_quantity" class="form-label">Quantity Used</label>
    <input type="number" class="form-control" id="used_quantity" name="used_quantity" min="1" required
           value="<?php echo isset($_POST['used_quantity']) ? htmlspecialchars($_POST['used_quantity']) : ''; ?>">
</div>
                    </div>
                </div>

                <!-- Start Time -->
                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                           value="<?php echo isset($_POST['start_time']) ? htmlspecialchars($_POST['start_time']) : ''; ?>" required>
                </div>

                <!-- End Time -->
                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                           value="<?php echo isset($_POST['end_time']) ? htmlspecialchars($_POST['end_time']) : ''; ?>" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?php 
                        echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; 
                    ?></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Start Production
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
