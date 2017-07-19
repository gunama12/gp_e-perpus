<?php $this->load->view('header'); ?>
  <section>
      <div class="container">
        <h3>Point of Sale Perpustakaan</h3>

        <table>
          <tr><td>Nama Anggota</td><td><?=$pinjam['nama_anggota'];?></td></tr>
          <tr><td>ID Anggota</td><td><?=$pinjam['id_anggota'];?></td></tr>
          <tr><td>Kode Buku</td><td><?=$pinjam['kode_buku'];?></td></tr>
          <tr><td>Judul Buku</td><td><?=$pinjam['judul_buku'];?></td></tr>
          <tr><td>Tanggal Peminjaman</td><td><?=$this->tanggal->set_tanggal_indonesia($pinjam['tanggal_pinjam']);?></td></tr>
          <tr><td>Lama Peminjaman</td><td><?=$pinjam['lama_pinjam'];?>&nbsp;Hari</td></tr>
          <tr><td>Lama Keterlambatan</td><td><?=$pinjam['lama_keterlambatan'];?>&nbsp;Hari</td></tr>
          <tr><td>Denda</td><td>Rp&nbsp;<?=$pinjam['denda'];?></td></tr>
        </table>
        <?php
          echo form_open('Pengembalian/simpan_pengembalian');

          echo form_hidden('id_anggota',$pinjam['id_anggota']);
          echo form_hidden('kode_buku',$pinjam['kode_buku']);
          echo form_hidden('id_buku',$pinjam['id_buku']);
          echo form_hidden('tanggal_pinjam',$pinjam['tanggal_pinjam']);
          echo form_hidden('tanggal_kembali',date('Y-m-d'));
          echo form_hidden('lama_peminjaman',$pinjam['lama_pinjam']);
          echo form_hidden('lama_keterlambatan',$pinjam['lama_keterlambatan']);
          echo form_hidden('denda',$pinjam['denda']);

        ?>
        <?php
          echo form_submit('submit', 'Proses Pengembalian');
          echo anchor('Pengembalian/form_pengembalian', 'Kembali');
          echo form_close();
         ?>
    </div>
  </section>
<?php $this->load->view('footer'); ?>       
