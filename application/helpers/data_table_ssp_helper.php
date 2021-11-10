<?php
// $table = 'tbl_user'; //nama tabel dari database
// $column_order = array(null, 'user_nama', 'user_email', 'user_alamat'); //field yang ada di table user
// $column_search = array('user_nama', 'user_email', 'user_alamat'); //field yang diizin untuk pencarian 
// $order = array('user_id' => 'asc'); // default order 
function dataTable(string $table, array $column, array $column_order, array $column_search, array $order)
{
  $ci = &get_instance();
  function _get_datatables_query($table, $column_search, $column_order, $order, $column)
  {
    $ci = &get_instance();
    $ci->db->select($column);
    $ci->db->from($table);
    $i = 0;
    foreach ($column_search as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {
        if ($i === 0) // looping awal
        {
          $ci->db->group_start();
          $ci->db->like($item, $_POST['search']['value']);
        } else {
          $ci->db->or_like($item, $_POST['search']['value']);
        }
        if (count($column_search) - 1 == $i)
          $ci->db->group_end();
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $ci->db->order_by($column_order[$_POST['order']['0']['column'] - 1], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
      $ci->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables($table, $column_search, $column_order, $order, $column)
  {
    $ci = &get_instance();
    _get_datatables_query($table, $column_search, $column_order, $order, $column);
    if ($_POST['length'] != -1)
      $ci->db->limit($_POST['length'], $_POST['start']);
    $query = $ci->db->get();
    return $query->result();
  }

  function count_filtered($table, $column_search, $column_order, $order, $column)
  {
    $ci = &get_instance();
    _get_datatables_query($table, $column_search, $column_order, $order, $column);
    $query = $ci->db->get();
    return $query->num_rows();
  }

  function count_all($table)
  {
    $ci = &get_instance();
    $ci->db->from($table);
    return $ci->db->count_all_results();
  }



  $list = get_datatables($table, $column_search, $column_order, $order, $column);
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $field) {
    $no++;
    $row = array();
    $row[] = $no;
    foreach ($column as $clm) {
      $row[] = $field->{$clm};
    }
    $data[] = $row;
  }
  $output = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => count_all($table),
    "recordsFiltered" => count_filtered($table, $column_search, $column_order, $order, $column),
    "data" => $data,
  );
  //output dalam format JSON
  echo json_encode($output);
}
