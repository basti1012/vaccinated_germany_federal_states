<?php
//include('index.php');
//$array=[json_decode(file_get_contents('test.php'),true)];
$array=[json_decode(file_get_contents('https://rki-vaccination-data.vercel.app/api'),true)];
$sammeln="<div id='updatetime'>Update ".date('d-m-Y h:i:s', strtotime($array[0]['lastUpdate']));


$sammeln.="</div><table id='example' class='table table-striped table-bordered'><thead><tr><th>Bundesland</th><th>Einwohner</th><th>Geimpft</th><th>Prozent</th></tr></thead><tbody>";
$arr_bu=['Baden-Württemberg',
                    'Bayern',
                    'Berlin',
                    'Brandenburg',
                    'Bremen',
                    'Hamburg',
                    'Hessen',
                    'Mecklenburg-Vorpommern',
                    'Niedersachsen',
                    'Nordrhein-Westfalen',
                    'Rheinland-Pfalz',
                    'Saarland',
                    'Sachsen',
                    'Sachsen-Anhalt',
                    'Schleswig-Holstein',
                    'Thüringen'];

for($x=0;$x<=count($arr_bu);$x++){
       $val=$array[0]['states'][$arr_bu[$x]];
       $sammeln.="<tr><td>".$arr_bu[$x]."</td>
                      <td>".$val['total']."</td>
                      <td>".$val['vaccinated']."</td>
                      <td>".$val['quote']."</td>
                  </tr>";
}
$sammeln.="<tr><td>Deutschland</td>
               <td> ".$array[0]['total']."</td>
               <td>".$array[0]['vaccinated']."</td>
               <td> ".$array[0]['quote']."</td>
           </tr>
       </tbody></table>";
?>
<!doctype html>
<html lang="de">
<head>
<title>Impfzahlen deutschland</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UFT-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
<style>
body {
    margin:2em 3em;
}
.dt-buttons {
    margin-bottom: 10px;
}
.dt-buttons.btn-group{
	float: left;
	margin-right: 2%;
}
.dataTables_filter {
	float: left;
	margin-top: 4px;
	margin-right: 2%;
	text-align: left;
}
.dataTables_info {
	float: right;
}
.dataTables_length{
	float: right;
	margin-top: 4px;
	margin-left: 2%;
}
</style>
</head>
<body>
<h1>Geimpfte in Deutschland</h1>
<?php echo $sammeln; ?>
<script>
$(document).ready(function() {
	document.title='Impfzahlen Bundesländer';
	$('#example').DataTable({
			"dom": '<"dt-buttons"Bfli>rtp',
			"paging": false,
			"autoWidth": true,
			"fixedHeader": false,
			"buttons": [
				'colvis',
				'copyHtml5',
        'csvHtml5',
				'excelHtml5',
        'pdfHtml5',
				'print'
			]
		}
	);
});
</script>
</body></html>
