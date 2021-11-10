<?php
function snackBar($type, $message)
{
  $color = '';
  switch ($type) {
    case 'success':
      $color = '#8dbf428e';
      break;
    case 'danger':
      $color = '#e7515a8e';
      break;
    case 'warning':
      $color = '#e2a03f8e';
      break;
    default:
      $color = '#3b3f5c8e';
      break;
  }
  $CI = &get_instance();
  return $CI->session->set_flashdata("message", "
  <script>
    Snackbar.show({
      text: '$message',
      pos: 'top-right',
      actionTextColor: '#fff',
      backgroundColor: '$color'
      });
  </script>
  ");
}
