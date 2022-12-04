<!DOCTYPE html>
<html lang="{$lang}" direction={$direction}>
<head>{include "$siteRoot/core/templates/head.tpl"}
</head>
<body>
	<!-- Layout wrapper-->
	<div id="layoutError">
		<!-- Layout content-->
		<div id="layoutError_content">
			<!-- Main page content-->
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<!-- Error message content-->
							<div class="text-center my-5 mt-sm-10">
								<img class="img-fluid mb-4"
									src="{$siteUrl}/core/templates/img/illustrations/error-404.svg"
									alt="404 {$title}"
									style="max-width: 30rem" />
								<p class="lead">{form_lang value="La risorsa cercata non è presente"}</p>
								<a class="btn btn-primary" href="{$siteUrl}"> <i
									class="material-icons leading-icon">arrow_back</i> {form_lang value="ritorna alla home"}
								</a>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<!-- Layout footer-->
		<div id="layoutError_footer">
			<!-- Footer-->
			<!-- Min-height is set inline to match the height of the drawer footer-->
			<footer class="p-4">
				<div
					class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
					<div class="me-sm-3 mb-2 mb-sm-0">
						<div class="fw-500 text-white">Copyright &copy; {$title} {$smarty.now|date_format:"%Y"}</div>
					</div>
					<div class="ms-sm-3">
						<a class="fw-500 text-decoration-none link-white" href="#!">{form_lang value="Privacy"}</a>
						<a class="fw-500 text-decoration-none link-white mx-4" href="#!">{form_lang value="Termini"}</a>
						<a class="fw-500 text-decoration-none link-white" href="#!">{form_lang value="Aiuto"}</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<!-- Load Bootstrap JS bundle-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!-- Load global scripts-->
	<script type="module" src="js/material.js"></script>
	<script src="js/scripts.js"></script>
</body>
</html>
