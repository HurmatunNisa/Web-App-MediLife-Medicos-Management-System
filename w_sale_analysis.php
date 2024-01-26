<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Trend Analysis</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <?php include("sessionforsidenav.php"); ?>
    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('line-chart', 'Trend Analysis', 'Weekly Sale Trends');
        ?>
        <!-- header section end -->
        <!-- Styles -->
        <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
        </style>

        <!-- Resources -->
        <script src="js/purchase_index.js"></script>
        <script src="js/percent.js"></script>
        <script src="js/Animated.js"></script>

        <!-- Chart code -->
        <script>
          am5.ready(function() {

          // Create root element
          // https://www.amcharts.com/docs/v5/getting-started/#Root_element
          var root = am5.Root.new("chartdiv");


          // Set themes
          // https://www.amcharts.com/docs/v5/concepts/themes/
          root.setThemes([
          am5themes_Animated.new(root)
          ]);


          // Create chart
          // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
          var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout
          }));


          // Create series
          // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
          var series = chart.series.push(am5percent.PieSeries.new(root, {
          valueField: "value",
          categoryField: "category"
          }));


          // Set data
          // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
          series.data.setAll([
          { value: 10, category: "Paracetamol" },
          { value: 9, category: "Morphine" },
          { value: 6, category: "Amixilin" },
          { value: 5, category: "Acetaminophen" },
          { value: 4, category: "Nicip Plus" },
          { value: 3, category: "Brufen" },
          { value: 1, category: "Rigix" },
          ]);


          // Play initial series animation
          // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
          series.appear(1000, 100);

          }); // end am5.ready()
        </script>

        <div hidden>
          <!-- Include AmCharts and the modified JavaScript code -->
          <script src="js/index.js"></script>
          <script src="js/percent.js"></script>
          <script src="js/Animated.js"></script>
          <script hidden>
            am5.ready(function() {
              // ... (AmCharts JavaScript code with modifications)
              // ... (code provided in previous messages)

              // Fetch data using AJAX from fetch_top_selling_data.php
              am5.utils.loadScript("fetch_top_selling_data.php", function() {
                var fetchedData = window.topSellingData;

                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                  layout: root.verticalLayout
                }));

                var series = chart.series.push(am5percent.PieSeries.new(root, {
                  valueField: "value",
                  categoryField: "category"
                }));

                var totalSoldLastWeek = 0;

                Object.keys(fetchedData).forEach(function(medicine) {
                  totalSoldLastWeek += fetchedData[medicine].totalQuantity;
                });

                var dataForChart = Object.keys(fetchedData).map(function(medicine) {
                  var percentage = (fetchedData[medicine].totalQuantity / totalSoldLastWeek) * 100;
                  return { value: percentage, category: medicine };
                });

                series.data.setAll(dataForChart);

                series.appear(1000, 100);
              });

              // ... (other code)
            });
          </script>
        </div>

        <!-- HTML -->
        <div id="chartdiv"></div>
      </div>
    </div>
</body>