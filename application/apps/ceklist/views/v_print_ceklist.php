<style type="text/css">
 body{
  letter-spacing:0.01cm;
  font-family: Tahoma, Verdana, Arial;
  font-size: 0.8em;
 }
 table {
  border-collapse: collapse;
  font-size: 0.9em;
 }

 table, th, td {
  border: 1px solid #999999;
  padding: 3px;
 }
 th {
  padding: 7px;
  background: #CCCCCC;
  text-align: center;
  border-bottom: 2px solid black;
 }
 .tabel_print tr:nth-child(even) {background: #f2f2f2}
 .tabel_print tr:nth-child(odd) {background: #FFF}
 .total_tr {
  background: #CCCCCC !important;
 }
 td {
  padding: 7px 2px 2px 2px;
 }
 .nomor {
  width: 150px;
 }
 .printout{width:100%;}
 #tengah {
  text-align: center;
 }
 .rp{
  text-align: right;
 }
 .tfoot{
  padding: 7px;
  background: #CCCCCC;
  text-align: center;

 }
 @media print {
  html, body {
   letter-spacing:0.01cm;
   font-family: Tahoma, Verdana, Arial;
   font-size: 0.8em;
  }

  table {
   width: 100%;
  }
  .tfoot{
   padding: 7px;
   background: #CCCCCC;
   text-align: center;

  }
 }
</style>
<div class="printout">
 LOGO
 <br>
 <br>
 <center>
  <h5>CEKLIST HARIAN PERANGKAT $NAMA_PERANGKAT</h5>
 </center>
 LOKASI: $NAMA_LOKASI<br>
 BULAN: $NAMA_LOKASI<br>
 <table class="tabel_print">
  <thead>
   <tr style="background: #999999; border-bottom: 1px solid black;">
    <th>NO</th>
    <th>PERANGKAT</th>
    <th>KEGIATAN</th>
    <th>TOLAK UKUR</th>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>KETERANGAN</th>
   </tr>
  </thead>
  <tbody>
   <?php
     $no            = 1;
     $dataPerangkat = $this->db->query("SELECT * FROM tm_perangkat WHERE id_lokasi = '$idl'")->result_array();
     $jmlP          = count($dataPerangkat);
//     debug($dataKegiatan);
     foreach ($dataPerangkat as $r) {
      $idP          = $r['id_perangkat'];
      $dataKegiatan = $this->db->query("SELECT b.nama_kegiatan FROM tt_ceklist a INNER JOIN tm_kegiatan b ON b.id_kegiatan = a.id_kegiatan WHERE a.id_lokasi = '$idl'AND a.id_perangkat = '$idP' AND SUBSTRING(a.waktu_ceklist,1,10) = '$tgl'")->result_array();
      $jmlK         = count($dataKegiatan);
      ?>
      <tr>
       <td><?= $no++ ?></td>
      </tr>
     <?php } ?>
  </tbody>
 </table>

 <br>
</div>
<?php
//  echo get_userid();
  if (get_userid() != "2") {
   ?>
   <script type="text/javascript">
    window.onload = function () {
     window.print();
     setTimeout(function () {
      window.close();
     }, 1);
    };
  <?php } ?>
</script>