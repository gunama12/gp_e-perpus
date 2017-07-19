<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Form Peminjaman Buku</h3>
			<?php
			echo form_open('Peminjaman/simpan_pinjam_buku');
			echo $this->session->flashdata('pesan');
			?>
			<table>
			  <tr><td>ID Anggota</td><td><?= form_input('id_anggota','', array('placeholder' => 'ID Anggota', 'required' => ''));?></td></tr>
			  <tr><td>Kode Buku</td><td><?= form_input('kode_buku','', array('placeholder' => 'Kode Buku', 'required' => ''));?></td></tr>

			</table>
			<?php echo form_submit('submit','Proses ');  echo anchor('Peminjaman', 'Kembali');?>
			<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

