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
          createHeader('line-chart', 'Trend Analysis', 'Sale\'s Trends Analysis');
        ?>
        <!-- header section end -->
        <!-- Styles -->
        <style>
        #chartdiv {
        margin-left: 0%;
        width: 100%;
        height: 500px;
        }
        </style>

        <!-- Resources -->
        <script src="js/core.js"></script>
        <script src="js/xy.js"></script>
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
          // https://www.amcharts.com/docs/v5/charts/xy-chart/
          var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: false,
          panY: false,
          wheelX: "panX",
          wheelY: "zoomX",
          layout: root.verticalLayout
          }));


          // Add legend
          // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
          var legend = chart.children.push(
          am5.Legend.new(root, {
              centerX: am5.p50,
              x: am5.p50
          })
          );

          var data = [{
          "month": "May",
          "aoxicilin": 9,
          "morphine": 12,
          "nicip plus": 20,
          "acetaminophen": 17,
          "paracetamol": 11,
          "rigix": 14
          }, {
          "month": "June",
          "aoxicilin": 20,
          "morphine": 30,
          "nicip plus": 22,
          "acetaminophen": 5,
          "paracetamol": 14,
          "rigix": 9
          }, {
          "month": "July",
          "aoxicilin": 18,
          "morphine": 29,
          "nicip plus": 24,
          "acetaminophen": 21,
          "paracetamol": 10,
          "rigix": 20
          }]


          // Create axes
          // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
          var xRenderer = am5xy.AxisRendererX.new(root, {
          cellStartLocation: 0.1,
          cellEndLocation: 0.9
          })

          var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          categoryField: "month",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
          }));

          xRenderer.grid.template.setAll({
          location: 1
          })

          xAxis.data.setAll(data);

          var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {
              strokeOpacity: 0.1
          })
          }));


          // Add series
          // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
          function makeSeries(name, fieldName) {
          var series = chart.series.push(am5xy.ColumnSeries.new(root, {
              name: name,
              xAxis: xAxis,
              yAxis: yAxis,
              valueYField: fieldName,
              categoryXField: "month"
          }));

          series.columns.template.setAll({
              tooltipText: "{name}, {categoryX}:{valueY}",
              width: am5.percent(90),
              tooltipY: 0,
              strokeOpacity: 0
          });

          series.data.setAll(data);

          // Make stuff animate on load
          // https://www.amcharts.com/docs/v5/concepts/animations/
          series.appear();

          series.bullets.push(function() {
              return am5.Bullet.new(root, {
              locationY: 0,
              sprite: am5.Label.new(root, {
                  text: "{valueY}",
                  fill: root.interfaceColors.get("alternativeText"),
                  centerY: 0,
                  centerX: am5.p50,
                  populateText: true
              })
              });
          });

          legend.data.push(series);
          }

          makeSeries("Amoxicilin", "aoxicilin");
          makeSeries("Morphine", "morphine");
          makeSeries("Nicip Plus", "nicip plus");
          makeSeries("Acetaminophen", "acetaminophen");
          makeSeries("Paracetamol", "paracetamol");
          makeSeries("Rigix", "rigix");


          // Make stuff animate on load
          // https://www.amcharts.com/docs/v5/concepts/animations/
          chart.appear(1000, 100);

          }); // end am5.ready()
        </script>
        
        <div hidden>
          <!-- JavaScript -->
          <script hidden>
          am5.ready(function() {
            var root = am5.Root.new("chartdiv");
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
              panX: false,
              panY: false,
              wheelX: "panX",
              wheelY: "zoomX",
              layout: root.verticalLayout
            }));

            var legend = chart.children.push(am5.Legend.new(root, {
              centerX: am5.p50,
              x: am5.p50
            }));

            // Fetch data from PHP script
            am5.utils.loadScript("php/fetch_sales_data.php", function(data) {
              // Process fetched data and create the trend analysis chart
              var fetchedData = window.salesData;

              // Find the top 6 medicines based on quantity
              var topMedicines = Object.keys(fetchedData)
                .sort((a, b) => fetchedData[b].totalQuantity - fetchedData[a].totalQuantity)
                .slice(0, 6);

              // Add series for each top medicine
              topMedicines.forEach(function(medicine) {
                makeSeries(medicine, medicine);
            });

            function createChart(data) {
              var xRenderer = am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9
              });

              var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "month",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
              }));

              xRenderer.grid.template.setAll({
                location: 1
              });

              xAxis.data.setAll(data);

              var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                  strokeOpacity: 0.1
                })
              }));

              function makeSeries(name, fieldName) {
                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                  name: name,
                  xAxis: xAxis,
                  yAxis: yAxis,
                  valueYField: fieldName,
                  categoryXField: "month"
                }));

                series.columns.template.setAll({
                  tooltipText: "{name}, {categoryX}:{valueY}",
                  width: am5.percent(90),
                  tooltipY: 0,
                  strokeOpacity: 0
                });

                series.data.setAll(data);

                series.appear();

                series.bullets.push(function() {
                  return am5.Bullet.new(root, {
                    locationY: 0,
                    sprite: am5.Label.new(root, {
                      text: "{valueY}",
                      fill: root.interfaceColors.get("alternativeText"),
                      centerY: 0,
                      centerX: am5.p50,
                      populateText: true
                    })
                  });
                });

                legend.data.push(series);
              }

              chart.appear(1000, 100);
            }
          });
          </script>

        </div>
        <!-- HTML -->
        <div id="chartdiv"></div>
        <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>

        <h5  class="fas fa-brain"> Predictive Analysis Table</h5>
        <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  red;">
        </div>
        <div id="tablediv">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 table-responsive">
              <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
                <thead>
                  <tr>
                    <th>Medicine Name</th>
                    <th>Quantity Sold</th>
                    <th>Quantity To Reorder</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require "php/db_connection.php";
                  $query = "SELECT DISTINCT sales.PRODUCT_ID, medicines.NAME
                            FROM sales
                            INNER JOIN invoices ON sales.INVOICE_ID = invoices.INVOICE_ID 
                            INNER JOIN medicines ON sales.PRODUCT_ID = medicines.PRODUCT_ID
                            WHERE invoices.INVOICE_DATE >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
                            GROUP BY sales.PRODUCT_ID, medicines.NAME
                            ORDER BY COUNT(*) DESC
                            LIMIT 4";
                  
                  $result = mysqli_query($con, $query);  
                  while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['PRODUCT_ID'];
                    $medicine_name = $row['NAME'];

                    $query2 = "SELECT SUM(sales.QUANTITY) AS total_quantity_sold
                              FROM sales
                              INNER JOIN invoices ON sales.INVOICE_ID = invoices.INVOICE_ID 
                              WHERE sales.PRODUCT_ID = '$product_id' AND invoices.INVOICE_DATE >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";
                    
                    $result2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($result2);
                    $quantity_sold = $row2['total_quantity_sold'];

                    // Calculate quantity to reorder
                    $quantity_to_reorder = ceil($quantity_sold / 3) + 5;

                    ?>
                    <tr>
                      <td><?php echo $medicine_name; ?></td>
                      <td><?php echo $quantity_sold; ?></td>
                      <td><?php echo $quantity_to_reorder; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>     
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>