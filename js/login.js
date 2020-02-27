credentials = '';

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

			if (email)
			{
				window.location.replace('index.html');
			}
		}
	});
});

$('#loginBtn').on('click', function()
{
	email = $('#inputEmail').val();
	pass = $('#inputPassword').val();

	data = 
	{
		email : email,
		pass : pass
	}

	credentials = data;

	if (!email || !pass)
	{
		$('#invalidModal').modal();
	}
	else
	{
		checkCredentials(credentials);
	}
});

function checkCredentials(data)
{
	$.ajax(
	{
		type : "POST",
		url : './php/checkCredentials.php',
		data : data,
		dataType : "json",
		success : function(datas)
		{
			len = datas.length;

			if (len < 1)
			{
				$('#invalidModal').modal();
			}
			else
			{
				window.location.replace('index.html');
			}
		}
	});
}