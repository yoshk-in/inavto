<?php foreach($data as $key => $value): ?>
    <option value="<?=$value->id ?>" <?php echo !empty($arr) && in_array($value->id, $arr) ? 'selected' : '' ?>><?=$value->title ?></option>
<?php endforeach; ?>


