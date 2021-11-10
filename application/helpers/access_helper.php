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
function menuAccess($module = "")
{
    $json = json_decode(file_get_contents(__DIR__ . '/menu.json'));
    return array_filter($json->menu, function ($obj) use ($module) {
        return $obj->module == $module;
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
