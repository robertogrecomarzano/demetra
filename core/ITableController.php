<?php
namespace App\Core;

interface ITableController extends IController
{

    /**
     * Registrazione nuova risorsa e visualizzazione anteprima
     *
     * @param array $request
     */
    function store_preview($request);

    /**
     * Registrazione nuova risorsa e visualizzazione anteprima
     *
     * @param array $request
     */
    function store_new($request);

    /**
     * Modifica di una risorsa e visualizzazione anteprima
     *
     * @param array $request
     */
    function update_preview($request);
}

