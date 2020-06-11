<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Absen</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Siswa</th>
		<th>Masuk</th>
		<th>Keluar</th>
		<th>Tanggal</th>
		<th>Status Kehadiran</th>
		
            </tr><?php
            foreach ($absen_data as $absen)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $absen->id_siswa ?></td>
		      <td><?php echo $absen->masuk ?></td>
		      <td><?php echo $absen->keluar ?></td>
		      <td><?php echo $absen->tanggal ?></td>
		      <td><?php echo $absen->status_kehadiran ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>