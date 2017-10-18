<?php
	if( Auth::guard('web')->check() )
	{
		?>
		<p>You are login as user</p>
		<?php
	}
	else
	{
		?>
		<p>You are logout as user</p>
		<?php
	}

	if( Auth::guard('admin')->check() )
	{
		?>
		<p>You are login as admin</p>
		<?php
	}
	else
	{
		?>
		<p>You are logout as admin</p>
		<?php
	}

?>