<?php

class shopPhmaskPlugin extends shopPlugin {

    public function frontendHead() {

        if (!$this->getSettings('status')) {
            return false;
        }
        $view = wa()->getView();
        $view->assign('maska', $this->getSettings('maska'));
        $view->assign('selector', $this->getSettings('selector'));
        $template_path = wa()->getAppPath('plugins/phmask/templates/FrontendHead.html', 'shop');
        $html = $view->fetch($template_path);
        return $html;
    }

}
