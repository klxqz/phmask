<?php

class shopPhmaskPluginSettingsAction extends waViewAction {

    protected $plugin_id = array('shop', 'phmask');

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get($this->plugin_id);
        $this->view->assign('settings', $settings);
    }

}
