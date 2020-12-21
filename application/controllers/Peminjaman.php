function peminjaman(){
$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
$data['peminjaman'] = $this->db->query("SELECT * FROM transaksi T,
buku B, anggota A WHERE T.id_buku=B.id_buku and
T.id_anggota=A.id_anggota")->result();
$this->load->view('admin/header',$data);
$this->load->view('admin/peminjaman',$data);
$this->load->view('admin/footer');
} 

function tambah_peminjaman(){
$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
$w = array('status_buku'=>'1');
$data['buku'] = $this->M_perpus->edit_data($w,'buku')->result();
$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
$data['peminjaman'] = $this->M_perpus->get_data('transaksi')->result();
$this->load->view('admin/header',$data);
$this->load->view('admin/tambah_peminjaman',$data);
$this->load->view('admin/footer');
} 

function tambah_peminjaman_act(){
$tgl_pencatatan = date('Y-m-d H:i:s');
$anggota = $this->input->post('anggota');
$buku = $this->input->post('buku');
$tgl_pinjam = $this->input->post('tgl_pinjam');
$tgl_kembali = $this->input->post('tgl_kembali');
$denda = $this->input->post('denda');
$this->form_validation->set_rules('anggota','Anggota','required');
$this->form_validation->set_rules('buku','Buku','required');
$this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
$this->form_validation->set_rules('tgl_kembali','Tanggal
Kembali','required');
$this->form_validation->set_rules('denda','Denda','required');
if($this->form_validation->run() != false){
$data = array(
'tgl_pencatatan' => $tgl_pencatatan,
'id_anggota' => $anggota,
'id_buku' => $buku,
'tgl_pinjam' => $tgl_pinjam,
'tgl_kembali' => $tgl_kembali,
'denda' => $denda,
'tgl_pengembalian' => '0000-00-00',
'total_denda' => '0',
'status_pengembalian' =>'0',
'status_peminjaman' =>'0'
);
$this->M_perpus->insert_data($data,'transaksi');
$d = array('status_buku' =>'0','tgl_input' =>
substr($tgl_pencatatan,0,10));
$w = array('id_buku' => $buku);
$this->M_perpus->update_data('buku', $d,$w);
$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert" >
  <strong>Buku Berhasil Di Booking</strong> 
</div>');
redirect(base_url().'admin/peminjaman');
}else{
$w = array('status_buku' => '1');
$data['buku'] = $this->M_perpus->edit_data($w,'buku')->result();
$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
$this->load->view('admin/header');
$this->load->view('admin/tambah_peminjaman',$data);
$this->load->view('admin/footer');
}
} 


function transaksi_hapus($id){
$w = array('id_pinjam' => $id);
$data = $this->M_perpus->edit_data($w,'transaksi')->row();
$ww = array('id_buku' => $data->id_buku);
$data2 = array('status_buku' => '1');
$this->M_perpus->update_data('buku',$data2,$ww);
$this->M_perpus->delete_data($w,'transaksi');
redirect(base_url().'admin/peminjaman');
}