<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="none" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description"
	content="Biobank Open Project, è stato realizzato con lo scopo di consentire la gestione on line delle notifiche di attività con metodo biologico, dei programmi annuali di produzione (Pap), delle varie comunicazioni e documentazione relativa all'agricoltura biologica.">
<meta name="author" content="Regione {Config::$config["denominazione"]}">
<title>{$title}</title>

<!-- Bootstrap Core CSS -->
<link
	href="{$siteUrl}/core/templates/vendor/bootstrap/css/bootstrap.min.css"
	rel="stylesheet">

<!-- DataTables CSS -->
<link
	href="{$siteUrl}/core/templates/vendor/datatables-plugins/dataTables.bootstrap.css"
	rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link
	href="{$siteUrl}/core/templates/vendor/datatables-responsive/dataTables.responsive.css"
	rel="stylesheet">

<!-- Custom CSS -->
<link href="{$siteUrl}/core/templates/css/common.css" rel="stylesheet">

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

<style>
.login-sidebar:after {
	background: rgba(0, 0, 0, 0)
		-moz-linear-gradient(-135deg, #ffffff, #ffffff) repeat scroll 0 0;
	background: -webkit-linear-gradient(-135deg, #ffffff, #ffffff);
}

.login-button, .bar:before, .bar:after {
	background: #22a7f0 none repeat scroll 0 0;
}
</style>



<div class="row">
	<div class="faded-bg animated"></div>
	<div class="col-sm-12 col-md-12">
		<div class="clearfix">
			<div class="col-sm-12 col-md-12">
				<div class="logo-title-container logo-title-container">
					<div id='errorbox'>{$mainMessages}{$mainWarnings}{$mainErrors}</div>
					<form method="post" role='form' class="col-lg-6 col-md-offset-3">
						{$formToken} {form_hidden iname='form_action'}
						<h1>Recupero dati di accesso</h1>
						<div class="panel">
							<blockquote><p>Hai dimenticato i dati di accesso?</p><small>Inserisci l'email usata in fase di registrazione ed il codice di sicurezza e clicca sul tasto "Recupera".</small></blockquote>
						</div>

						<div class="form-group input-group">
							<span class="input-group-addon">@</span>{form_tbox iname='email'
							size=30 max=45 tabindex='11' placeholder="Email" type='email' required="email"
							oninvalid="this.setCustomValidity('Email obbligatoria')"}
						</div>

						<div class="form-group">{$captcha}</div>



						<div class='btn-group'>
							<input type='button' value="Recupera" onclick='recovery(this);' class="btn btn-primary" />
								
							
						<a href="{$siteUrl}" class="btn btn-default">Annulla</a>
					
						</div>
						
						
					</form>
				</div>
				<!-- .logo-title-container -->

			</div>

		</div>

	</div>


</div>
<!-- .row -->
</div>
<!-- .container-fluid -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script
	src="{$siteUrl}/core/templates/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Bootbox dialog boxes JavaScript -->
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- Bootstrap Notify -->
<script
	src="{$siteUrl}/core/templates/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>

<!-- DataTables JavaScript -->
<script
	src="{$siteUrl}/core/templates/vendor/datatables/js/jquery.dataTables.js"></script>
<script
	src="{$siteUrl}/core/templates/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script
	src="{$siteUrl}/core/templates/vendor/datatables-responsive/dataTables.responsive.js"></script>


<!-- Custom Theme JavaScript -->
<script src="{$siteUrl}/core/templates/js/template-script.js"></script>


<!-- Main JavaScript -->
<script src="{$siteUrl}/core/templates/js/main.js"></script>


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
