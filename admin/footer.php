
<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2014 | <a href="http://mygrenature.com/" target="_blank">BMC</a> </p>
      </div>
    </div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.js"></script> <!-- jQuery -->

<script src="<?php echo SITE_URL; ?>admin/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo SITE_URL; ?>admin/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- Morris JS -->
<script src="<?php echo SITE_URL; ?>admin/js/raphael-min.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/morris.min.js"></script>

<!-- jQuery Flot -->
<script src="<?php echo SITE_URL; ?>admin/js/excanvas.min.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/jquery.flot.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/jquery.flot.resize.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/jquery.flot.pie.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo SITE_URL; ?>admin/js/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo SITE_URL; ?>admin/js/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo SITE_URL; ?>admin/js/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo SITE_URL; ?>admin/js/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<!-- Daterangepicker -->
<script src="<?php echo SITE_URL; ?>admin/js/moment.min.js"></script>
<script src="<?php echo SITE_URL; ?>admin/js/daterangepicker.js"></script>

<script src="<?php echo SITE_URL; ?>admin/js/sparklines.js"></script> <!-- Sparklines -->
<!--<script src="js/jquery.gritter.min.js"></script> <!-- jQuery Gritter -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo SITE_URL; ?>admin/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->

<script src="<?php echo SITE_URL; ?>admin/js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll -->
<script src="<?php echo SITE_URL; ?>admin/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo SITE_URL; ?>admin/js/jquery.maskedinput.min.js"></script> <!-- jQuery Masked Input -->
<script src="<?php echo SITE_URL; ?>admin/js/dropzone.js"></script> <!-- jQuery Dropzone -->
<script src="<?php echo SITE_URL; ?>admin/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo SITE_URL; ?>admin/js/custom.js"></script> <!-- Custom codes -->
<script src="<?php echo SITE_URL; ?>admin/js/charts.js"></script> <!-- Charts & Graphs -->






<script type="text/javascript">

$(function () {

    /* Bar Chart starts */

    var d1 = [];
    for (var i = 0; i <= 20; i += 1)
        d1.push([i, parseInt(Math.random() * 30)]);

    var d2 = [];
    for (var i = 0; i <= 20; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);


    var stack = 0, bars = true, lines = false, steps = false;
    
    function plotWithOptions() {
        $.plot($("#bar-chart"), [ d1, d2 ], {
            series: {
                stack: stack,
                lines: { show: lines, fill: true, steps: steps },
                bars: { show: bars, barWidth: 0.8 }
            },
            grid: {
                borderWidth: 0, hoverable: true, color: "#777"
            },
            colors: ["#ff6c24", "#ff2424"],
            bars: {
                  show: true,
                  lineWidth: 0,
                  fill: true,
                  fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
            }
        });
    }

    plotWithOptions();
    
    $(".stackControls input").click(function (e) {
        e.preventDefault();
        stack = $(this).val() == "With stacking" ? true : null;
        plotWithOptions();
    });
    $(".graphControls input").click(function (e) {
        e.preventDefault();
        bars = $(this).val().indexOf("Bars") != -1;
        lines = $(this).val().indexOf("Lines") != -1;
        steps = $(this).val().indexOf("steps") != -1;
        plotWithOptions();
    });

    /* Bar chart ends */

});


/* Curve chart starts */

$(function () {
    var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }

    var plot = $.plot($("#curve-chart"),
           [ { data: sin, label: "sin(x)"}, { data: cos, label: "cos(x)" } ], {
               series: {
                   lines: { show: true, fill: true},
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true, borderWidth:0 },
               yaxis: { min: -1.2, max: 1.2 },
               colors: ["#1eafed", "#1eafed"]
             });

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #000',
            padding: '2px 8px',
            color: '#ccc',
            'background-color': '#000',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#curve-chart").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY, 
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    }); 

    $("#curve-chart").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
        }
    });

});

/* Curve chart ends */

