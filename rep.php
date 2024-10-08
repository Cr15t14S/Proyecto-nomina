<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customStyles.css">

</head>

<body id="body">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active h3">Proyecto Nomina <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>

    <div class="container main-container">
    <div class='header-container'>
        <h2 >Nomina</h2>
    </div>

    <div class="row">
        <div id="content" class="col-lg-12">
            <form action="./pdf.php" method='post'>
                <table class="table table-borderless">
                    <thead class="table-header">
                        <tr >
                            <td class="font-weight-bold text-center border">No. id</td>
                            <td class="font-weight-bold text-center border">Nombre</td>
                            <td class="font-weight-bold text-center border">Sueldo</td>
                            <td class="font-weight-bold text-center border">Salario según Días Laborados</td>
                            <td class="font-weight-bold text-center border">Auxilio de transporte</td>
                            <td class="font-weight-bold text-center border">Pago Incapacidad EPS</td>
                            <td class="font-weight-bold text-center border">Pago Incapacidad ARL</td>
                            <td class="font-weight-bold text-center border">Recargo Nocturno</td>
                            <td class="font-weight-bold text-center border">H. Dominicales</td>
                            <td class="font-weight-bold text-center border">Total devengado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nom = $_REQUEST['nomb'] ?? [];
                        $cen = $_REQUEST['cent'] ?? [];
                        $car = $_REQUEST['carg'] ?? [];
                        $id = $_REQUEST['id'] ?? [];
                        $suel = $_REQUEST['suel'] ?? [];
                        $dias = $_REQUEST['dias'] ?? [];
                        $EPS= $_REQUEST['diasEPS'] ?? [];;
                        $ARL= $_REQUEST['diasARL'] ?? [];;
                        $Recargo= $_REQUEST['Hnoc'] ?? [];;
                        $HDomin= $_REQUEST['Hdomin'] ?? [];;
                        $tam = count($nom);
                        
                        for ($i = 0; $i < $tam; $i++) {
                            $sal2[$i] = round(($suel[$i] / 30) * $dias[$i],1);
                            $Auxtrans[$i] = round((5300 * $dias[$i]),1);
                            $EPS2 [$i]= round(($sal2[$i]/66.66) * $EPS[$i],1) ;
                            $ARL2[$i]= round(($suel[$i] / 30) * $ARL[$i],1);
                            $Recargo2 [$i]=  round (((($suel[$i] / 30) /8) * 0.35) * $Recargo[$i],1);
                            $HDomin2 [$i]=  round(((($suel[$i] / 30) /8) * 0.75) * $HDomin[$i],1);
                            $Total [$i]=round($sal2[$i] + $Auxtrans[$i] + $EPS2[$i]+ $ARL2[$i] + $Recargo2[$i] + $HDomin2[$i],1);
                            $Totales = Totales + Total [$i];
                            echo "<tr class='bg-custom'>
                                <td class='text-center'>$id[$i]<input class='form-control d-none' type='number' name='id[]' value='{$id[$i]}' readonly></td>
                                <td class='text-center'>$nom[$i]<input class='form-control d-none' type='text' name='nomb[]' value='{$nom[$i]}' readonly></td>
                                <input class='form-control d-none' type='text' name='carg[]' value='{$car[$i]}' readonly>
                                <input class='form-control d-none' type='text' name='cent[]' value='{$cen[$i]}' readonly>
                                <td class='text-center'>$suel[$i]<input class='form-control d-none' type='number' name='suel[]' value='{$suel[$i]}' readonly></td>
                                <input class='form-control d-none' type='number' name='dias[]' value='{$dias[$i]}' readonly>
                                <td class='text-center'>$sal2[$i]<input class='form-control d-none' type='number' name='sal2[]' value='{$sal2[$i]}' readonly></td>
                                <td class='text-center'>$Auxtrans[$i]<input class='form-control d-none' type='number' name='Auxtrans2[]' value='{$Auxtrans[$i]}' readonly></td>
                                <td class='text-center'>$EPS2[$i]<input class='form-control d-none' type='number' name='EPS2[]' value='{$EPS2[$i]}' readonly></td>
                                <td class='text-center'>$ARL2[$i]<input class='form-control d-none' type='number' name='ARL2[]' value='{$ARL2[$i]}' readonly></td>
                                <td class='text-center'>$Recargo2[$i]<input class='form-control d-none' type='number' name='Recargo2[]' value='{$Recargo2[$i]}' readonly></td>
                                <td class='text-center'>$HDomin2[$i]<input class='form-control d-none' type='number' name='HDomin2[]' value='{$HDomin2[$i]}' readonly></td>
                                <td class='text-center'>$Total[$i]<input class='form-control d-none' type='number' name='Total[]' value='{$Total[$i]}' readonly></td>
                                <input class='form-control d-none' type='number' name='Totales' value='{$Totales}' readonly>
                            </tr>";
                        }
                        ?>
                        
                        <tr >
                            <td colspan="7">
                                <input class="btn btn-primary" type='submit' value='Generar PDF'>
                                <input class="btn btn-info" type='reset' value='Reset'>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <br/>

        </div>
    </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>