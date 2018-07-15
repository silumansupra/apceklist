<?php
  $tanggal      = $this->input->get('tanggal');
  $id_lokasi    = $this->input->get('id_lokasi');
  $getDataCetak = $this->db->query("SELECT * FROM tm_lokasi a
   LEFT JOIN tm_asman b ON b.id_asman = a.id_asman
   WHERE a.id_lokasi = '$id_lokasi'")->row();
  $nama_lokasi  = $getDataCetak->nama_lokasi;
  $nama_asman   = $getDataCetak->nama_asman;
  $nik_asman    = $getDataCetak->nik_asman;
?>
<style type="text/css">
 body{
  letter-spacing:0.01cm;
  font-family: Tahoma, Verdana, Arial;
  font-size: 1em;
 }
 table {
  border-collapse: collapse;
  font-size: 0.9em;
 }

 table, th, td {
  border: 1px solid #999999;
  padding: 2px;
 }
 th {
  padding: 7px;
  background: #CCCCCC;
  text-align: center;
  border-bottom: 2px solid black;
 }

 .total_tr {
  background: #CCCCCC !important;
 }
 td {
  padding: 7px 2px 2px 2px;
 }
 .nomor {
  width: 150px;
 }
 .printout{
  width:100%;
 }
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
   font-size: 0.75em;
   /*   margin: 0px;
      padding: 5px;*/
  }

  .muted{
   color: #999999;
   font-style: italic;
  }

  table {
   width: 100%;
   padding: 1px;
  }

  table, td {
   padding: 1px;
  }
  .tfoot{
   padding: 7px;
   background: #CCCCCC;
   text-align: center;
  }
  table#tbl_ttd, table#tbl_ttd td{
   border: none;
  }
  .logo {
   padding: 0px;
   margin:0px;
  }

 }
</style>
<div class="printout">
 <img style="z-index:-1; width: 100px;" src="<?= base_url() . "assets/images/logo_top.jpeg" ?>">
 <center><h4>CEKLIST HARIAN PERANGKAT</h4></center>

 LOKASI:  <?= $nama_lokasi ?><br>
 <?php
   $sal          = array();
   $tu           = array();
   $val1         = array();
   $val2         = array();
   $val3         = array();
   $val4         = array();
   $val5         = array();
   $ket          = array();

   $emp = array();

   # Loop over all the fetched data, and save the
   # data in array.
   foreach ($data_ceklist as $row) {
    array_push($emp, $row['nama_perangkat']);
    array_push($sal, $row['nama_kegiatan']);
    array_push($tu, $row['tolak_ukur']);
    array_push($val1, $row['val1']);
    array_push($val2, $row['val2']);
    array_push($val3, $row['val3']);
    array_push($val4, $row['val4']);
    array_push($val5, $row['val5']);
    array_push($ket, $row['ket_kegiatan']);
    $arr = array();

    # loop over all the sal array
    for ($i = 0; $i < sizeof($sal); $i++) {
     $empName = $emp[$i];

     # If there is no array for the employee
     # then create a elemnt.
     if (!isset($arr[$empName])) {
      $arr[$empName]            = array();
      $arr[$empName]['rowspan'] = 0;
     }

     $arr[$empName]['printed'] = "no";

     # Increment the row span value.
     $arr[$empName]['rowspan'] += 1;
    }
    ?>

    <?php
   }
   echo "<table cellpadding='0' cellspacing='0' class='tabel_print'>
            <tr>
                <th>NO</th>
    <th>PERANGKAT</th>
    <th>KEGIATAN</th>
    <th>TOLAK UKUR</th>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>KET</th>
            </tr>";
   $no = 1;
   for ($i = 0; $i < sizeof($sal); $i++) {
    $empName = $emp[$i];
    echo "<tr>";
    # If this row is not printed then print.
    # and make the printed value to "yes", so that
    # next time it will not printed.
    if ($arr[$empName]['printed'] == 'no') {
     echo "<td style='width:5mm;' rowspan='" . $arr[$empName]['rowspan'] . "'><center>" . $no++ . "</center></td>";
     echo "<td style='width:20mm; text-align: center;' rowspan='" . $arr[$empName]['rowspan'] . "'>" . $empName . "</td>";
     $arr[$empName]['printed'] = 'yes';
    }
    echo "<td style='width:25mm;'>" . $sal[$i] . "</td>";
    echo "<td style='width:15mm;' class='muted'><center>" . $tu[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $val1[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $val2[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $val3[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $val4[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $val5[$i] . "</center></td>";
    echo "<td style='width:10mm;'><center>" . $ket[$i] . "</center></td>";
    echo "</tr>";
   }
   echo "</table>";
 ?>
 <br>
 <table id="tbl_ttd">
  <tr>
   <td style="width: 50mm; text-align: center;">MENGETAHUI,</td>
   <td></td>
   <td></td>
   <?php
     $tgl       = date('d');
     $bulan     = date('m');
     $bln       = getnama_bulan($bulan);
     $thn       = date('Y');
     $print_tgl = $tgl . " " . $bln . " " . $thn;
   ?>
   <td style="width: 50mm; text-align: center;"><?= $nama_lokasi . ", " . $print_tgl ?></td>
  </tr>
  <tr>
   <td style="text-align: center">ASMAN</td>
   <td style="text-align: center"></td>
   <td style="text-align: center"></td>
   <td style="text-align: center">PELAKSANA</td>
  </tr>
  <tr>
   <td colspan="4">
    <br><br><br>
   </td>
  </tr>
  <tr>
   <td style="text-align: center"><?= "<u>" . strtoupper($nama_asman) . "</u><br>NIK. " . $nik_asman ?></td>
   <td style="text-align: center"></td>
   <td style="text-align: center"></td>
   <td style="text-align: center"><?= "<u>" . strtoupper(get_namalengkap()) . "</u><br>NIK. " . get_nik() ?></td>
  </tr>
 </table>
</div>
<?php
//  echo get_userid();
  if (get_userid() != "2A") {
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