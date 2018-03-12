<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com   	   #
################################################################################################

/*
 * This file contains the english version of any static text required by your module in the admin area.
 * If you want to translate your module to another language, the idea is that you can just replace the
 * right hand column below with the changed language, rather than modifying every file in your module.
 * 
 * We will call these language strings through in the controller to make them available in the view. 
 * 
 * For your module, think about any text that you want to display and add it in here. Also replace all the
 * "My Module" text for the name of your module.
 * 
 */

// Example field added (see related part in admin/controller/module/my_module.php)
$_['my_module_example'] = 'Example Extra Text';



// Heading Goes here:
//$_['heading_title']    = 'Интернет Оплата частями и Мгновенная рассрочка';
$_['heading_title']    = 'Мгновенная рассрочка (ПриватБанк)';


// Text
$_['text_module']      = 'Оплата';
$_['text_success']     = "Выполнено: Вы изменили параметры 'Мгновенная рассрочка (ПриватБанк)!'";
//$_['text_edit']        = 'Редактирование Оплаты частями и Мгновенной рассрочки';
$_['text_edit']        = 'Редактирование Мгновенная рассрочка (ПриватБанк)';
$_['text_privatbank_paymentparts_ii'] = '<a target="_BLANK" href="https://payparts2.privatbank.ua/ipp/"><img src="view/image/payment/pbPayPat.png" alt="Privatbank Paymentparts" title="Privatbank Paymentparts" style="border: 1px solid #EEEEEE;width: 56px;height: 35px" /></a>';
$_['text_content_top']    = 'Content Top';
$_['text_content_bottom'] = 'Content Bottom';
$_['text_column_left']    = 'Column Left';
$_['text_column_right']   = 'Column Right';
$_['text_paymentparts_url']   = '<p for="input-shop-id">Для получения идентификатора и пароля, необходимо зарегистрировать магазин в Личном кабинете Интернет- <a target="_BLANK" href="https://payparts2.privatbank.ua/ipp/">Оплаты частями</a></p>';

# Entry
//common
$_['entry_example']       = 'Example Entry:'; // this will be pulled through to the controller, then made available to be displayed in the view.
$_['entry_image']        = 'Image (WxH):';
$_['entry_limit']        = 'Limit:';
$_['entry_layout']        = 'Layout:';
$_['entry_position']      = 'Position:';
//$_['entry_status']        = 'Status:';
$_['entry_status']        = 'Статус:';
$_['entry_sort_order']    = 'Sort Order:';
//merchantType
$_['entry_merchantType_ii'] = 'Мгновенная рассрочка:';
//shop identification
$_['entry_shop_id'] = 'Идентификатор магазина:';
$_['entry_shop_password'] = 'Пароль магазина:';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify module My Module!';
$_['error_privatbank_paymentparts_ii_shop_id'] = 'Необходим ID магазина!';
$_['error_privatbank_paymentparts_ii_shop_password'] = 'Необходим пароль магазина!';

//status in admin Extansions>Payment
$_['text_enabled']    = 'Включено';

//Payment State order Statuses
$_['entry_completed_status']    = 'Статус "платеж успешно совершен"';
$_['entry_failed_status']       = 'Статус "ошибка при создании платежа"';
$_['entry_canceled_status']     = 'Статус "платеж отменен (клиентом)"';
$_['entry_rejected_status']     = 'Статус "платеж отклонен"';
$_['entry_clientwait_status']   = 'Статус "ожидание"';
$_['entry_created_status']      = 'Статус "платеж создан"';

//Payment order status tab
$_['tab_order_status']       = 'Статус Заказа';

//Help
$_['help_merchantType_ii']       = "Выберите количество платежей по сервису 'Оплата частями'";

?>