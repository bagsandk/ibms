<?php
function resize($fotoname)
{
  $ci = &get_instance();
  list($width, $height) = getimagesize('./assets/assets/img/pelamar/original/' . $fotoname);
  $width_resize = ($width / 2);
  $height_resize = ($height / 2);
  //resize
  $config1['image_library'] = 'gd2';
  $config1['source_image'] = './assets/assets/img/pelamar/croping/4x4-' . $fotoname;
  $config1['maintain_ratio'] = false;
  $config1['width']     = $width_resize;
  $config1['height']   = $height_resize;
  $config1['new_image'] = './assets/assets/img/pelamar/croping/4x4-' . $fotoname;
  $ci->load->library('image_lib', $config1);
  $ci->image_lib->initialize($config1);
  $ci->image_lib->resize();

  return '4x4-' . $fotoname;
}
