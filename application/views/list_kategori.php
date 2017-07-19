<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h2>Daftar Kategori Buku</h2>
			<?= $this->session->flashdata('pesan');?><br>
			<?= anchor('kategori/tambah','Tambah Kategori'); ?>
			<table border="1">
			  <tr><td>Id Kategori</td><td>Kategori</td><td>Aksi</td></tr>
			  <?php foreach ($list_kategori as $k): ?>
			    <tr><td><?=$k->id_kategori;?></td><td><?=$k->nama_kategori;?></td>
			        <td><?= anchor('kategori/ubah/'.$k->id_kategori,'Ubah '); ?><?= anchor('kategori/hapus/'.$k->id_kategori,'Hapus'); ?></td>
			    </tr>
			  <?php endforeach; ?>
			</table>
		</div>
	</section>
<?php $this->load->view('footer'); ?>
	
