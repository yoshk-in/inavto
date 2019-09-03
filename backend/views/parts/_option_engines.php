<?php foreach($data as $key => $value): ?>
    <option value="<?=$value->id ?>" <?php echo !empty($default_arr) && in_array($value->id, $default_arr) ? 'selected' : ''?>><?=$value->generation->car->title . ' ' . $value->generation->alter_title . ' ' . $value->title ?></option>
<?php endforeach; ?>


