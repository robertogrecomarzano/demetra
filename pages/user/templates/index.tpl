{form_opening class="col-lg-8 col-md-offset-2"}
	<div class="row">

		<div class="col-lg-6">
			<h3>Dati utente</h3>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user'></i></span>{form_tbox
				iname='cognome' size=30 max=45 tabindex='1' placeholder="Cognome"
				required=""}
			</div>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user'></i></span>{form_tbox
				iname='nome' size=30 max=45 tabindex='2' placeholder="Nome"
				required=""}
			</div>
			<div class="form-group input-group">
				<span class="input-group-addon">@</span>{form_tbox iname='email'
				size=30 max=45 tabindex='11' placeholder='Indirizzo email'
				type='email' required="email"}
			</div>
			{$captcha}
		</div>
		<!-- /.col-lg-4 (nested) -->


		<div class="col-lg-6">
			<h3>Dati di accesso</h3>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user-secret'></i></span>
				{form_tbox iname='username' size=20 max=45 tabindex='13'
				placeholder='Username' required=""}
			</div>

			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-key'></i></span>{form_tbox
				iname='password' size=20 max=45 tabindex='14' placeholder='Password'
				type='password' required=""}
			</div>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-key'></i></span>{form_tbox
				iname='password2' size=20 max=45 tabindex='15' placeholder='Conferma password' type='password' required=""}
			</div>
			<label class='alert alert-info'>La password deve contenere almeno:
				<ul>
					<li>un numero</li>
					<li>un carattere minuscolo</li>
					<li>un carattere maiuscolo</li>
					<li>un carattere compreso tra <b class='text text-muted'>!.@#$%</b></li>
					<li>avere lunghezza tra 8 e 20 caratteri</li>
				</ul>
			</label>
		</div>


	</div>
	<div class="btn-group"><input type='submit' name=signup ' value='Conferma dati' onclick='return Check(this);' class="btn btn-primary" /></div>
{form_closing}