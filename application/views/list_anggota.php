<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
		    <h3>Daftar Anggota E-Perpus</h3>
			<h4><?= $this->session->flashdata('pesan'); ?></h4>
			<?=anchor('auth/create_user', 'Tambah Anggota', array('class' => 'btn btn-info'));?>
			<table border="1">
			  <tr>
			  <td>Id Anggota</td><td>Nama</td><td>Jenis Kelamin</td><td>Tanggal Lahir</td><td>Alamat</td><td>Aksi</td></tr>
			  <?php foreach ($anggota as $a): ?>
			  <tr>
			  <td><?=$a->id;?></td><td><?=$a->nama_anggota;?></td><td><?=$a->jk;?></td><td><?=$a->tanggal_lahir;?></td><td><?=$a->alamat;?></td>
			  <td><?=anchor('auth/edit_user/'.$a->id, 'Edit ').anchor('anggota/hapus_anggota/'.$a->id.'/'.$a->foto_anggota, 'Hapus');?>
			  </tr>
			  <?php endforeach; ?>
			</table>
		</div>
	</section>
<?php $this->load->view('footer'); ?>
