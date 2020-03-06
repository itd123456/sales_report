// Set new default font family and font color to mimic Bootstrap's default styling
  var group = '';
  var max = 0;

  //format the number
  function formatNumber(num) 
  {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }

  //disable all the annual field
  $('#monthly').on('click', function()
    {
      $('#annually').prop('checked', false);
      $('#annual_group').prop('disabled', true);
      $('#annual_year').prop('disabled', true);
      $('#annual_target').prop('disabled', true);
      $('#annual_generate').prop('disabled', true);

      $('#per_group').prop('disabled', false);
      $('#month').prop('disabled', false);
      $('#year').prop('disabled', false);
      $('#target').prop('disabled', false);
      $('#sure_cycle').prop('disabled', false);
    })
  //disable all monthly field
  $('#annually').on('click', function()
    {
      $('#monthly').prop('checked', false);
      $('#per_group').prop('disabled', true);
      $('#month').prop('disabled', true);
      $('#year').prop('disabled', true);
      $('#target').prop('disabled', true);
      $('#sure_cycle').prop('disabled', true);

      $('#annual_group').prop('disabled', false);
      $('#annual_year').prop('disabled', false);
      $('#annual_target').prop('disabled', false);
      $('#annual_generate').prop('disabled', false);
    });

  //annually sales generate
  $('#annual_generate').on('click', function()
  {
      group = $('#annual_group').val();
      year = $('#annual_year').val();
      time_frame = "annually";
      isAll = 0;

      if (group == 'all')
      {
        isAll = 1;
      }
      data = 
      {
          group : group,
          year : year,
          time_frame : time_frame,
          isAll : isAll
      }

      max = parseInt($('#annual_target').val());
      var label = [];
      var value = [];
      var color = [];
      var branches = [];

      $.ajax(
        {
          type : "POST",
          url : "./php/group.php",
          data : data,
          dataType: "json",  
          success : function(data)
          {
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var len = data.length;

            for (var i = 0; i < len; i++)
            {
                //sales amount
                var amount = parseInt(data[i].total);
                
                //format the amount
                var amountView = formatNumber(amount);
                //get the percentage
                var percent = amount/(max/100);

                //push the amount value of var
                value.push(amount);
                //set the color of bar
                if(percent.toFixed(2) <= 50.99)
                {
                    color.push("red");
                }
                else if (percent.toFixed(2) <= 69.99)
                {
                    color.push("yellow");
                }
                else
                {
                    color.push("green");
                }

                branches.push(data[i]['branch']);
                label.push('P '+amountView+ ' ( ' + percent.toFixed(2) + '% )');
            }

            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: label,
                datasets: [{
                  label: "Sales",
                  backgroundColor: color,
                  borderColor: "rgba(2,117,216,1)",
                  data: value,
                  branches: branches
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'month'
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 60
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: max,
                      maxTicksLimit: 15
                    },
                    gridLines: {
                      display: true
                    }
                  }],
                },
                legend: {
                  display: false
                },
                animation: {
                onComplete: function () {
                  var chartInstance = this.chart;
                  var ctx = chartInstance.ctx;
                  var height = chartInstance.controller.boxes[0].bottom;
                  ctx.textAlign = "center";
                  Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    Chart.helpers.each(meta.data.forEach(function (bar, index) {
                      ctx.fillText(dataset.branches[index], bar._model.x, height - ((height - bar._model.y)) - 10);
                    }),this)
                  }),this);
                }
              }
              }
            });
          }
        });
  });

  //monthly sales generate
  $('#sure_cycle').on('click', function()
  {
      barGraph();
  })

  function barGraph()
  {
    group = $('#per_group').val();
    month = $('#month').val();
    year = $('#year').val();
    time_frame = "monthly";
    isAll = 0;
      
    if (group == 'all')
    {
      isAll = 1;
    }
      

    max = parseInt($('#target').val());
    var label = [];
    var value = [];
    var color = [];

    $.ajax(
    {
      type: "POST",
      url: "./php/group.php",
      data: {group : group,
             month : month,
             year : year,
             time_frame : time_frame,
             isAll : isAll},             
      dataType: "json",            
      success: function(data)
      {                    
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var len = data.length;

        for (var i = 0; i < len; i++)
        {
            //sales amount
            var amount = parseInt(data[i].total);
            //format the amount
            var amountView = formatNumber(amount);
            //get the percentage
            var percent = amount/(max/100);

            //push the amount value of var
            value.push(amount);
            //set the color of bar
            if(percent.toFixed(2) <= 50.99)
            {
                color.push("red");
            }
            else if (percent.toFixed(2) <= 69.99)
            {
                color.push("yellow");
            }
            else
            {
                color.push("green");
            }

            label.push(data[i]['branch'] + ' - (P '+amountView+') ' + percent.toFixed(2) + '%');
        }

        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: label,
            datasets: [{
              label: "Sales",
              backgroundColor: color,
              borderColor: "rgba(2,117,216,1)",
              data: value,
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'month'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 60
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: max,
                  maxTicksLimit: 15
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
      }
    });
  }