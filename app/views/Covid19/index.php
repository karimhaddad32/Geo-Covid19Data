<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.72/Build/Cesium/Cesium.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.72/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
  <title>Karim Haddad Deveopment</title>

  <?php $this->view('/Shared/styles'); ?>

</head>
<body>
    <?php $this->view('/Shared/topnavbar'); ?>
    <style type='text/css'>
                .tg  {border-collapse:collapse;border-spacing:0;width:100%;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg .tg-0lax{text-align:left;vertical-align:top}

                
                tr > th
                {
                    background-color: #123123;
                }

                .ring
                {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 150px;
                    height: 150px;
                    background: transparent;
                    border: 3px solid #3c3c3c;
                    border-radius: 50%;
                    text-align: center;
                    line-height: 150px;
                    font-family: sans-serif;
                    font-size: 20px;
                    color: #2196f3;
                    letter-spacing: 4px;
                    text-transform: uppercase;
                    text-shadow: 0 0 10px #2196f3;
                    box-shadow: 0 0 20px rgba(0, 0, 0, .5);
                    z-index: 99;
                }

                .ring:before
                {
                    content: '';
                    position: absolute;
                    top: -3px;
                    left: -3px;
                    width: 100%;
                    height: 100%;
                    border: 3px solid transparent;
                    border-top: 3px solid #2196f3;
                    border-right: 3px solid #2196f3;
                    border-radius: 50%;
                    animation: animateCircle 2s linear infinite;
                }

                .ring-span
                {
                    display: block;
                    position: absolute;
                    top: calc(50% - 2px);
                    left: 50%;
                    width: 50%;
                    height: 4px;
                    background: transparent;
                    transform-origin: left;
                    animation: animate 2s linear infinite;
                }

                .ring-span:before
                {
                    content: '';
                    position: absolute;
                    width: 16px;
                    height: 16px;
                    border-radius: 50%;
                    background: #2196f3;
                    top:-6px;
                    right: -8px;
                    box-shadow: 0 0 20px #2196f3;
                    
                }

                @keyframes animate{
                    0%{
                        transform: rotate(45deg);
                    }
                    100%{
                        transform: rotate(405deg);
                    }
                }

                @keyframes animateCircle{
                    0%{
                        transform: rotate(0deg);
                    }
                    100%{
                        transform: rotate(360deg);
                    }
                }
               
           
        </style>
    <?php 

        
        $records = json_decode($model, true);

        function build_sorter($key) {
            return function ($a, $b) use ($key) {
                if (isset($a[$key]) && isset($b[$key])){
                    return strnatcmp($a[$key], $b[$key]);
                }else{
                    return;
                }
            };
        }

        

        usort($records,build_sorter("Country_text"));
        
            echo "
                
                <div class='grid' style='display: grid;  grid-template-columns: 50% 50%;'>
                
                <div class='column' style='; overflow-y: auto; max-height: 650px'>
                <input class='form-control' id='myInput' type='text' placeholder='Search..'>
                <table class='tg' >
                <thead>
                <tr>
                    <th class='tg-0lax'>Country</th>
                    <th class='tg-0lax'>Active Cases</th>
                    <th class='tg-0lax'>Last Update</th>
                    <th class='tg-0lax'>New Cases</th>
                    <th class='tg-0lax'>New Deaths</th>
                    <th class='tg-0lax'>Total Cases</th>
                    <th class='tg-0lax'>Total Deaths</th>
                    <th class='tg-0lax'>Total Recovered</th>
                </tr>
                </thead>
                <tbody id='myTable'>";

                foreach( $records as $record){
                    if(isset($record["Country_text"])){
                        echo "<tr>
                        <td class='tg-0lax'>" . $record["Country_text"] ."</td>
                        <td class='tg-0lax'>" . $record["Active Cases_text"] ."</td>                      
                        <td class='tg-0lax'>" . (isset($record["Last Update"]) ? $record["Last Update"] : '')  ."</td>
                        <td class='tg-0lax'>" . $record["New Cases_text"] ."</td>
                        <td class='tg-0lax'>" . $record["New Deaths_text"] ."</td>
                        <td class='tg-0lax'>" . $record["Total Cases_text"] ."</td>
                        <td class='tg-0lax'>" . $record["Total Deaths_text"] ."</td>
                        <td class='tg-0lax'>" . $record["Total Recovered_text"] ."</td>
                    </tr>";
                    }
               
            }
                echo "</tbody>
                </table></div>" ;
    ?>


  
  
  <div class='column' id="cesiumContainer" style="width: 100%; max-height:700px; position: relative">
  <div style="position: absolute; width:100%; height: 100%" id="loader">
    <div class='ring'>
                Loading
                <span class='ring-span'></span>
    </div>
</div>
 
</div>
  


  </div>

  <?php $this->view('/Shared/footer'); ?>

 
  <script>

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIwNzJmOWIyYi1hYWZhLTQyNjEtYjk1OS0wOGRjNzIxODY4NTgiLCJpZCI6MzI1MDIsInNjb3BlcyI6WyJhc3IiLCJnYyJdLCJpYXQiOjE1OTcwODYwMTR9.PWgnXks37YjsSP52wqFn3-FDy-ExJ1Wd6bCyDbHGrOk';
    var viewer = new Cesium.Viewer('cesiumContainer', {
        sceneMode : Cesium.SceneMode.SCENE3D,
        baseLayerPicker : false,
        navigationHelpButton: false,
        homeButton:false,
        scene3DOnly: true,
        fullscreenButton: false
    });


    var myGeoJSONPath = '../../../assets/mediumres.geo.json';

    $.getJSON(myGeoJSONPath,function(data){
           
            var arr = ["name", "admin"];

            var countries_with_different_keyname = 
            {
                "United Arab Emirates": "UAE",
                "United States of America": "USA",
                "Cape Verde": "Cabo Verde",
                "The Bahamas": "Bahamas",
                "Saint Barthelemy" : "St. Barth",
                "Somaliland" : "Somalia",
                "Saint Pierre and Miquelon": "Saint Pierre Miquelon",
                "Turks and Caicos Islands": "Turks and Caicos",
                "United Kingdom": "UK",
                "Saint Vincent and the Grenadines": "St. Vincent Grenadines",
                "Hong Kong S.A.R.": "Hong Kong",
                "Northern Cyprus" : "Cyprus",
                "South Korea": "S. Korea",
                "Macao S.A.R": "Macao",
                "East Timor": "Timor-Leste",
                "Vatican": "Vatican City",
                "Republic of Congo": "Congo",
                "Guinea Bissau": "Guinea-Bissau",
                "United Republic of Tanzania": "Tanzania",
                "Czech Republic": "Czechia",
                "Republic of Serbia": "Serbia",
                "Faroe Islands": "Faeroe Islands"
            };


            var response = JSON.parse('<?php echo $model ?>');

                $('#loader').remove();
                $.each(data.features, function(index, value){

                    $.each(Object.keys(value.properties), function(index, key){
                        if(!arr.includes(key)){
                            delete value.properties[key]
                        }    
                    });   

                    
                    param = value.properties.admin;

                    if(Object.keys(countries_with_different_keyname).includes(value.properties.admin)){
                        param = countries_with_different_keyname[value.properties.admin];
                    }
                    
                    var extra_prp = response.find(element => element.Country_text == param);

                    if(typeof extra_prp !== 'undefined'){

                        $.each(Object.keys(extra_prp), function(index, key){

                        value.properties[key.replace("_text", "")] = extra_prp[key];

                        }); 
                    }

                    var color = Cesium.Color.fromRandom({alpha: 1});

                    viewer.dataSources.add(Cesium.GeoJsonDataSource.load(value, {
                        stroke: color,
                        fill: color,
                        strokeWidth: 3,
                        markerColor :color,
                    }));


                });
    })



  </script>

    


</body>
</html>
