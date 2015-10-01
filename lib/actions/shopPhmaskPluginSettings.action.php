<?php

class shopPhmaskPluginSettingsAction extends waViewAction {

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(shopPhmaskPlugin::$plugin_id);


        $domain_routes = wa()->getRouting()->getByApp('shop');
        $domains_settings = shopPhmask::getDomainsSettings();
        $this->view->assign('settings', $settings);
        $this->view->assign('domain_settings', $domains_settings);
        $this->view->assign('domain_routes', $domain_routes);
    }

}
