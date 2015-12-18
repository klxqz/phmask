<?php

class shopPhmaskPlugin extends shopPlugin {

    public static $plugin_id = array('shop', 'phmask');
    public static $default_settings = array(
        'status' => '1',
        'maska' => '+7(999) 999-9999',
        'selector' => 'input[name="customer[phone]"],input[name="data[phone]"]'
    );

    public function frontendHead() {
        
        if (!$this->getSettings('status')) {
            return false;
        }
        if (!shopPhmask::getDomainSetting('status') || (wa()->getUser()->isAuth() && shopPhmask::getDomainSetting('no_auth'))) {
            return false;
        }
        $view = wa()->getView();
        $view->assign('maska', shopPhmask::getDomainSetting('maska'));
        $view->assign('selector', shopPhmask::getDomainSetting('selector'));
        $template_path = wa()->getAppPath('plugins/phmask/templates/FrontendHead.html', 'shop');
        $html = $view->fetch($template_path);
        return $html;
    }

}
