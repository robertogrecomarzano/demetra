<!DOCTYPE html>
<html lang="{$lang}" direction={$direction}>
<head>
{include "$siteRoot/core/templates/head.tpl"}
</head>
<body class="nav-fixed bg-light">
	<!-- Top app bar navigation menu-->
	<nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid px-4">
			<!-- Drawer toggle button-->
			<button class="btn btn-lg btn-icon order-1 order-lg-0"
				id="drawerToggle" href="javascript:void(0);">
				<i class="material-icons">menu</i>
			</button>
			<!-- Navbar brand-->
			<a class="navbar-brand me-auto" href="index.html"><div
					class="text-uppercase font-monospace">{$title}</div></a>
			<!-- Navbar items-->
			<div class="d-flex align-items-center mx-3 me-lg-0">
				<!-- Navbar-->
				<ul class="navbar-nav d-none d-lg-flex">
					<li class="nav-item"><a class="nav-link">Overview</a></li>
					<li class="nav-item"><a class="nav-link" target="_blank">Documentation</a></li>
				</ul>
				<!-- Navbar buttons-->
				<div class="d-flex">
					<!-- Messages dropdown-->
					<div class="dropdown dropdown-notifications d-none d-sm-block">
						<button class="btn btn-lg btn-icon dropdown-toggle me-3"
							id="dropdownMenuMessages" type="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="material-icons">mail_outline</i>
						</button>
						<ul
							class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden"
							aria-labelledby="dropdownMenuMessages">
							<li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Messages</h6></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item unread" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Hi there, I had a question about
												something, is there any way you can help me out?</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Juan Babin</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Thanks for the assistance the other
												day, I wanted to follow up with you just to make sure
												everyting is settled.</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 10, 2021
											&middot; Christine Hendersen</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Welcome to our group! It's good to
												see new members and I know you will do great!</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 8, 2021
											&middot; Celia J. Knight</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item py-3" href="#!">
									<div
										class="d-flex align-items-center w-100 justify-content-end text-primary">
										<div class="fst-button small">View all</div>
										<i class="material-icons icon-sm ms-1">chevron_right</i>
									</div>
							</a></li>
						</ul>
					</div>
					<!-- Notifications and alerts dropdown-->
					<div class="dropdown dropdown-notifications d-none d-sm-block">
						<button class="btn btn-lg btn-icon dropdown-toggle me-3"
							id="dropdownMenuNotifications" type="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<i class="material-icons">notifications</i>
						</button>
						<ul
							class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden"
							aria-labelledby="dropdownMenuNotifications">
							<li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Alerts</h6></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item unread" href="#!"> <i
									class="material-icons leading-icon">assessment</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Your March performance
											report is ready to view.</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Performance</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!"> <i
									class="material-icons leading-icon">check_circle</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Tracking codes
											successfully updated.</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Coverage</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!"> <i
									class="material-icons leading-icon">warning</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Tracking codes have
											changed and require manual action.</div>
										<div class="dropdown-item-content-subtext">Mar 8, 2021
											&middot; Coverage</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item py-3" href="#!">
									<div
										class="d-flex align-items-center w-100 justify-content-end text-primary">
										<div class="fst-button small">View all</div>
										<i class="material-icons icon-sm ms-1">chevron_right</i>
									</div>
							</a></li>
						</ul>
					</div>
					<!-- User profile dropdown-->
					<div class="dropdown">
						<button class="btn btn-lg btn-icon dropdown-toggle"
							id="dropdownMenuProfile" type="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="material-icons">person</i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end mt-3"
							aria-labelledby="dropdownMenuProfile">
							<li><a class="dropdown-item" href="{$siteUrl}/user/{$userId}"> <i
									class="material-icons leading-icon">person</i>
									<div class="me-3">{form_lang value="Profilo"}</div>
							</a></li>
							<li><hr class="dropdown-divider" /></li>
							<li><a class="dropdown-item" href="{$siteUrl}/authentication/logout"> <i
									class="material-icons leading-icon">logout</i>
									<div class="me-3">{form_lang value="Esci"}</div>
							</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<!-- Layout wrapper-->
	<div id="layoutDrawer">
		<!-- Layout navigation-->
		<div id="layoutDrawer_nav">
			<!-- Drawer navigation-->
			<nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
				<div class="drawer-menu">
					<div class="nav">{$left}</div>
				</div>
				<!-- Drawer footer        -->
				<div class="drawer-footer border-top">
					<div class="d-flex align-items-center">
						<i class="material-icons text-muted">account_circle</i>
						<div class="ms-3">
							<div class="caption">{form_lang value="Ciao"}</div>
							<div class="small fw-500">{$userNominativo}</div>
						</div>
					</div>
				</div>
			</nav>
		</div>



		<!-- Layout content-->
		<div id="layoutDrawer_content">
			
			<!-- Main page content-->
			<main>
				<div class="p-5">
					{$mainMessages}{$mainWarnings}{$mainErrors}{$mainInfo}
					<div class="card card-raised mb-5">
						<div class="card-body p-5">
							{if !empty($contentTitle)}<div class="card-title">{$contentTitle}</div>{/if}
							{if !empty($contentSubTitle)}<div class="card-subtitle mb-4">{$contentSubTitle}</div>{/if}
							{if !empty($dump)}<div class="border p-3 p-sm-4 bg-black shadow-2 small"><code class="text-white fs-6 mb-2">{$dump}</code></div>{/if}
							{include file="$pagina"}
						</div>
					</div>
				</div>
			</main>
			<!-- Footer-->
			<!-- Min-height is set inline to match the height of the drawer footer-->
			<footer class="py-4 mt-auto border-top" style="min-height: 74px">
				<div class="container-xl px-5">
					<div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
						<div class="me-sm-2">Copyright &copy; {$title} {$smarty.now|date_format:"%Y"}</div>
						<div class="d-flex ms-sm-2">
							<a class="text-decoration-none" href="#!">{form_lang value="Privacy Policy"}</a>
							<div class="mx-1">&middot;</div>
							<a class="text-decoration-none" href="#!">{form_lang value="Termini e condizioni"}</a>
						</div>
				</div>
				</div>
			</footer>
		</div>
	</div>
	
{include "$siteRoot/core/templates/foot.tpl"}
<!-- Hearbeat JavaScript -->
<script src="{$siteUrl}/core/templates/js/hearbeat.js"></script>
</body>
</html>