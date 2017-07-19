<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
		    <h3>Daftar Pengembalian Buku</h3>
			<table border="1">
			  <tr><td>ID Pengembalian</td><td>ID Anggota</td><td>Kode Buku</td><td>Judul Buku</td><td>Tanggal Pinjam</td><td>Tanggal Kembali</td><td>Lama Peminjaman</td><td>Lama Keterlambatan</td><td>Denda</td></tr>

			  <?php foreach ($pengembalian as $p): ?>
			    <tr><td>#<?=$p->id_pengembalian?></td><td><?=$p->id_anggota?></td><td><?=$p->kode_bukus?></td><td><?=$p->judul_buku?></td><td><?=$this->tanggal->set_tanggal_indonesia($p->tanggal_pinjam)?></td><td><?=$this->tanggal->set_tanggal_indonesia($p->tanggal_kembali)?></td>
			      <td><?=$p->lama_peminjaman?>&nbsp;Hari</td><td><?=$p->lama_keterlambatan?>&nbsp;Hari</td><td>Rp&nbsp;<?=$p->denda?></td>
			    </tr>

			  <?php endforeach; ?>
			</table>
		</div>
	</section>
<?php $this->load->view('footer'); ?>
	
