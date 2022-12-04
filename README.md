# square-app

App in php utilizzata come punto di partenza per nuovi progetti.


# Introduzione

L'intero sistema si basa sulla presenza di un unico file index.php che si occupa di includere il codice relativo alla singola pagina richiesta. L'url delle pagine rispecchia il path su disco della cartella stessa, quindi se ad esempio si crea la pagina "test", all'interno della directory principale del progetto troveremo nella cartella "pages" la sottocartella "test".
Quindi possiamo avre anche cartelle annidate, esempio "test/sottotest" che sarà individuata dall'url miodominio/test/sottotest.


## Struttura dele directory
All'interno della directory principale troviamo diverse sottodirectory e file, di seguito le principali.

 - core
	 - lib
	 - classes
	 - controller
	 - templates
	 - App.php
	 - Config.php
	 - ...
 - components
 - pages
 - models
 - index.php
 - ...

**Index.php** è il punto di accesso di ogni pagina
**pages** raccoglie tutte le pagine del sistema
**components** include una serie di componenti/plugin che è possibile usare all'interno di una pagina, es. Calendar
**models** raccoglie le classi che mappano le tabelle del database
**core** include il cuore vero e proprio dell'app, come controller, templates ecc
	in **core/controller** troviamo le classi php che gestiscono le richieste di ogni pagina
	in **core/templates** troviamo il template principale ed altri template come il form di login/register e template specifici per
	le email.
	**App.php** si occupa di gestire le varie richieste ed instradare verso il giusto controller la richiesta
	**Config.php** contiene i parametri principali di configurazione