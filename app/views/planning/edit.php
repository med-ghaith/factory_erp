<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Planning Schedule</h1>
        <a href="<?php echo base_url('planning'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Planning
        </a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php echo form_open('planning/edit/' . $planning->id); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo date('H:i', strtotime($planning->start_time)); ?>" required>
                            <?php echo form_error('start_time', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo date('H:i', strtotime($planning->end_time)); ?>" required>
                            <?php echo form_error('end_time', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $planning->description; ?></textarea>
                    <?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Planning
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div> 