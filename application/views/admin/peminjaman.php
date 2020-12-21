<div class="container-fluid">

          <!-- Page Heading -->

<?php echo $this->session->flashdata('message');  ?>

                  <a href="<?php echo base_url().'admin/tambah_peminjaman'; ?>"  class="btn btn-primary btn-icon-split"> <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text" >Booking Buku</span></a>
				
            <br>
            <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-info">Data Buku</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
					<tr>
					<th>No</th>
					<th>Anggota</th>
					<th>Buku</th>
					<th>Tgl. Pinjam</th>
					<th>Tgl. Kembali</th>
					<th>Denda/Hari</th>
					<th>Tgl. Dikembalikan</th>
					<th>Total Denda</th>
					<th>Status Buku</th>
					<th>Status Pinjam</th>
					</tr>
					</thead>
                   
                  
                <tbody>
						<?php
						$no = 1;
						foreach ($peminjaman as $p) {
						?>
						<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $p->nama_anggota ?></td>
						<td><?php echo $p->judul_buku ?></td>
						<td><?php echo date('d/m/Y',strtotime($p->tgl_pinjam)); ?></td>
						<td><?php echo date('d/m/Y',strtotime($p->tgl_kembali)); ?></td>
						<td><?php echo "Rp. ".number_format($p->denda); ?></td>
						<td>
						<?php
							if($p->tgl_pengembalian =="0000-00-00"){
							echo "-";
							}else{
							echo date('d/m/Y',strtotime($p->tgl_pengembalian));
							} ?>
						</td>
						<td><?php echo "Rp. ". number_format($p->total_denda)." ,-"; ?></td>
						<td style="text-align: center;">
						<?php
						if($p->status_buku == "1"){
						echo "Selesai";
						}else{
						echo "-";
						} ?>
						</td>
						<td>
						<?php
						if($p->status_peminjaman == "Selesai"){
						echo "-";
						}else {
						?>
						
					 <a href="<?php echo
						base_url().'admin/transaksi_selesai/'.$p->id_pinjam; ?>" class="btn btn-info btn-circle btn-sm">
                    <i class="fas fa-check "></i>
                  </a>
					
					 <a href="<?php echo
						base_url().'admin/transaksi_hapus/'.$p->id_pinjam; ?>" class="btn btn-danger btn-circle btn-sm">
                    <i class="fas fa-trash"></i>
                  </a>
				
					
				
						<?php } ?>
						</td>
						</tr>
						<?php } ?>
						</tbody>
                 
                </table>
              </div>
            </div>
          </div>

        </div>


<!-- Button trigger modal -->