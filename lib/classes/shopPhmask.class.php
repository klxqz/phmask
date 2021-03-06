<?php

class shopPhmask {

    public static function getRouteHash() {
        $domain = wa()->getRouting()->getDomain(null, true);
        $route = wa()->getRouting()->getRoute();
        return md5($domain . '/' . $route['url']);
    }

    public static function getDomainsSettings() {

        $cache = new waSerializeCache('shopPhmaskPlugin');

        if ($cache && $cache->isCached()) {
            $domains_settings = $cache->get();
        } else {
            $app_settings_model = new waAppSettingsModel();
            $routing = wa()->getRouting();
            $domains_routes = $routing->getByApp('shop');

            $app_settings_model->get(shopPhmaskPlugin::$plugin_id, 'domains_settings');

            $domains_settings = json_decode($app_settings_model->get(shopPhmaskPlugin::$plugin_id, 'domains_settings'), true);

            if (empty($domains_settings)) {
                $domains_settings = array();
            }

            foreach ($domains_routes as $domain => $routes) {
                foreach ($routes as $route) {
                    $domain_route = md5($domain . '/' . $route['url']);
                    if (empty($domains_settings[$domain_route])) {
                        $domains_settings[$domain_route] = shopPhmaskPlugin::$default_settings;
                    }
                }

                if ($domains_settings && $cache) {
                    $cache->set($domains_settings);
                }
            }
        }

        return $domains_settings;
    }

    public static function saveDomainsSettings($domains_settings) {
        $app_settings_model = new waAppSettingsModel();
        $routing = wa()->getRouting();
        $domains_routes = $routing->getByApp('shop');
        $app_settings_model->set(shopPhmaskPlugin::$plugin_id, 'domains_settings', json_encode($domains_settings));
        $cache = new waSerializeCache('shopPhmaskPlugin');
        if ($cache && $cache->isCached()) {
            $cache->delete();
        }
    }

    public static function saveDomainSettings($domain_settings) {
        $domains_settings = self::getDomainsSettings();
        $hash = self::getRouteHash();
        $domains_settings[$hash] = $domain_settings;
        self::saveDomainsSettings($domains_settings);
    }

    public static function saveDomainSetting($name, $value) {
        $domain_settings = self::getDomainSettings();
        $domain_settings[$name] = $value;
        self::saveDomainSettings($domain_settings);
    }

    public static function getDomainSettings() {
        $domains_settings = self::getDomainsSettings();
        $hash = self::getRouteHash();
        if (!empty($domains_settings[$hash])) {
            return $domains_settings[$hash];
        }
    }

    public static function getDomainSetting($name) {
        $domains_settings = self::getDomainsSettings();
        $hash = self::getRouteHash();
        if (!empty($domains_settings[$hash][$name])) {
            return $domains_settings[$hash][$name];
        }
    }

}
