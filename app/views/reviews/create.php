<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Create Review</h1>
        <a href="/reviews" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Reviews
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <div class="mb-4">
                <h5>History Details</h5>
                <p><strong>Machine:</strong> <?php echo htmlspecialchars($history['machine_id']); ?></p>
                <p><strong>Staff:</strong> <?php echo htmlspecialchars($history['staff_id']); ?></p>
                <p><strong>Period:</strong> <?php echo date('Y-m-d H:i', strtotime($history['start_time'])); ?> to 
                   <?php echo $history['end_time'] ? date('Y-m-d H:i', strtotime($history['end_time'])) : 'Ongoing'; ?></p>
            </div>

            <form method="POST" action="/reviews/create/<?php echo $history['id']; ?>">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="criteria_g" class="form-label">Criteria G (Quality)</label>
                        <select class="form-select" id="criteria_g" name="criteria_g" required>
                            <option value="">Select Score</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="criteria_f" class="form-label">Criteria F (Efficiency)</label>
                        <select class="form-select" id="criteria_f" name="criteria_f" required>
                            <option value="">Select Score</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="criteria_n" class="form-label">Criteria N (Safety)</label>
                        <select class="form-select" id="criteria_n" name="criteria_n" required>
                            <option value="">Select Score</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                     <div class="col-md-3">
            <label for="criticality" class="form-label">Criticality (G × F × N)</label>
            <input type="number" class="form-control" id="criticality" name="criticality" readonly>
        </div>
                </div>

                <div class="mb-3">
                    <label for="remarque" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarque" name="remarque" rows="3"></textarea>
                </div>

                

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function calculateCriticality() {
        const g = parseInt(document.getElementById('criteria_g').value) || 0;
        const f = parseInt(document.getElementById('criteria_f').value) || 0;
        const n = parseInt(document.getElementById('criteria_n').value) || 0;
        const result = g * f * n;
        document.getElementById('criticality').value = result || '';
    }

    document.getElementById('criteria_g').addEventListener('change', calculateCriticality);
    document.getElementById('criteria_f').addEventListener('change', calculateCriticality);
    document.getElementById('criteria_n').addEventListener('change', calculateCriticality);
</script>
