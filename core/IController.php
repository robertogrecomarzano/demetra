<?php
namespace App\Core;

interface IController
{

    /**
     * Visualizzazione pagina
     *
     * @param array $request
     */
    function index($request);

    /**
     * Vista per la creazione di una nuova risorsa
     *
     * @param array $request
     */
    function create($request);

    /**
     * Registrazione nuova risorsa
     *
     * @param array $request
     * @param bool $redirect
     */
    function store($request, $redirect = true);

    /**
     * Visualizzazione singola risorsa
     *
     * @param array $request
     */
    function show($request);

    /**
     * Vista per la modifica di una risorsa
     *
     * @param array $request
     */
    function edit($request);

    /**
     * Modifica di una risorsa
     *
     * @param array $request
     */
    function update($request, $redirect = true);

    /**
     * Eliminazione di una risorsa
     *
     * @param array $request
     */
    function delete($request);
}

