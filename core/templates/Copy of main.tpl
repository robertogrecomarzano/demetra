<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$title}</title> {$css}
<!-- Bootstrap Core CSS -->
<link
	href="{$siteUrl}/core/templates/vendor/bootstrap/css/bootstrap.min.css"
	rel="stylesheet">


<!-- Common CSS -->
<link href="{$siteUrl}/core/templates/css/common.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{$siteUrl}/core/templates/css/style.css" rel="stylesheet">

<!-- Sidebar CSS -->
<link href="{$siteUrl}/core/templates/css/sidebar.css" rel="stylesheet">

<link href="{$siteUrl}/core/templates/css/custom.css" rel="stylesheet">

<!-- font poppins  -->
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


<!-- simplebar  -->
<link href="{$siteUrl}/core/templates/vendor/simplebar/simplebar.css"
	rel="stylesheet">
<script src="{$siteUrl}/core/templates/vendor/simplebar/simplebar.js"></script>

<!-- printJS -->
<script src='{$siteUrl}/core/templates/vendor/printjs/print.min.js'></script>
<link href="{$siteUrl}/core/templates/vendor/printjs/print.min.css"
	rel="stylesheet">

<!-- Chart JS -->
<script src='{$siteUrl}/core/templates/vendor/chart/chart.min.js'></script>

<link rel="shortcut icon"
	href="{$siteUrl}/core/templates/img/favicon.png">
