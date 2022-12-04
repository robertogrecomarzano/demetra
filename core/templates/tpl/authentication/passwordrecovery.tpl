<!DOCTYPE html>
<html lang="en">
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
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                                    <div class="card-body p-5">
                                        <!-- Auth header with logo image-->
                                        <div class="text-center">
                                            <img class="mb-3" src="{$siteUrl}/core/templates/img/logo.png" alt="{$title}" style="height: 48px" />
                                            <h1 class="display-5 mb-4">{form_lang value="Resetta password"}</h1>
                                        </div>
                                        {$mainMessages}{$mainWarnings}{$mainErrors}{$mainInfo}
                                        {if !empty($dump)}<div class="border p-3 p-sm-4 bg-black shadow-2 small"><code class="text-white fs-6 mb-2">{$dump}</code></div>{/if}
                                        <!-- Reset password submission form-->
                                        {form_opening class="needs-validation" novalidate=""}
										
										
                                            <div class="mb-4">
                                            	<div class="input-group has-validation">
                                            		{form_tbox iname='email' type='email' mdc=true placeholder="{form_lang value='Indirizzo email'}" outlined=true required="required"}
      											</div>
      											<div class="form-group mt-5">{$captcha}</div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small fw-500 text-decoration-none" href="{$siteUrl}/authentication/login">{form_lang value="Ritorna al login"}</a>
                                                <button class="btn btn-primary" type="submit">{form_lang value="Resetta password"}</button>
                                            </div>
                                        {form_closing}
                                    </div>
                                </div>
                                <!-- Auth card message-->
                                <div class="text-center mb-5"><a class="small fw-500 text-decoration-none link-white" href="{$siteUrl}/authentication/register">{form_lang value="Non hai un account?"} {form_lang value="Registrati"}</a></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Layout footer-->
            <div id="layoutAuthentication_footer">
                <!-- Auth footer-->
                <footer class="p-4">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
                        <div class="me-sm-3 mb-2 mb-sm-0"><div class="fw-500 text-white">Copyright &copy; {$title} {$smarty.now|date_format:"%Y"}</div></div>
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
