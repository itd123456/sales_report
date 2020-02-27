emailToReset = '';

$('#resetPass').on('click', function()
{
	email = $('#inputEmail').val();

	data =
	{
		email : email
	}

	emailToReset = data;

	$.ajax(
	{
		type : "POST",
		url : './php/checkEmail.php',
		data : data,
		dataType : "json",
		success : function(data)
		{
			len = data.length;

			if (len < 1)
			{
				$('#emailModal').modal();
			}
			else
			{
				resetPass(emailToReset);
			}
		}
	});
});

$('#goBack').on('click', function()
{
	window.location.replace('login.html');
});

function resetPass(data)
{
	$.ajax(
	{
		type : "POST",
		url : './php/emailer.php',
		data : data,
		dataType : "",
		success : function()
		{
			$('#inputEmail').val('');
			$('#newPassModal').modal();
		}
	});
}