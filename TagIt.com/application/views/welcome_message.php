<h3>Welcome to Facebook Application</h3>
	<div class="container">
	< ?php
	foreach ($friends as $id)
	{
	?>
	<div class='img'>
	    <fb :profile-pic uid='<?=$id?>' firstnameonly = 'true' linked='true' size='square'/>
	<div class='name'>
	        <fb :name uid='<?=$id?>' firstnameonly = 'true' capitalize='true'  useyou = 'false'/>
	    </fb></div>
	</fb></div>
	< ?php
	}
	?></div>