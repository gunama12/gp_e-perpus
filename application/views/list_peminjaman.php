<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
	 		<h3>Daftar Peminjaman Buku</h3>
	 		<?=$this->session->flashdata('pesan');?>
	 		<table border="1px">
	   			<tr><td>ID Peminjaman</td><td>ID Anggota</td><td>Kode Buku</td><td>Tanggal Peminjaman</td></tr>
	   			<?php foreach ($list as $l): ?>
	         	<tr><td><?=$l->id_pinjam;?></td><td><?=$l->id_anggota;?></td><td><?=$l->kode_buku;?></td><td><?=$this->tanggal->set_tanggal_indonesia($l->tanggal_pinjam);?></td></tr>
	   			<?php endforeach; ?>
	 		</table>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

