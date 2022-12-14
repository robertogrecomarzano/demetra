<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$title}</title>

<!-- Bootstrap Core CSS -->
<link
	href="{$siteUrl}/core/templates/vendor/bootstrap/css/bootstrap.min.css"
	rel="stylesheet">

<!-- Common CSS -->
<link href="{$siteUrl}/core/templates/css/common.css" rel="stylesheet">

<!-- Login CSS -->
<link href="{$siteUrl}/core/templates/css/login.css" rel="stylesheet">

<!-- font awesome  -->
<link
	href="{$siteUrl}/core/templates/vendor/font-poppins/font-poppins.css"
	rel="stylesheet">

<!-- font awesome  -->
<link
	href="{$siteUrl}/core/templates/vendor/font-awesome-free-5.6.3/css/all.css"
	rel="stylesheet">
<link
	href="{$siteUrl}/core/templates/vendor/font-awesome-4.7.0/css/font-awesome.min.css"
	rel="stylesheet">
	
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery -->

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">

					<div class="panel-body text-center">
						<img class="img img-responsive hidden-xs logo"
							src="{$siteUrl}/core/templates/img/{$logo}.png" />
						<div class="panel-body text-center">
							<h2 class='title lead'>{$title}</h2>
							<h4>IN MANUTENZIONE</h4>
							<form method="post" name="first" class="form-signin">
								{$formToken}
								<fieldset>
									<p id="profile-name" class="profile-name-card"></p>
									<div class="form-group input-group">
									<span class="input-group-addon"><i class='fas fa-user'></i></span>
										<input type="text" id="username" name="username"
											class="form-control" placeholder="Username" required
											style="width: 100%;">
									</div>
									<div class="form-group input-group">
									<span class="input-group-addon"><i class='fas fa-key'></i></span>
										<input type="password" name="password" id="password"
											class="form-control" placeholder="Password" required
											style="width: 100%;">
									</div>
									<div class="form-group">
										<button class="btn btn-lg btn-primary btn-block login-button"
											type="submit">Accedi</button>
									</div>
								</fieldset>
							</form>
							<a href="{$recoveryLink}"> Recupera credenziali di accesso </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JQuery -->
	<script
		src="{$siteUrl}/core/templates/vendor/jquery/jquery-3.3.1.min.js"></script>


	<!-- Bootstrap Core JavaScript -->
	<script
		src="{$siteUrl}/core/templates/vendor/bootstrap/js/bootstrap.min.js"></script>



	<!-- Bootbox dialog boxes JavaScript -->
	<script src="{$siteUrl}/core/templates/vendor/bootbox/bootbox.min.js"></script>

	<!-- Bootstrap Notify -->
	<script
		src="{$siteUrl}/core/templates/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>

	
	{$css}{$js}

		<div id='loading' onclick="$(this).hide();" class="modal fade in"
		tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		data-backdrop="static" data-keyboard="false"
		style="padding-right: 17px;" aria-hidden="false">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Attendi...</h4>
					<h4 class="modal-title">
						<small id="myModalLabel"></small>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="progress progress-striped active">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{$mainMessages}{$mainWarnings}{$mainErrors}{$mainInfo}

</body>
</html>