<?php $this->load->view('header'); ?>
  <section>
      <div class="container">
        <h3>Konfirmasi Pemesanan</h3>
        <table>
          <tr>
            <td>
              Judul Buku :
            </td>
            <td>
              <?=$judul_buku;?>
            </td>
          </tr>
          <tr>
            <td>
              ID Anggota :
            </td>
            <td>
              <?=$id_anggota;?>
            </td>
          </tr>
        </table>
        <?php
        echo form_open('Pemesanan/simpan_pemesanan');
        echo form_hidden('id_buku',$id_buku);
        echo form_hidden('id_anggota',$id_anggota);
        echo form_submit('submit', 'Pesan');
        echo anchor('Buku', 'Kembali');
        echo form_close();
         ?>
      </div>
  </section>
<?php $this->load->view('footer'); ?>

