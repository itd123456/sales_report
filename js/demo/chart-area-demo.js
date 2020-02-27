$(document).ready(function()
{
  $.ajax(
  {
    type : "POST",
    url : './php/checkSession.php',
    data : "",
    dataType : "json",
    success : function(data)
    {
      email = data['email'];

      if (!email)
      {
        window.location.replace('login.html');
      }
    }
  });

  $.ajax(
  {
    type : "POST",
    url : "./php/year.php",
    dataType : "",
    success : function(data)
    {
      year = JSON.parse(data);
      var yearLen = year.length;
      
      current_year = year[yearLen - 1]['year'];

      $('#copyyear').html(current_year);

      for (var i = 0; i < yearLen; i++)
      {
        $('#year').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#area_year').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#annual_year').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#pie_year').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#pie_year1').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#pie_year2').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
        $('#pie_year3').append($('<option>', {value:year[i]['year'], text:year[i]['year']}));
      }

      barGraph();
      pieGraphh();
      
      table = $('#area_group').val();
      branch_code = $('#area_branch').val();
      month = $('#area_month').val();
      year = $('#area_year').val();

      data = 
      {
        table : table,
        branch_code : branch_code,
        month : month,
        year : year,
      }

      $.ajax(
      {
          type : "POST",
          url : "./php/area.php",
          data : data,
          dataType : "json",
          success : function(data)
          {
            var len = data.length;
            var labels = [];
            var datas = [];

            for (var i = 0; i < len; i++)
            {
              var sales = data[i]['daily_sales'];
              var date = data[i]['date'];

              labels.push(date + " (" + formatNumber(parseInt(sales)) + ")");
              datas.push(sales);
            }

            graph(labels, datas);
          }
      });
    }
  });
})

//add option in select tag with id month
var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var val = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
var month_length = month.length;

for (var i = 0; i < month_length; i++)
{
  $('#month').append($('<option>', {value:val[i], text:month[i]}));
  $('#area_month').append($('<option>', {value:val[i], text:month[i]}));
  $('#pie_month').append($('<option>', {value:val[i], text:month[i]}));
  $('#pie_month1').append($('<option>', {value:val[i], text:month[i]}));
}

$('#area_group').change(function()
{
   $selected = $(this).val();

   if ($selected == 'sure_cycle')
   {
      $('#area_branch').html('');

      var branch = ['Digos Trike', 'SC Koronadal', 'SC Panabo'];
      var code = ['510', '511', '512'];
      var len = branch.length;

      for (var i = 0; i < len; i++)
      {
          $('#area_branch').append($('<option>', {value:code[i], text:branch[i]}));
      }
   }
   else
   {
      $('#area_branch').html('');

      $('#area_branch').append($('<option>', {value:'sample', text:'sample'}));
   }
})

function formatNumber(num) 
{
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

$('#area_generate').on('click', function()
{
    $table = $('#area_group').val();
    $branch_code = $('#area_branch').val();
    $month = $('#area_month').val();
    $year = $('#area_year').val();
    $target = $('#area_target').val();
    $target = parseInt($target);

    $data = 
    {
      table : $table,
      branch_code : $branch_code,
      month : $month,
      year : $year,
    }

    $.ajax(
    {
        type : "POST",
        url : "./php/area.php",
        data : $data,
        dataType : "json",
        success : function(data)
        {
          var len = data.length;
          var labels = [];
          var datas = [];

          for (var i = 0; i < len; i++)
          {
            var sales = data[i]['daily_sales'];
            var date = data[i]['date'];

            labels.push(date + " (" + formatNumber(parseInt(sales)) + ")");
            datas.push(sales);
          }

          graph(labels, datas);
        }
    });
})

$('#logoutBtn').on('click', function()
{
    $.ajax(
    {
        type : "POST",
        url : './php/destroySession.php',
        data : "",
        dataType : "",
        success : function()
        {
            window.location.replace('login.html');
        }
    });
});

function graph(labels, datas)
{
  target = $('#area_target').val();
  target = parseInt(target);

  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';

  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: "Sales",
        lineTension: 0.5,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 7,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 10,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 0,
        pointBorderWidth: 0,
        data: datas,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
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
            max: target,
            maxTicksLimit: 15
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}