<?php

$plugin_id = array('shop', 'phmask');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'status', '1');
$app_settings_model->set($plugin_id, 'maska', '+7(999) 999-9999');
$app_settings_model->set($plugin_id, 'selector', 'input[name="customer[phone]"],input[name="data[phone]"]');
