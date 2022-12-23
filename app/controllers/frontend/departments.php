<?php

use Tygh\Registry;

if ($mode == 'departments') {
    // Save current url to session for 'Continue shopping' button
    Tygh::$app['session']['continue_url'] = "departments.departments";
    $params = $_REQUEST;
    $params['logged_in'] = Tygh::$app['session']['auth']['user_id'];
    list($departments, $search) = fn_get_departments($params, Registry::get('settings.Appearance.products_per_page'), CART_LANGUAGE);
    
    if (!empty($departments)) {
        Tygh::$app['view']->assign('departments', $departments);
        Tygh::$app['view']->assign('search', $search);
        Tygh::$app['view']->assign('columns', 3);
        fn_add_breadcrumb("Отделы");
    } else {
        return [CONTROLLER_STATUS_NO_PAGE];
    }

} elseif ($mode === 'department') {
    $department_data = [];
    $params = $_REQUEST;
    $params['logged_in'] = Tygh::$app['session']['auth']['user_id'];
    $params['department_id'] = !empty($_REQUEST['department_id']) ? $_REQUEST['department_id'] : 0;
    $department_data = fn_get_department_data($params, CART_LANGUAGE);
    if (empty($department_data)) {
        return [CONTROLLER_STATUS_NO_PAGE];
    }
    $users = fn_department_get_links($params, true);
    list($department_data['user_ids'], $params) = $users;

    Tygh::$app['view']->assign('department_data', $department_data);
    Tygh::$app['view']->assign('search', $params);

    fn_add_breadcrumb('Отделы', Tygh::$app['session']['continue_url']);
}
