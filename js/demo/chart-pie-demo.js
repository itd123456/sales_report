$('#vsMon').on('click', function()
{
	pieGraphh();
});

$('#vsYear').on('click', function()
{
	group11 = $('#pie_group2 option:selected').html();
	branch11 = $('#pie_branch2 option:selected').html();

	group22 = $('#pie_group3 option:selected').html();
	branch22 = $('#pie_branch3 option:selected').html();

	datas =
	{
		group1 : $('#pie_group2').val(),
		branch1 : $('#pie_branch2').val(),
		year1 : $('#pie_year2').val(),
		group2 : $('#pie_group3').val(),
		branch2 : $('#pie_branch3').val(),
		year2 : $('#pie_year3').val(),
		time : 'yearly'
	}
	
	$.ajax(
	{
		type : "POST",
		url : "./php/monVsMon.php",
	    data : datas,
	    dataType: "json",  
	    success : function(data)
	    {
	    	console.log(data);
	    	datass = [];

	    	res1 = data['result1'];
	    	res2 = data['result2'];
	
	    	r1Len = res1.length;
	    	r2Len = res2.length;

	    	total1 = 0;
	    	total2 = 0;

	    	for (i = 0; i < r1Len; i++)
	    	{
	    		total = res1[i]['total'];
	    		total1 += parseInt(total);
	    	}

	    	datass.push(total1);
	    	
	    	for (i = 0; i < r2Len; i++)
	    	{
	    		total = res2[i]['total'];
	    		total2 += parseInt(total);
	    	}

	    	datass.push(total2);

	    	blue = group11 + ' (' + branch11 + ') P ' + formatNumber(total1);
	    	red =  group22 + ' (' + branch22 + ') P ' + formatNumber(total2);

	    	labels = [blue, red];

	    	pieGraph(labels, datass);
	    }
	});
});

$('#month_vs_month').on('click', function()
{
  $('#yr_vs_yr').prop('checked', false);
  $('#pie_group2').prop('disabled', true);
  $('#pie_branch2').prop('disabled', true);
  $('#pie_month2').prop('disabled', true);
  $('#pie_year2').prop('disabled', true);
  $('#pie_group3').prop('disabled', true);
  $('#pie_branch3').prop('disabled', true);
  $('#pie_month3').prop('disabled', true);
  $('#pie_year3').prop('disabled', true);
  $('#vsYear').prop('disabled', true);

  $('#pie_group').prop('disabled', false);
  $('#pie_branch').prop('disabled', false);
  $('#pie_month').prop('disabled', false);
  $('#pie_year').prop('disabled', false);
  $('#pie_group1').prop('disabled', false);
  $('#pie_branch1').prop('disabled', false);
  $('#pie_month1').prop('disabled', false);
  $('#pie_year1').prop('disabled', false);
  $('#vsMon').prop('disabled', false);
})

$('#yr_vs_yr').on('click', function()
{
  $('#month_vs_month').prop('checked', false);
  $('#pie_group').prop('disabled', true);
  $('#pie_branch').prop('disabled', true);
  $('#pie_month').prop('disabled', true);
  $('#pie_year').prop('disabled', true);
  $('#pie_group1').prop('disabled', true);
  $('#pie_branch1').prop('disabled', true);
  $('#pie_month1').prop('disabled', true);
  $('#pie_year1').prop('disabled', true);
  $('#vsMon').prop('disabled', true);

  $('#pie_group2').prop('disabled', false);
  $('#pie_branch2').prop('disabled', false);
  $('#pie_month2').prop('disabled', false);
  $('#pie_year2').prop('disabled', false);
  $('#pie_group3').prop('disabled', false);
  $('#pie_branch3').prop('disabled', false);
  $('#pie_month3').prop('disabled', false);
  $('#pie_year3').prop('disabled', false);
  $('#vsYear').prop('disabled', false);
});

function pieGraph(labels, datass)
{
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#292b2c';

	// Pie Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
	  type: 'pie',
	  data: {
	    labels: labels,
	    datasets: [{
	      data: datass,
	      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
	    }],
	  },
	});
}

function pieGraphh()
{
	group11 = $('#pie_group option:selected').html();
	branch11 = $('#pie_branch option:selected').html();
	month11 = $('#pie_month option:selected').html();
	year11 = $('#pie_year option:selected').html();

	group22 = $('#pie_group1 option:selected').html();
	branch22 = $('#pie_branch1 option:selected').html();
	month22 = $('#pie_month1 option:selected').html();
	year22 = $('#pie_year1 option:selected').html();

	datas =
	{
		group1 : $('#pie_group').val(),
		branch1 : $('#pie_branch').val(),
		month1 : $('#pie_month').val(),
		year1 : $('#pie_year').val(),
		group2 : $('#pie_group1').val(),
		branch2 : $('#pie_branch1').val(),
		month2 : $('#pie_month1').val(),
		year2 : $('#pie_year1').val(),
		time : 'monthly'
	}
	console.log(datas);
	$.ajax(
	{
		type : "POST",
		url : "./php/monVsMon.php",
	    data : datas,
	    dataType: "json",  
	    success : function(data)
	    {
	    	datass = [];

	    	res1 = data['result1'];
	    	res2 = data['result2'];
	
	    	r1Len = res1.length;
	    	r2Len = res2.length;

	    	total1 = 0;
	    	total2 = 0;

	    	for (i = 0; i < r1Len; i++)
	    	{
	    		total = res1[i]['total'];
	    		total1 += parseInt(total);
	    	}

	    	datass.push(total1);
	    	
	    	for (i = 0; i < r2Len; i++)
	    	{
	    		total = res2[i]['total'];
	    		total2 += parseInt(total);
	    	}

	    	datass.push(total2);

	    	blue = group11 + ' (' + branch11 + ') ' + month11 + ' ' + year11 + ' ( P ' + formatNumber(total1) + ' )';
	    	red =  group22 + ' (' + branch22 + ') ' + month22 + ' ' + year22 + ' ( P ' + formatNumber(total2) + ' )';

	    	labels = [blue, red];

	    	pieGraph(labels, datass);
	    }
	});
}

function formatNumber(num) 
{
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}