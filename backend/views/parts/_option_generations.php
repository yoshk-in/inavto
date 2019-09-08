<?php foreach($data as $key => $value): ?>
    <option value="<?=$value->id ?>" <?php echo !empty($default_arr) && in_array($value->id, $default_arr) ? 'selected' : '' ?>><?=$value->car->title . ' ' . $value->title ?></option>
<?php endforeach; ?>


