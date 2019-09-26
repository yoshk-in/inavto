<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <tbody>
         <tr style="background: #f9f9f9;">
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><?= $author; ?></td>
        </tr>
        <?php if($body['jobs'] && !empty($body['jobs'])): ?>
        <tr style="background: #f9f9f9;">
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Работы</td>
        </tr>
        <?php foreach($body['jobs'] as $key => $value): ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;"><?= $value['title']; ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['price']; ?> руб.</td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if($body['parts'] && !empty($body['parts'])): ?>
        <tr style="background: #f9f9f9;">
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Запчасти</td>
        </tr>
        <?php foreach($body['parts'] as $key => $value): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['title']; ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['code']; ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['price']; ?> руб.</td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>