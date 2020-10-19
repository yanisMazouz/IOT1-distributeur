<?php
include("dao.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mes distributeurs</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    	<link rel="stylesheet" href="css/admin.css">
	</head>
	<body>
        <div class="contener">
            <div  class="urgent">
                <h3>Informations importantes:</h3>
                <ul class="list-group">
                    <?php 
                    $infos=classer(recupFrigo());
                    echo "<h4>Température élevé : </h4>";
                    foreach($infos as $val){
                        if($val[0]['temperature']>8){echo "<li class=\"list-group-item\"><strong>".$val[0]['adresse']."</strong> température de ".$val[0]['temperature']." degrés !</li>";}
                    }
                    echo "<h4>Taux d'humidité faible : </h4>";
                    foreach($infos as $val){
                        if($val[0]['humidite']<80){echo "<li class=\"list-group-item\"><strong>".$val[0]['adresse']."</strong> taux d'humidité de ".$val[0]['humidite']."% ! </li>";}
                    }
                    echo "<h4>Stock insuffsant:</h4>";
                    foreach($infos as $val){
                        foreach($val as $emplacement){
                            if($emplacement['poid']<100){echo "<li class=\"list-group-item\"><strong>".$emplacement['adresse']."</strong>, il reste ".$emplacement['poid']." grammes de ".$emplacement['aliment']." !</li>";}
                        }                    
                    }
                    ?>
                <ul>
        </div>
        
        <div class="chart">
            <div class="form">
                <form method="POST">
                    <label>Adresse du distributeur:</label>
                    <SELECT name="id_frigo">
                        <?php
                            $frigos=frigos();
                            foreach($frigos as $val){
                                echo "<OPTION value=".$val['id_frigo'].">".$val['adresse'];
                            }
                        ?>
                    </SELECT>
                    <label>Sur les:</label>
                    <SELECT name="type">
                    <OPTION value="true"> 24 dernieres heures
                    <OPTION value="false"> 7 derniers jours
                    </SELECT>
                    <input type="submit" name='ok' value="valider" >
                </form>
                <?php if(isset($_POST['id_frigo'])){
                    echo "<h2>".adresse($_POST['id_frigo'])."</h2>";
                } ?>
                <canvas id="myChart" style="margin 5%"></canvas>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" type="text/javascript"></script>
        <?php if(isset($_POST['id_frigo'])){ ?>
        <script  type="text/javascript">
            <?php $infos= infosGraphe($_POST['id_frigo'],$_POST['type']); ?>
            var infos=<?php echo json_encode($infos); ?>;
            console.log(infos);
            var abs=[];
            for (var key in infos){
                    abs.push(key);
            }
            Chart.defaults.global.defaultFontColor = '#ED541B';
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: abs,
                    datasets: [
                        <?php   
                        $info=$infos[key($infos)];
                        $keys=array_keys($info);
                        $couleur=array("red","green","yellow","blue","orange","grey","black");
                        $i=0;
                        foreach($keys as $aliment){
                            $res= array();
                            foreach ($infos as $val){
                                $res[]=$val[$aliment];
                            }
                        ?>
                            {
                                data: <?php echo json_encode($res); ?>,
                                label: '<?php echo $aliment; ?>',
                                backgroundColor:'<?php echo $couleur[$i]; ?>',
                                borderWidth: 1
                            },
                        <?php $i++;} ?>
                    ]
                },
            });
        </script>
		<?php } ?>
	</body>
</html>