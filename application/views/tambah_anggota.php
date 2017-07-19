<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Tambah Anggota Baru</h3>

			<?= form_open_multipart('anggota/simpan_anggota');?>
			<h4><?= $this->session->flashdata('pesan'); ?></h4>
			<table>
			  <tr><td>Nama</td><td><?=form_input('nama','',array('placeholder' => 'Nama'));?></td></tr>
			  <tr><td>Jenis Kelamin</td><td><?=form_dropdown('jk', array('laki-laki' => 'laki-laki', 'perempuan' => 'perempuan'), 'laki-laki');?></td></tr>
			  <tr><td>Tanggal Lahir</td><td><?=form_input('tanggal','',array('placeholder' => 'Tanggal lahir'));?></td></tr>
			  <tr><td>Alamat</td><td><?=form_textarea(array('name' => 'alamat'), 'Alamat');?></td></tr>
			  <tr><td>Foto Anggota</td><td><input type="file" name="userfile" size="20" required="" /></td></tr>
			</table>

			<?php echo form_submit('submit','Simpan ');  echo anchor('Anggota', 'Kembali');?>
			<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

