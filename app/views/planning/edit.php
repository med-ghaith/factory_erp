<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Planning Schedule</h1>
        <a href="/planning" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Planning
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="/planning/edit/<?php echo htmlspecialchars($planning['id']); ?>">

                <div class="row">
                    <!-- Start Time -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                   value="<?php echo isset($_POST['start_time']) ? htmlspecialchars($_POST['start_time']) : date('H:i', strtotime($planning['start_time'])); ?>" required>
                            <?php if (!empty($errors['start_time'])): ?>
                                <div class="text-danger"><?php echo $errors['start_time']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- End Time -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                                   value="<?php echo isset($_POST['end_time']) ? htmlspecialchars($_POST['end_time']) : date('H:i', strtotime($planning['end_time'])); ?>" required>
                            <?php if (!empty($errors['end_time'])): ?>
                                <div class="text-danger"><?php echo $errors['end_time']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name"
           value="<?= isset($planning['name']) ? htmlspecialchars($planning['name']) : '' ?>" required>
</div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Planning
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
