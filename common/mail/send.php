<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <tbody>
        <tr style="background: #f9f9f9;">
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><?= $author; ?></td>
        </tr>
       <?php if($body['phone'] && !empty($body['phone'])): ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Телефон: </td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['phone']; ?> руб.</td>
            </tr>
        <?php endif; ?>
        <?php if($body['email'] && !empty($body['email'])): ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">E-mail: </td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['email']; ?> руб.</td>
            </tr>
        <?php endif; ?>
        <?php if($body['avto'] && !empty($body['avto'])): ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Авто: </td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['avto']; ?> руб.</td>
            </tr>
        <?php endif; ?>
        <?php if($body['text'] && !empty($body['text'])): ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Текст сообщения: </td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['text']; ?> руб.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
