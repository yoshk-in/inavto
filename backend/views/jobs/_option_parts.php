<?php if($data && !empty($data)): ?>
    <?php foreach($data as $key => $value): ?>
        <option value="<?=$key ?>" <?php echo !empty($default_arr) && in_array($key, $default_arr) ? 'selected' : '' ?>><?=$value ?></option>
    <?php endforeach; ?>
<?php endif; ?>

