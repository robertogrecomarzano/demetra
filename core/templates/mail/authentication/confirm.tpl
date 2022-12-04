{include file="{$siteRoot}/core/templates/mail/header_mail.tpl"}
<p>
	Per confermare la registrazione clicca sul seguente link <a
		href="{$siteUrl}/authentication/confirm?token={$params.token}">{$siteUrl}/authentication/confirm?token={$params.token}</a>
</p>
{include file="{$siteRoot}/core/templates/mail/footer_mail.tpl"}