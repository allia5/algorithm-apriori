<?php



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>apriori</title>
    <link rel="stylesheet" href="style/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        classification par methode associative par motif frèquants
    </header>
    <hr>


    <div class="container" id="etap1">
        <a>
            <h3>remplire les propriètè et le minimium supp:</h3>
        </a>
        <div class="input-group">
            <span class="input-group-text">dèterminer le nombre de proprieter:</span>
            <input type="number" max="26" min="1" aria-label="First name" id="prop" class="form-control">
            <span class="input-group-text">remplire le champe min_supp:</span>
            <input type="number" max="100" min="1" id="sigma" aria-label="Last name" class="form-control"><br>
            <button class="btn btn-info" id="btn1">passer a remplire a base de donner formele</button>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <div id="etap2" class="container">

    </div>

    <div id="etap3" class="container"></div>
    





    <hr><hr><hr>
    <button style="display: none;" type="button" id="btn5" class="btn btn-secondary">evedent les regle d'association >></button>
    <br><br>

    <div class="container" id=etap4>
      

    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js " integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>

</body>
<script type="text/javascript">
    var result=0;
    function fn(){ 
        var table =0;
        var sigma = (document.getElementById("sigma").value)/100;
        $.ajax({
            async: false,
                url: "get_fn.php",
                type: "POST",
                
                success: function(data) {
                     
                      table =data;
                }
            });
           table= JSON.parse(table);
    
    var count = table.length;
    var array_col=[];
    var p=0;
    alert(sigma);
    
    /*const myArr = table.split(",");*/
  var i = 0;
  var c=0;
 
    for (i = 0; i < count ; i=i+2) {
          for(p=0;p<table[i + 1].length;p++){
            if(table[i + 1][p]>=sigma){
                array_col.push('rgba(54, 162, 235, 0.2)');
              }else{
                array_col.push('rgba(255, 99, 132, 0.2)');
              }
          }
          
        var ctx = document.getElementById("actuel"+c).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: table[i],
                datasets: [{
                    label: 'support item ',
                    data: table[i + 1],
                    backgroundColor: array_col,
                    borderColor: [
                        'rgba(255, 255, 255, 255)',
                        
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


      c++;
      array_col=[];
    }


    }
















    $(document).ready(function() {

        var prop = 0;

        $(document).on("click", ".btn-dark", function(e) {
       document.getElementById("btn5").style.display="block";
            $.ajax({
                url: "get_motife_finale.php",
                type: "POST",

                success: function(data) {

                    $("#etap3").html(data);
                    fn();
                }
            });
            
        });
        $("#btn5").on("click", function(e) {
          
            $.ajax({
                url: "Regle_assoc.php",
                type: "POST",
                
                success: function(data) {

                    $("#etap4").html(data);
                }
            });




        });
        $("#btn1").on("click", function(e) {

            var sigma = $("#sigma").val() / 100;
            prop = $("#prop").val();
            
            $.ajax({
                url: "etap1.php",
                type: "POST",
                data: {
                    sigma: sigma,
                    prop: prop,

                },
                success: function(data) {

                    $("#etap2").html(data);
                }
            });


        });
        $(document).on("click", ".btn-success", function(e) {
            var table = [];
            var item = 0;

            for (i = 0; i < prop; i++) {
                item = $("#" + i).val();
                table.push(item);
            }
            $.ajax({
                url: "bd_formelle.php",
                type: "POST",
                data: {
                    table: table

                },
                success: function(data) {

                    $("#formelle").html(data);
                }
            });

        });

    });
</script>

</html>