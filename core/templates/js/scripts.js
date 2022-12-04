var Localization = Localization || {};

/*!
	* Start Bootstrap - Material Admin Pro v1.0.5 (https://startbootstrap.com/theme/material-admin-pro)
	* Copyright 2013-2022 Start Bootstrap
	* Licensed under SEE_LICENSE (https://github.com/StartBootstrap/material-admin-pro/blob/master/LICENSE)
	*/
window.addEventListener('DOMContentLoaded', event => {
	// Enable tooltips globally
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});

	// Enable popovers globally
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
	var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl);
	});

	// Activate Bootstrap scrollspy for the sticky nav component
	const navStick = document.body.querySelector('#navStick');
	if (navStick) {
		new bootstrap.ScrollSpy(document.body, {
			target: '#navStick',
			offset: 150,
		});
	}

	// Toggle the side navigation
	const drawerToggle = document.body.querySelector('#drawerToggle');
	if (drawerToggle) {
		drawerToggle.addEventListener('click', event => {
			event.preventDefault();
			document.body.classList.toggle('drawer-toggled');
		});
	}

	// Close side navigation when width < LG
	const drawerContent = document.body.querySelector('#layoutDrawer_content');
	if (drawerContent) {
		drawerContent.addEventListener('click', event => {
			const BOOTSTRAP_LG_WIDTH = 992;
			if (window.innerWidth >= 992) {
				return;
			}
			if (document.body.classList.contains("drawer-toggled")) {
				document.body.classList.toggle("drawer-toggled");
			}
		});
	}


	// Add active state to sidbar nav links
	let activatedPath = window.location.pathname.match(/([\w-]+\.html)/, '$1');

	if (activatedPath) {
		activatedPath = activatedPath[0];
	} else {
		activatedPath = 'index.html';
	}

	const targetAnchors = document.body.querySelectorAll('[href="' + activatedPath + '"].nav-link');

	targetAnchors.forEach(targetAnchor => {
		let parentNode = targetAnchor.parentNode;
		console.log(parentNode);
		while (parentNode !== null && parentNode !== document.documentElement) {
			if (parentNode.classList.contains('collapse')) {
				parentNode.classList.add('show');
				const parentNavLink = document.body.querySelector(
					'[data-bs-target="#' + parentNode.id + '"]'
				);
				parentNavLink.classList.remove('collapsed');
				parentNavLink.classList.add('active');
			}
			parentNode = parentNode.parentNode;
		}
		targetAnchor.classList.add('active');
	});
});



function checkRequired(fields) {
	var out = "";
	var v, pre;
	for (var i in fields) {
		if (i.substr(0, 1) == "*") {
			v = eval(i.substr(1));
			pre = "<br /><b>" + _e("Errore:") + "</b> ";
		} else {
			v = $("#" + i).val();
			pre = "<br /><b>" + _e("Campo obbligatorio") + ":</b> ";
		}
		if (!v || v == "")
			out += pre + fields[i] + "\n";
	}
	if (out != "") {
		bootbox.alert("<h3>" + _e("Attenzione") + "</h3>" + out);
		return false;
	} else
		return true;
}

/*
 * Funzione creata per la traduzione del testo nei file javascript. METODO DI
 * UTILIZZO: Passare il testo da tradurre alla funzione nel seguente modo:
 * _a("testo da tradurre"). Se non trova la traduzione del testo restituisce il
 * testo passato.
 * 
 * Alla funzione è collegato un file dizionario situato nella cartella
 * languages. I dizionari devono avere il nome della lingua da tradurre.
 * esempio: en_US.js, it_IT.js ecc. In base alla localizzazione seleziona il
 * dizionario.
 * 
 * @param: string @return string
 */
function _e(s) {

	if (Localization && (v = Localization[s]))
		return v;
	return s;
}