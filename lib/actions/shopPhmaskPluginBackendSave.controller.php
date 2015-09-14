<?php

class shopPhmaskPluginBackendSaveController extends waJsonController {

    protected $plugin_id = array('shop', 'phmask');

    public function execute() {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_begstroka = waRequest::post('shop_phmask');
            foreach ($shop_begstroka as $name => $value) {
                $app_settings_model->set($this->plugin_id, $name, $value);
            }


            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
