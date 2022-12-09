<!DOCTYPE html>
<html lang="{$lang}" direction={$direction}>
<head>
{include "$siteRoot/core/templates/head.tpl"}
</head>
<body class="bg-primary">
        <!-- Layout wrapper-->
        <div id="layoutAuthentication">
            <!-- Layout content-->
            <div id="layoutAuthentication_content">
                <!-- Main page content-->
                <main>
                    <!-- Main content container-->
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-7 col-xl-10">
                                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-5">
                                    <div class="card-body p-5">
                                        <!-- Auth header with logo image-->
                                        <div class="text-center">
                                            <img class="mb-3" src="{$siteUrl}/core/templates/img/logo.png" alt="{$title}" style="height: 48px" />
										<h1 class="display-5 mb-20">{form_lang value="Registrazione"}</h1>
                                        </div>
                                        <!-- Register new account form-->
                                        {form_opening}
                                        	{$mainMessages}{$mainWarnings}{$mainErrors}{$mainInfo}
                                            <div class="row">
                                                <div class="col-sm-6 mb-4">{form_tbox iname='cognome' mdc=true placeholder="{form_lang value='Cognome'}" outlined=true required="required"}</div>
                                                <div class="col-sm-6 mb-4">{form_tbox iname='nome' mdc=true placeholder="{form_lang value='Nome'}" outlined=true required="required"}</div>
                                            </div>
                                            <div class="mb-4">{form_tbox iname='email' type='email' mdc=true placeholder="{form_lang value='Indirizzo email'}" outlined=true required="required"}</div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-4">{form_tbox mdc=true iname='password' type='password' placeholder="Password" outlined=true img="visibility_off" required="required"}
                                                	<div class="mdc-text-field-helper-line">
  														<div id="password" class="mdc-text-field-helper-text alert alert-info" aria-hidden="true">
  															<span>{form_lang value="Deve contenere"}</span>
    														<ul>
																<li>{form_lang value="un numero"}</li>
																<li>{form_lang value="un carattere minuscolo"}</li>
																<li>{form_lang value="un carattere maiuscolo"}</li>
																<li>{form_lang value="un carattere compreso tra "}<b class='text text-muted'>!.@#$%</b></li>
																<li>{form_lang value="avere lunghezza tra 8 e 20 caratteri"}</li>
															</ul>
  														</div>
													</div>
												</div>
                                                <div class="col-sm-6 mb-4">{form_tbox mdc=true iname='password2' type='password' placeholder="Verifica Password" outlined=true img="visibility_off" required="required"}
                                                	<div class="mdc-text-field-helper-line">
  														<div id="password2" class="mdc-text-field-helper-text alert alert-info" aria-hidden="true">
  															<span>{form_lang value="Deve contenere"}</span>
    														<ul>
																<li>{form_lang value="un numero"}</li>
																<li>{form_lang value="un carattere minuscolo"}</li>
																<li>{form_lang value="un carattere maiuscolo"}</li>
																<li>{form_lang value="un carattere compreso tra "}<b class='text text-muted'>!.@#$%</b></li>
																<li>{form_lang value="avere lunghezza tra 8 e 20 caratteri"}</li>
															</ul>
  														</div>
													</div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                {form_check iname='condizioni' label="{form_lang value='Accetto temini e condizioni'}" mwc=true required="required"}
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small fw-500 text-decoration-none" href="{$siteUrl}/authentication/login">{form_lang value="Login"}</a>
                                                <button class="btn btn-primary" type="submit" onclick="return formRegister();">{form_lang value="Crea Account"}</button>
                                            </div>
                                        {form_closing}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Layout footer-->
		<div id="layoutAuthentication_footer">
			<!-- Auth footer-->
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
	{include "$siteRoot/core/templates/foot.tpl"}
</body>
</html>