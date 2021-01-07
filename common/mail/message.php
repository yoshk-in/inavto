<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <tbody>
            <tr style="background: #f9f9f9;">
                <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><?= $author; ?></td>
            </tr>
            <tr>
                <h2 style="text-align:center;">Сохранена новая заявка на сайте в КАЛЬКУЛЯТОРЕ технического обслуживания</h2>
                <!-- new mail data -->
                <h3 style="text-align: center;"><?= $body['model'], ' поколение ', $body['gen'], ' ', $body['motor'], ' пробег ', $body['age'], 'км'; ?></h3>

                <!-- new mail data -->
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Телефон клиента:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $phone ?></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">E-mail клиента:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $mail ?></td>
            </tr>
            <?php if ($body['jobs'] && !empty($body['jobs'])) : ?>
                <tr style="background: #f9f9f9;">
                    <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><strong>Обязательные работы</strong></td>
                </tr>
                <?php foreach ($body['jobs'] as $key => $value) : ?>
                    <tr>
                        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;"><?= $value['title']; ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['price']; ?> руб.</td>
                    </tr>
                <?php endforeach; ?>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Сумма:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['jobs_price']; ?> руб.</td>
            <?php endif; ?>
            <?php if ($body['recommend'] && !empty($body['jobs'])) : ?>
                <tr style="background: #f9f9f9;">
                    <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><strong>Рекомендуемые работы</strong></td>
                </tr>
                <?php foreach ($body['recommend'] as $key => $value) : ?>
                    <tr>
                        <td colspan="2" style="padding: 8px; border: 1px solid #ddd;"><?= $value['title']; ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['price']; ?> руб.</td>
                    </tr>
                <?php endforeach; ?>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Сумма:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['rec_price']; ?> руб.</td>
            <?php endif; ?>
            <?php if ($body['parts'] && !empty($body['parts'])) : ?>
                <tr style="background: #f9f9f9;">
                    <td colspan="3" style="padding: 8px; border: 1px solid #ddd;"><strong>Запчасти</strong></td>
                </tr>
                <?php foreach ($body['parts'] as $key => $value) : ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['title']; ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['code']; ?></td>
                        <td style="padding: 8px; border: 1px solid #ddd;"><?= $value['price']; ?> руб.</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid #ddd;">Сумма:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $body['parts_price']; ?> руб.</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid #ddd;"><strong>Итого:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong><?= $body['total'] ?? 0; ?> руб.</strong></td>
            </tr>
        </tbody>
    </table>
    <h3 style="text-align:center;">Спасибо за обращение к нашему ресурсу!</h3>
    <p style="text-align:center;">Обращаем Ваше внимание, что номера выбранных запчастей требую дополнительной проверки нашими менеджерами на предмет совместимости с VIN номером конкретного автомобиля.</p>
    <p style="text-align:center;font-size:xx-small;">Данное письмо не является публичной офертой и носит исключительно информационный характер. Цены на запасные части и работы могут отличаться от указанных.</p>
</div>