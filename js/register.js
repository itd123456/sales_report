userData = '';

$('#registerBtn').on('click', function()
{
	fname = $('#firstName').val();
	lname = $('#lastName').val();
	email = $('#inputEmail').val();
	pass = $('#inputPassword').val();
	confirm = $('#confirmPassword').val();

	data = 
	{
		fname : fname,
		lname : lname,
		email : email,
		pass : pass,
		confirm : confirm
	}

	userData = data;

	if (!fname || !lname || !email || !pass || !confirm)
	{
		$('#requiredModal').modal();
	}
	else
	{
		$.ajax(
		{
			type : "POST",
			url : './php/checkEmail.php',
			data : data,
			dataType : "json",
			success : function(data)
			{
				len = data.length;

				if (len > 0)
				{
					$('#emailModal').modal();
				}
				else if (pass != confirm)
				{
					$('#passwordModal').modal();
				}
				else
				{
					registerUser(userData);
				}
			}
		});
	}
});

$('#loginNow').on('click', function()
{
	window.location.replace('login.html');
});

function registerUser(data)
{
	$.ajax(
	{
		type : "POST",
		url : './php/registerUser.php',
		data : data,
		dataType : "",
		success : function()
		{
			$('#firstName').val('');
			$('#lastName').val('');
			$('#inputEmail').val('');
			$('#inputPassword').val('');
			$('#confirmPassword').val('');

			$('#registerModal').modal();
		}
	})
}