var initCharts = function() {
  var charts = $('.percentage');
  charts.easyPieChart({
    animate: 1000,
    onStep: function(from, to, percent) {
		$(this.el).find('.percent').text(Math.round(percent));
	}
  });
  $('.updatePieCharts').on('click', function(e) {
    e.preventDefault();
    charts.each(function() {
      $(this).data('easyPieChart').update(Math.floor(100*Math.random()));
    });
  });
}

/* Realtime chart starts */

$(function () {
		initCharts();
	  Morris.Line({
	  element: 'morris1',
	  data: [
	    { y: '2006', a: 100, b: 90 },
	    { y: '2007', a: 75,  b: 65 },
	    { y: '2008', a: 50,  b: 40 },
	    { y: '2009', a: 75,  b: 65 },
	    { y: '2010', a: 50,  b: 40 },
	    { y: '2011', a: 75,  b: 65 },
	    { y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B']
	});

    Morris.Area({
	    element: 'morris2',
	    data: [
	      {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
	      {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
	      {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
	      {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
	      {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
	      {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
	      {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
	      {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
	      {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
	      {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
	    ],
	    xkey: 'period',
	    ykeys: ['iphone', 'ipad', 'itouch'],
	    labels: ['iPhone', 'iPad', 'iPod Touch'],
	    pointSize: 2,
	    hideHover: 'auto'
	  });

	Morris.Bar({
	  element: 'morris3',
	  data: [
	    { y: '2006', a: 100, b: 90 },
	    { y: '2007', a: 75,  b: 65 },
	    { y: '2008', a: 50,  b: 40 },
	    { y: '2009', a: 75,  b: 65 },
	    { y: '2010', a: 50,  b: 40 },
	    { y: '2011', a: 75,  b: 65 },
	    { y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B']
	});

	Morris.Donut({
    element: 'morris4',
    data: [
      {label: 'Jam', value: 25 },
      {label: 'Frosted', value: 40 },
      {label: 'Custard', value: 25 },
      {label: 'Sugar', value: 10 }
    ],
    formatter: function (y) { return y + "%" }
  });
	
    // we use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [], totalPoints = 300;
    function getRandomData() {
        if (data.length > 0)
            data = data.slice(1);

        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50;
            var y = prev + Math.random() * 10 - 5;
            if (y < 10)
                y = 10;
            if (y > 70)
                y = 70;
            data.push(y);
        }

        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }

    // setup control widget
    var updateInterval = 300;
    $("#updateInterval").val(updateInterval).change(function () {
        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            if (updateInterval < 1)
                updateInterval = 1;
            if (updateInterval > 2000)
                updateInterval = 2000;
            $(this).val("" + updateInterval);
        }
    });

    // setup plot
    var options = {
        series: { shadowSize: 0 }, // drawing is faster without shadows
        lines: {fill: true},
        grid: {borderWidth:0 },
        yaxis: { min: 0, max: 100 },
        colors: ["#ff2424"]
    };
    var plot = $.plot($("#live-chart"), [ getRandomData() ], options);

    function update() {
        plot.setData([ getRandomData() ]);
        // since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        
        setTimeout(update, updateInterval);
    }

    update();
});

/* Realtime charts ends */

/* Pie chart starts */

$(function () {

    var data = [];
    var series = Math.floor(Math.random()*10)+1;
    for( var i = 0; i<series; i++)
    {
        data[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
    }

    $.plot($("#pie-chart"), data,
    {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: function(label, series){
                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                    },
                    background: { opacity: 0 }
                }
            }
        },
        grid: {hoverable: true},
        legend: {
            show: false
        }
    }); 

    $.plot($("#pie-chart2"), data,
    {
        series: {
            pie: {
                show: true
            }
        },
        grid: {hoverable: true}
    });


    $.plot($("#pie-chart3"), data,
    {
        series: {
            pie: {
                show: true
            }
        },
        grid: {hoverable: true},
        legend: {
            show: false
        }
    });   

/* Pie chart ends */

});


</script>
</body>
</html>