</head>
<body>
	<div id='listposts'></div>
	<button onclick="topFunction()" id="myBtn" title="Torna su">
		<i class='fa fa-chevron-up'></i>
	</button>

	<!-- Modal -->
	<div class="modal fade" id="myCustomModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id='myCustomModalContent'>
				<div class="modal-header">
					<h2 class="modal-title" id="myCustomModalTitle"></h2>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id='myCustomModalBody'></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">chiudi</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->

	<div class="wrapper"
		
		<!-- Navigation -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<div class="profile clearfix">
					<div class="profile_info row">
						<div class="col-lg-9">{if !empty($userNominativo)} <span class="text-muted">Benvenuto<br /><em>{$userNominativo}</em></span>{/if}</div>
					</div>
				</div>
			</div>

			<ul class='list-unstyled' id='main'>{$left}
			</ul>
		</nav>

		<div id="content">
			<div class="container-fluid">

				<nav class="navbar navbar-default">

					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->


						<div class="navbar-header">
							<button type="button" id="sidebarCollapse"
								class="navbar-brand navbar-btn">
								<span></span> <span></span> <span></span>
							</button>
							<span class="lead">{$struttura}</span>
							<h5 style='margin-left: 42px; clear: both;' class="text-muted">{$top}</h5>
							<!-- >button type="button" class="navbar-toggle collapsed"
								data-toggle="collapse"
								data-target="#bs-example-navbar-collapse-1"
								aria-expanded="false">
								<span class="sr-only">Toggle navigation</span> <span
									class="icon-bar"></span> <span class="icon-bar"></span> <span
									class="icon-bar"></span>
							</button-->

						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<nav class="navbar-icon-top navbar-expand-lg">

							<div class="collapse navbar-collapse"
								id="bs-example-navbar-collapse-1">

								<div class="nav navbar-nav navbar-right">
									<ul class="nav navbar-top-links navbar-right">
										

										<li>{if
											!empty($userSimulationSuper)}{$userSimulationSuper}{/if}</li>
										{if $welcome != ""}{$userSimulationProfilo}

										<li class="dropdown"><a class="dropdown-toggle"
											data-toggle="dropdown" href="#"> <i
												class="fas fa-question-circle fa-2x text-primary"></i> <i
												class="fas fa-caret-down"></i>
										</a>
											<ul class="dropdown-menu dropdown-user">
												<li><a href="{$siteUrl}/public/aiuto/news"><i
														class="fas fa-newspaper fa-2x"></i>Avvisi</a></li>
												<li><a href="{$siteUrl}/public/aiuto/faq"><i
														class="fas fa-question-circle fa-2x"></i>Faq</a></li>
												<li><a href="{$siteUrl}/public/aiuto/ticket"><i
														class="fas fa-ticket-alt fa-2x"></i>Ticket</a></li>
											</ul></li> {$plgHelpMini}
										<li class="dropdown"><a class="dropdown-toggle"
											data-toggle="dropdown" href="#"> <span class="lead">{$userIniziali}</span><i
												class="fas fa-bars fa-2x"></i>
										</a>
											<ul class="dropdown-menu dropdown-user">
												<li><a href="{$siteUrl}/user">{$userNominativo}</a></li>
												<li class="divider"></li>
												<li><a href="{$siteUrl}/user"><i class="fas fa-user fa-2x"></i>
														Il tuo profilo</a></li>
												<li><a href="{$siteUrl}/user/settori"><i
														class="fas fa-tags fa-2x"></i>I miei settori</a></li>
												<li><a href="{$logout}"><i class="fas fa-sign-out-alt fa-2x"></i>
														Esci </a></li>
												<li>{if !empty($tecnico)}
													<form method="post">{$formToken}{$tecnico}</form>{/if}
												</li>
											</ul> <!-- /.dropdown-user --></li>
										<!-- /.dropdown -->
										{else}

										<li><a id='accedi' href="{$siteUrl}/login"><i
												class="fas fa-user fa-2x"></i> Accedi</a></li>
										</li>

										<!-- /.navbar-top-links -->

										{/if}
									</ul>
								</div>
							</div>
							<!-- /.navbar-collapse -->
						</nav>
					</div>
					<!-- /.container-fluid -->
				</nav>



			</div>



			<div id='helpdiv' class='helpdiv'>{$plgHelpDiv}</div>

			<!-- /.col-lg-12 -->


			<div class="container-fluid">
				{$newspic}

				<div class="row">
					<div class="col-lg-12">
						<div class="clearfix"></div>
						{$mainMessages}{$mainWarnings}{$mainErrors}{$mainInfo}
						{form_wizard}
						{*include file="$mainContent"*}
						{include file="$pagina"}
					</div>
					<!-- /.col-lg-12 -->

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

    <!-- Main JavaScript -->
	<script src="{$siteUrl}/core/templates/js/main.js"></script>
	
	<!-- Hearbeat JavaScript -->
	<script src="{$siteUrl}/core/templates/js/hearbeat.js"></script>

	<!-- Bootbox dialog boxes JavaScript -->
	<script src="{$siteUrl}/core/templates/vendor/bootbox/bootbox.min.js"></script>

	<!-- Bootstrap Notify -->
	<script
		src="{$siteUrl}/core/templates/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>

	<!-- DataTables -->
	<script
		src="{$siteUrl}/core/templates/vendor/datatables/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css"
		href="{$siteUrl}/core/templates/vendor/datatables/datatables.min.css" />

	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/datatables/datatables.min.js"></script>

	
	<!-- Moment and Datatables moment -->
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/moment/moment.min.js"></script>
		
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/datatables-moment/datetime-moment.js"></script>
		


	<!-- pdf make -->
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/pdfmake/pdfmake.min.js"></script>
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/pdfmake/vfs_fonts.js"></script>

	<!-- Summernote, usato per l'editing html -->
	<link href="{$siteUrl}/core/templates/vendor/summernote/summernote.css"
		rel="stylesheet">
	<script
		src="{$siteUrl}/core/templates/vendor/summernote/summernote.min.js"></script>
	<!-- include summernote- -->
	<script
		src="{$siteUrl}/core/templates/vendor/summernote/lang/summernote-it-IT.js"></script>
	<!-- include summernote cleaner-->
	<script
		src="{$siteUrl}/core/templates/vendor/summernote/summernote-cleaner.js"></script>

	{$js}

	<!-- bootstrap Toggle to convert checkboxes into toggles -->
	<link
		href="{$siteUrl}/core/templates/vendor/bootstrap-toggle/bootstrap-toggle.min.css"
		rel="stylesheet">
	<script
		src="{$siteUrl}/core/templates/vendor/bootstrap-toggle/bootstrap-toggle.min.js"></script>


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
	
	{literal}	
	<script type="text/javascript">
		$(document).ready(function() {

			$(document).ready(function() {
				$('#sidebarCollapse').on('click', function() {
					$('#sidebar').toggleClass('active');
					$(this).toggleClass('active');
				});
			});

			//$( "#sidebar ul.list-unstyled:has( > li.active:last):last").parent().css("padding-left", "10px");

			 //$( "#sidebar ul > li > ul.list-unstyled:has( > li.active:last):last").parent().css({'background':'white', 'color':'#38444f'});
			 
			 //$( "#sidebar ul > li > ul.list-unstyled:has( > li.active:last):last").parent().css("color":"#38444f");
			 
//			 $("#sidebar li.active").parent().css("border-right", "4px white");

			/*  $("#sidebar li>a").each(function() {
		    	  var that = $(this);
		    	  //var p = that.parentsUntil("ul#main").filter("li").length - 1;
		    	  that.css("padding-left", "10px");
		    	});*/

		    //$("#sidebar li.active").parent().css( "background-color", "#1A142F" );
		});
	</script>
	{/literal}
	<!-- start-smoth-scrolling -->
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/smart-scrolling/move-top.js"></script>
	<script type="text/javascript"
		src="{$siteUrl}/core/templates/vendor/smart-scrolling/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop : $(this.hash).offset().top
				}, 1000);
			});

			return false;
		});
		
	</script>
	<!-- //end-smoth-scrolling -->
	<!-- start validazione di campi numerici che hanno class number -->
	<script>	
	$('.number').on("keydown", function (e) {
    if (
        $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110,  190]) !== -1 ||
        ($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
        (e.keyCode >= 35 && e.keyCode <= 39)) 
        return;
    
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) 
        e.preventDefault();
    
});
</script>



	<!-- // end validazione di campi numerici che hanno class number -->
	
	<!-- // start disable backbutton -->
	<!-- script>
	function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
	</script-->
	<!-- // end disable backbutton -->
	{if $isDebug}
	<div class="clearfix debug-footer">DEBUG</div>
	{/if} {if $isCollaudo}
	<div class="clearfix debug-footer">COLLAUDO</div>
	{/if}
</body>
</html>