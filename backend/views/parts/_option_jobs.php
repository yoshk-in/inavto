<?php if($data && !empty($data)): ?>
    <?php foreach($data as $key => $value): ?>
        <option value="<?=$value['job_id'] ?>" <?php echo !empty($default_arr) && in_array($value['job_id'], $default_arr) ? 'selected' : '' ?>><?=$value['job_title'] ?></option>
    <?php endforeach; ?>
<?php endif; ?>

