<?php
function auth()
{
    $ci = &get_instance();
    if (!$ci->session->has_userdata('email')) {
        redirect('auth');
    }
}
function accessCheck()
{
    $sampleAccess = ['R-SKKI', 'C-SKKI'];
    $hak = json_decode(file_get_contents(__DIR__ . '/listpermit.json'));
    $ACCESS = [];
    foreach ($hak->access as $ac) {
        $ACCESS[$ac->accessId] = in_array($ac->accessId, $sampleAccess);
    }
    return $ACCESS;
}
function menuAccess()
{
    $json = json_decode(file_get_contents(__DIR__ . '/menu.json'));
    $ci = &get_instance();
    return array_filter($json->menu, function ($obj) use ($ci) {
        return array_filter($ci->session->userdata('menu'), function ($oo) use ($obj) {
            return $obj->menuCode == $oo->menuCode;
        });
    });
}
function menuActive($menu)
{
    $ci = &get_instance();
    if ($ci->uri->segment(2) != null) {
        echo $ci->uri->segment(1) . '/' . $ci->uri->segment(2) == $menu ? 'active' : "";
    } else {
        echo $ci->uri->segment(1) . '/' . 'dashboard' == $menu ? 'active' : "";
    }
}









function getModule()
{
    $ci = &get_instance();
    $module = [];
    foreach ($ci->session->userdata('dataAccess') as $data) {
        $module[] = $data;
    }
    $ci->session->set_userdata('module', $module);
    return $module;
}
function getMenu($module)
{
    $ci = &get_instance();
    $ms = $ci->session->userdata('moduleSelected');
    if ($module !== $ms) {
        $moduleSelected =  array_filter($ci->session->userdata('module'), function ($obj) use ($module) {
            return $obj->moduleCode == $module;
        });
        if ($moduleSelected) {
            $ci->session->set_userdata('moduleSelected', $moduleSelected[0]->moduleCode);
        }
        $menu = [];
        foreach ($moduleSelected as $mm) {
            $menu = $mm->menu;
        }
        $ci->session->set_userdata('menu', $menu);
        return $menu;
    } else {
        return $ci->session->userdata('menu');
    }
}
function getAccess($menu)
{
    $ci = &get_instance();
    $ms = $ci->session->userdata('menuSelected');
    if ($menu !== $ms) {
        $access = [];
        $menuSelected =  array_filter($ci->session->userdata('menu'), function ($objmenu) use ($menu) {
            return $objmenu->menuCode == $menu;
        });
        if ($menuSelected) {
            $ci->session->set_userdata('menuSelected', $menuSelected[0]->menuCode);
        }
        // var_dump($menuSelected);
        foreach ($menuSelected as $acc) {
            $access = $acc->access;
        }
        $ci->session->set_userdata('access', $access);
        return $access;
    } else {
        return $ci->session->userdata('access');
    }
}
