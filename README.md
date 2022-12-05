

# square-app

App in php utilizzata come punto di partenza per nuovi progetti.


# Introduzione

L'intero sistema si basa sulla presenza di un unico file index.php che si occupa di includere il codice relativo alla singola pagina richiesta. L'url delle pagine rispecchia il path su disco della cartella stessa, quindi se ad esempio si crea la pagina "test", all'interno della directory principale del progetto troveremo nella cartella "pages" la sottocartella "test".
Quindi possiamo avre anche cartelle annidate, esempio "test/sottotest" che sarà individuata dall'url miodominio/test/sottotest.


# Prerequisiti

Per poter utilizzare questo strumento, occorre avere installato composer, git, mysql ed un server web.


# Installazione

Aprire una console all'interno della cartella www ed eseguire il comando seguente

    git clone https://github.com/robertogrecomarzano/square-app.git

## Struttura dele directory
All'interno della directory principale troviamo diverse sottodirectory e file, di seguito le principali.

>  - core
> 	 - lib
> 	 - classes
> 	 - controller
> 	 - templates
> 	 - App.php
> 	 - Config.php
> 	 - ...
>  - components
>  - pages
>  - models
>  - index.php

 - **Index.php** è il punto di accesso di ogni pagina
 - **pages** raccoglie tutte le pagine del sistema
 - **components** include una serie di componenti/plugin che è possibile usare all'interno di una pagina, es. Calendar
 - **models** raccoglie le classi che mappano le tabelle del database
 - **core** include il cuore vero e proprio dell'app, come controller, templates ecc 
	 - in **core/controller** troviamo le classi php che gestiscono le richieste di ogni pagina
	 - in **core/templates** troviamo il template principale ed altri templates come il form di login/register e template specifici per	le email.
	 - **App.php** si  occupa di gestire le varie richieste ed instradare verso il giusto controller la richiesta
	 - **Config.php** contiene i parametri principali di configurazione

## Smarty template
L'intero sistema sfrutto il motore di templateing "Smarty Php". Il template principale del sito è presente nel file core/templates/main.tpl, mentre in core/templates/tpl sono presenti i template di altre pagine che richiedono un aspetto grafico diverso, es. pagina di registrazione e di login.

I file smarty sono identificati dall'estensione .tpl e sono caratterizzati da codice HTML all'interno del quale è possibile inserire attraverso dei TAG SMARTY (individuati dalle parentesi graffe, es. {*form_tbox}* ) degli oggetti, variabili ed altro che vanno poi ad essere inglobati nell'HTML della pagina.


## Routes
Ogni pagina dell'app deve rispettare delle regole fisse per poter essere mappata dal file App.php secondo questo schema

|Method          |Uri                            |Action										 |	
|----------------|-------------------------------|---------------------------|
|GET						 |`domain/test`			             |TestController@index       |
|POST            |`domain/test`            			 |TestController@store       |
|GET             |`domain/test/create`     			 |TestController@create      |
|GET             |`domain/test/{id}`       			 |TestController@show        |
|PUT             |`domain/test/{id}`       			 |TestController@update      |
|GET             |`domain/test/{id}/edit`  			 |TestController@edit        |
|DELETE          |`domain/test/{id}`       			 |TestController@delete      |


## Lingua

L'app è multilingua e sfrutta le librerie di Google Translate per tradurre in automatico ogni etichetta presente nella pagina. Affinchè un etichetta venga tradotta deve essere inclusa nel tag modificatore smarty ***{form_lang value='etichetta da tradurre'}***. Ogni etichetta inserita nel tag {form_lang} verrà inserita nella tabella traduzioni ed a seconda della lingua scelta dall'utente, il sistema mostrerà la corretta traduzione.

## Pagine di tipo tabella

Per le pagine in cui è richiesta la gestione CRUD dei dati di una tabella, è possibile sfruttare il generatore di pagine attraverso lo script generator.php (da linea di comando).
Passando gli opportuni parametri, questo generatore creerà la cartella all'interno di pages ed il controllor sotto controllers, es.

    php generator.php --folder=test --extends=TableController [opzionale] --model=Persona [opzionale]

Nell'ordine verranno:
 1. creata la cartella pages/test
 2. creato il controller core/controllers/TestController.php per la gestione della tabella persona

Richiamando la pagina domain/test il sistema mostrerà la griglia di gestione del model Persona mappato sulla tabella persona.
NB- la crezione del model va fatta manualmente e dopo aver eseguito il generator, occorre accedere al controller per impostare i campi del db che si vuole gestire.
Nella cartella creata troveremo i templates index, show, create, edit che poteanno essere personalizzati.


## Menù

Ogni pagina è mappata all'interno di un file xml (components/com_menu/menu.xml) che viene popolato dalle classi specifiche di ogni sezione (file php presenti nella cartella classes). 
Se una pagina non è mappata nel menù, non sarà accessibile.

## Classi per la gestione dell'accesso alle risorse

Nella directory classes sono presenti le classi php che gestiscono:
 - creazione del menù relativo alla specifica sezione
 - gestione dell'accesso alla risorsa in base al gruppo utente implementando l'interfaccia **IPermissions**, si può così  determinare se l'utente è:
	 - proprietario della risorsa, metodo **isUserOwner**()
	 - può leggere la risorsa, metodo **isReadable**()
	 - può scrivere/modificare la risorsa, metodo **isWritable**()
