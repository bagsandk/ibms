<?php
class Undangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_paket_model');
        auth();
    }
    function cekundangan()
    {
        $dbu = $this->load->database('udg', TRUE);
        if (!isset($_GET['u'])) {
            redirect('undangan');
        }
        $cekund = $dbu->get_where('undangan', ['url' => $this->input->get('u')])->row_array();
        if (!$cekund) {
            redirect('undangan');
        }
        return  $cekund['id_undangan'];
    }
    function getIdUndangan()
    {
        $dbu = $this->load->database('udg', TRUE);
        if (!isset($_GET['u'])) {
            return false;
        }
        $cekund = $dbu->get_where('undangan', ['url' => $this->input->get('u')])->row_array();
        if (!$cekund) {
            return false;
        }
        return  $cekund['id_undangan'];
    }
    function index()
    {
        $data['user'] = $this->User_paket_model->get_user_paket_by_user($this->session->userdata('id_user'));
        $data['_view'] = 'undangan/index';
        $data['title'] = 'Undangan saya';
        $this->load->view('layouts/main', $data);
    }
    function detail()
    {

        $id_undangan = $this->cekundangan();
        $dbu = $this->load->database('udg', TRUE);
        if ($this->input->get('a') == 'form') {
            $data['undangan'] = $dbu->get_where('undangan', ['url' => $_GET['u']])->row_array();
            $data['acara'] = $dbu->join('lokasi', 'lokasi.id_lokasi = acara.id_lokasi')->get_where('acara', ['acara.id_undangan' => $id_undangan])->result_array();

            $data['quotes'] = $dbu->get_where('quotes', ['id_undangan' => $id_undangan])->result_array();
            $data['pemilik_acara'] = $dbu->get_where('pemilik_acara', ['id_undangan' => $id_undangan])->result_array();
            $data['gift'] = $dbu->get_where('gift', ['id_undangan' => $id_undangan])->result_array();

            $data['giftbase'] = $this->db->get('giftbase')->result_array();

            $data['_view'] = 'undangan/form/index';
        } elseif ($this->input->get('a') == 'tamu') {
            $data['_view'] = 'undangan/tamu/index';
        } elseif ($this->input->get('a') == 'galeri') {
            $data['galeri'] = $dbu->get_where('media', ['id_undangan' => $id_undangan, 'type' => 'gambar'])->result_array();
            $data['_view'] = 'undangan/galeri/index';
        } else {
            $data['counttamu'] = $dbu->query("select count(case type when 'private' then 1 else null end) as 'private',count(case type when 'umum' then 1 else null end) as 'umum',count(case type when 'lainya' then 1 else null end) as 'lainya' FROM tamu where id_undangan = $id_undangan;")->row_array();

            $data['ucapan'] = count($dbu->get_where('ucapan', ['id_undangan' => $id_undangan])->result_array());

            $data['user'] = $this->User_paket_model->get_user_paket_by_user($this->session->userdata('id_user'));
            $data['_view'] = 'undangan/undangan';
        }
        $data['title'] = strtoupper($this->input->get('u'));
        $this->load->view('layouts/main', $data);
    }
    function undangancover()
    {
        $id_undangan = $this->getIdUndangan();
        if ($id_undangan) {
            $dbu = $this->load->database('udg', TRUE);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('judul', 'Judul', 'required|max_length[25]');
            $this->form_validation->set_rules('deskripsi', 'Judul', 'max_length[25]');
            if ($this->form_validation->run()) {
                $params = array(
                    'judul_cover' => $this->input->post('judul'),
                    'deskripsi' => $this->input->post('deskripsi'),
                );
                $act = $dbu->where('id_undangan', $id_undangan)->update('undangan', $params);
                if ($act) {
                    echo json_encode(["status" => "success", "message" => "Undangan berhasil diperbarui", 'error' => []]);
                } else {
                    echo json_encode(["status" => "failed", "message" => "Gagal diperbarui", "error" => []]);
                }
            } else {
                $error = [
                    ["e_judul" => form_error("judul")],
                    ["e_deskripsi" => form_error("deskripsi")],
                ];
                echo json_encode(["status" => "error", "message" => "Isi form dengan benar", "error" => $error]);
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Undangan tidak ada", "error" => []]);
        }
    }
    function undanganquotes()
    {
        $id_undangan = $this->getIdUndangan();
        if ($id_undangan) {
            $dbu = $this->load->database('udg', TRUE);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('sumber', 'Sumber kutipan', 'required|max_length[30]');
            $this->form_validation->set_rules('quote', 'Kutipan', 'required');
            if ($this->form_validation->run()) {
                $params = array(
                    'sumber' => $this->input->post('sumber'),
                    'quote' => $this->input->post('quote'),
                    'pembuka' => $this->input->post('pembuka'),
                    'id_undangan' => $id_undangan,
                );
                $dbu->insert('quotes', $params);
                $act = $dbu->insert_id();
                if ($act) {
                    $html = '<div class="card">
                    <div class="card-header">
                      <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#quotesAccordion' . $act . '" aria-expanded="false" aria-controls="quotesAccordion' . $act . '">
                          ' . $this->input->post('sumber') . ' <div class="icons"></div>
                        </div>
                      </section>
                    </div>
                    <div id="quotesAccordion' . $act . '" class="collapse" aria-labelledby="" data-parent="#quotesAccordion">
                      <div class="card-body">
                        <h6>' . $this->input->post('pembuka') . '</h6>
                        <p>' . $this->input->post('quote') . '</p>
                        <div class="d-flex justify-content-between pt-2 border-top">
                          <p class="font-weight-bold">( ' . $this->input->post('sumber') . ' )</p>
                        </div>
                      </div>
                    </div>
                  </div>';
                    echo json_encode(["status" => "success", "message" => "Undangan berhasil diperbarui", 'error' => [], 'html' => $html]);
                } else {
                    echo json_encode(["status" => "failed", "message" => "Gagal diperbarui", "error" => []]);
                }
            } else {
                $error = [
                    ["e_sumber" => form_error("sumber")],
                    ["e_quote" => form_error("quote")],
                ];
                echo json_encode(["status" => "error", "message" => "Isi form dengan benar", "error" => $error]);
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Undangan tidak ada", "error" => []]);
        }
    }
    function undangangift()
    {
        $id_undangan = $this->getIdUndangan();
        if ($id_undangan) {
            $dbu = $this->load->database('udg', TRUE);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_gift', 'Nama gift', 'required|max_length[30]');
            $this->form_validation->set_rules('pemilik', 'Pemilik', 'required|max_length[30]');
            $this->form_validation->set_rules('nogift', 'Nomor', 'required');
            if ($this->form_validation->run()) {
                $params = array(
                    'nama_gift' => $this->input->post('nama_gift'),
                    'pemilik' => $this->input->post('pemilik'),
                    'no' => $this->input->post('nogift'),
                    'id_undangan' => $id_undangan,
                );
                $dbu->insert('gift', $params);
                $act = $dbu->insert_id();
                if ($act) {
                    $html = '<li class="list-group-item list-group-item-action">
                    <div class="media">
                      <div class="d-flex mr-3">
                        <svg> ... </svg>
                      </div>
                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            <h6 class="tx-inverse">' . $this->input->post('nama_gift') . '</h6>
                            <p class="mg-b-0">' . $this->input->post('pemilik') . '</p>
                            </div>
                        <h5 class="">' . $this->input->post('nogift') . '</h5>
                      </div>
                    </div>
                    </div>
                  </li>';
                    echo json_encode(["status" => "success", "message" => "Undangan berhasil diperbarui", 'error' => [], 'html' => $html]);
                } else {
                    echo json_encode(["status" => "failed", "message" => "Gagal diperbarui", "error" => []]);
                }
            } else {
                $error = [
                    ["e_nama_gift" => form_error("nama_gift")],
                    ["e_pemilik" => form_error("pemilik")],
                    ["e_nogift" => form_error("nogift")],
                ];
                echo json_encode(["status" => "error", "message" => "Isi form dengan benar", "error" => $error]);
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Undangan tidak ada", "error" => []]);
        }
    }
    function undanganacara()
    {
        $id_undangan = $this->getIdUndangan();
        if ($id_undangan) {
            $dbu = $this->load->database('udg', TRUE);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_acara', 'Nama Acara', 'required|max_length[25]');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', '');
            $this->form_validation->set_rules('latitude', 'Latitude', '');
            $this->form_validation->set_rules('longitude', 'Longitude', '');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
            if ($this->form_validation->run()) {
                $plokasi = array(
                    'lokasi' => $this->input->post('lokasi'),
                    'longitude' => $this->input->post('longitude'),
                    'latitude' => $this->input->post('latitude'),
                );
                $dbu->insert('lokasi', $plokasi);
                $id_lokasi = $dbu->insert_id();

                $params = array(
                    'nama_acara' => $this->input->post('nama_acara'),
                    'tanggal' => $this->input->post('tanggal'),
                    'waktu_mulai' => $this->input->post('waktu_mulai'),
                    'waktu_selesai' => $this->input->post('waktu_selesai'),
                    'id_lokasi' => $id_lokasi,
                    'id_undangan' => $id_undangan
                );
                $dbu->insert('acara', $params);
                $act = $dbu->insert_id();
                if ($act) {
                    $selesai = $this->input->post('waktu_selesai') !== '00:00:00' ? $this->input->post('waktu_selesai') : "Selesai";
                    $html = ' <div class="card">
                    <div class="card-header" >
                      <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#acaraAccordion' . $act . '" aria-expanded="false" aria-controls="acaraAccordion' . $act . '">
                          ' . $this->input->post('nama_acara') . ' <div class="icons"></div>
                        </div>
                      </section>
                    </div>
                    <div id="acaraAccordion' . $act . '" class="collapse" aria-labelledby="" data-parent="#acaraAccordion">
                      <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom">
                          <div>
                            <h4>' . $this->input->post('nama_acara') . '</h4>
                          </div>
                          <div class="text-right">
                            <p class="m-0">' . $this->input->post('tanggal') . '</p>
                            <small>' . $this->input->post('waktu_mulai') . '-' . $selesai . '</small>
                          </div>
                        </div>
                        <div class="text-center">
                          <p class="text-center mt-2">' . $this->input->post('lokasi') . '</p>';
                    if ($this->input->post('latitude') && $this->input->post('longitude')) {
                        $html .= '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.8101265075084!2d' . $this->input->post('longitude') . '!3d' . $this->input->post('latitude') . '!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDgnMDMuMyJTIDEwNcKwMTgnNDQuMCJF!5e0!3m2!1sid!2sid!4v1633574032711!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                    }
                    $html .= '
                                </div>
                              </div>
                            </div>
                          </div>';

                    echo json_encode(["status" => "success", "message" => "Berhasil menambahkan acara", 'error' => [], 'html' => $html]);
                } else {
                    echo json_encode(["status" => "failed", "message" => "Gagal menambahkan acara", "error" => []]);
                }
            } else {
                $error = [
                    ['e_nama_acara' =>  form_error('nama_acara')],
                    ['e_tanggal' =>  form_error('tanggal')],
                    ['e_waktu_mulai' =>  form_error('waktu_mulai')],
                    ['e_waktu_selesai' =>  form_error('waktu_selesai')],
                    ['e_latitude' =>  form_error('latitude')],
                    ['e_longitude' =>  form_error('longitude')],
                    ['e_lokasi' =>  form_error('lokasi')],
                ];
                echo json_encode(["status" => "error", "message" => "Isi form dengan benar", "error" => $error]);
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Undangan tidak ada", "error" => []]);
        }
    }
    function undanganmempelai()
    {
        $id_undangan = $this->getIdUndangan();
        if ($id_undangan) {
            $dbu = $this->load->database('udg', TRUE);
            $this->load->library('form_validation');
            foreach ($this->input->post('nama_pendek') as $index => $val) {
                $this->form_validation->set_rules('nama_pendek[' . $index . ']', 'Nama Pendek', 'required|max_length[25]');
                $this->form_validation->set_rules('nama_lengkap[' . $index . ']', 'Nama Panjang', 'required|max_length[50]');
                $this->form_validation->set_rules('nama_bapak[' . $index . ']', 'Nama Bapak', 'required|max_length[25]');
                $this->form_validation->set_rules('nama_ibu[' . $index . ']', 'Nama Ibu', 'required|max_length[25]');
                $this->form_validation->set_rules('alamat_mempelai[' . $index . ']', 'Alamat', 'required|max_length[100]');
                $this->form_validation->set_rules('alias[' . $index . ']', 'Nama Alias', 'max_length[25]');
                $this->form_validation->set_rules('ig[' . $index . ']', 'Instagram', 'valid_url|max_length[100]');
                $this->form_validation->set_rules('fb[' . $index . ']', 'Facebook', 'valid_url|max_length[100]');
                $this->form_validation->set_rules('twitter[' . $index . ']', 'twitter', 'valid_url|max_length[100]');
                $this->form_validation->set_rules('jk[' . $index . ']', 'Jenis Kelamin', 'required');
            }
            if ($this->form_validation->run()) {
                $multiData = [];
                $html = '';
                foreach ($this->input->post('nama_pendek') as $index => $namaPendek) {
                    $multiData[] = array(
                        'nama_pendek' => $namaPendek,
                        'nama_lengkap' => $this->input->post('nama_lengkap[' . $index . ']'),
                        'nama_ibu' => $this->input->post('nama_ibu[' . $index . ']'),
                        'nama_bapak' => $this->input->post('nama_bapak[' . $index . ']'),
                        'alamat' => $this->input->post('alamat_mempelai[' . $index . ']'),
                        'alias' => $this->input->post('alias[' . $index . ']'),
                        'foto' => $this->input->post('url[' . $index . ']'),
                        'jk' => $this->input->post('jk[' . $index . ']'),
                        'ig' => $this->input->post('ig[' . $index . ']'),
                        'fb' => $this->input->post('fb[' . $index . ']'),
                        'id_undangan' => $id_undangan,
                        'twitter' => $this->input->post('twitter[' . $index . ']'),
                    );
                    $jk = $this->input->post('jk[' . $index . ']') == 'L' ? "Pria" : "Wanita";
                    $ig = $this->input->post('ig[' . $index . ']') ? '<a href="' . $this->input->post('ig[' . $index . ']') . '"> <i data-feather="instagram"></i></a>' : "";
                    $fb = $this->input->post('fb[' . $index . ']') ? '<a href="' . $this->input->post('fb[' . $index . ']') . '"> <i data-feather="facebook"></i></a>' : "";
                    $twitter = $this->input->post('twitter[' . $index . ']') ? '<a href="' . $this->input->post('twitter[' . $index . ']') . '"> <i data-feather="twitter"></i></a>' : "";
                    $namaalias = $this->input->post('alias[' . $index . ']') ? "(" . $this->input->post('alias[' . $index . ']') . ")" : "";
                    $urlimg = $this->input->post('url[' . $index . ']');
                    $html .= '<div class="card">
                    <div class="card-header">
                    <section class="mb-0 mt-0">
                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#mempelaiAccordion' . $index . '" aria-expanded="false" aria-controls="mempelaiAccordion' . $index . '">
                    ' . $this->input->post('nama_lengkap[' . $index . ']') . ' <div class="icons"></div>
                    </div>
                    </section>
                    </div>
                    <div id="mempelaiAccordion' . $index . '" class="collapse" aria-labelledby="" data-parent="#mempelaiAccordion">
                        <div class="card-body">
                        <div class="d-flex">
                        <img class="col-md-3" src="' . $urlimg . '" width="100"/>
                        <div class="col-md-9 ">
                        <h4>' . $this->input->post('nama_lengkap[' . $index . ']') . '</h4>
                        <div class="d-flex justify-content-between">
                        <div>
                                    <p> ' . $this->input->post('nama_pendek[' . $index . ']') . ' ' . $namaalias . '</p>
                                </div>
                                <div class="text-right">
                                <p>' . $jk .  '</p>
                                    <div class="d-flex">
                                    ' . $ig .
                        $fb .
                        $twitter . '
                        </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                <div class="d-flex justify-content-between border-bottom border-top my-2 pt-2">
                                <p>Nama Bapak : ' . $this->input->post('nama_bapak[' . $index . ']') . '</p>
                                <p>Nama Ibu : ' . $this->input->post('nama_ibu[' . $index . ']') . '</p>
                                </div>
                                <p>' . $this->input->post('alamat_mempelai[' . $index . ']') . '</p>
                                </div>
                                </div>
                                </div>';
                }
                $act = $dbu->insert_batch('pemilik_acara', $multiData);
                if ($act) {
                    echo json_encode(["status" => "success", "message" => "Mempelai berhasil diperbarui", 'error' => [], 'html' => $html]);
                } else {
                    echo json_encode(["status" => "failed", "message" => "Gagal diperbarui", "error" => []]);
                }
            } else {
                $error = [];
                foreach ($this->input->post('nama_pendek') as $index => $val) {
                    $error[] = ['e_nama_pendek_' . $index => form_error('nama_pendek[' . $index . ']')];
                    $error[] = ['e_nama_lengkap_' . $index => form_error('nama_lengkap[' . $index . ']')];
                    $error[] = ['e_nama_ibu_' . $index => form_error('nama_ibu[' . $index . ']')];
                    $error[] = ['e_nama_bapak_' . $index => form_error('nama_bapak[' . $index . ']')];
                    $error[] = ['e_alamat_mempelai_' . $index => form_error('alamat_mempelai[' . $index . ']')];
                    $error[] = ['e_alias_' . $index => form_error('alias[' . $index . ']')];
                    $error[] = ['e_jk_' . $index => form_error('jk[' . $index . ']')];
                    $error[] = ['e_ig_' . $index => form_error('ig[' . $index . ']')];
                    $error[] = ['e_fb_' . $index => form_error('fb[' . $index . ']')];
                    $error[] = ['e_twitter_' . $index => form_error('twitter[' . $index . ']')];
                }
                echo json_encode(["status" => "error", "message" => "Isi form dengan benar", "error" => $error, 'form' => $_POST]);
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Undangan tidak ada", "error" => []]);
        }
    }
}
