<?php
/**
 * Script da eseguire da console per creare la cartella della nuova pagina e relativo controller
 * Accetta i seguenti parametri
 *
 * Utilizza PHP Code Generator  https://doc.nette.org/en/php-generator
 --folder (valore unico. Es. user, user/profile)
 --extends (classe da estendere, di default viene usato BaseController) [facoltativo]
 --implements (interfacce da implementare separate da "," di default viene usato IController) [facoltativo]
 --model (eventuale nome della classe Model che mappa la tabella)
 --delete (booleano per indicare di voler eliminare folder)


 Esempi di utilizzo:

 php generator.php --folder=test --extends=TableController --implements==IPermission
 php generator.php --folder=test --delete=true

 */
if (! isset($argv))
    die("File accessibile solo da console");

/**
 * Gestione dei parametri di input dalla console
 *
 * @param array $argv
 * @return array
 */
function arguments($argv)
{
    $_ARG = array();
    foreach ($argv as $arg) {
        if (preg_match('/--([^=]+)=(.*)/', $arg, $reg)) {
            $_ARG[$reg[1]] = $reg[2];
        } elseif (preg_match('/^-([a-zA-Z0-9])/', $arg, $reg)) {
            $_ARG[$reg[1]] = 'true';
        } else {
            $_ARG['input'][] = $arg;
        }
    }
    return $_ARG;
}

/**
 * Lettura parametri dalla console
 */
$argv = arguments($argv);

/**
 * Exit se non è stato indicato il parametro folder
 */
if (! isset($argv["folder"]) || empty($argv["folder"]))
    die("\e[0;30;43mIndicare il parametro --folder relativo alla cartella della pagina da creare (es. --folder=user, --folder=user/profile)\e[\n");

require "vendor/autoload.php";

$folder = $argv["folder"];
$extends = isset($argv["extends"]) ? $argv["extends"] : "BaseController";
$imp = isset($argv["implements"]) ? $argv["implements"] : "IController";
$model = isset($argv["model"]) ? ucfirst($argv["model"]) : "ClassNameToRename";
$delete = isset($argv["delete"]) ? (bool) $argv["delete"] : "false";

foreach (explode(",", $imp) as $i)
    $implements[] = $i;
if ($extends == "TableController" && ! in_array("ITableController", $implements))
    $implements[] = "ITableController";

$parts = explode('/', $folder);
$className = implode(array_map('ucfirst', $parts)) . "Controller";

if ($delete == "true") {
    if (! file_exists("core/controller/$className.php"))
        die("\e[0;31mController non presente\e[\n");

    unlink("core/controller/$className.php");
    unlink("pages/$folder/page.js");
    unlink("pages/$folder/templates/main.css");
    unlink("pages/$folder/templates/index.tpl");
    unlink("pages/$folder/templates/show.tpl");
    unlink("pages/$folder/templates/edit.tpl");
    unlink("pages/$folder/templates/create.tpl");
    rmdir("pages/$folder/templates");
    rmdir("pages/$folder");
    die("\e[0;32mController eliminato correttamente\e[\n");
}

if (file_exists("core/controller/$className.php"))
    die("\e[0;30;43mController già presente, operazione annullata\e[\n");

$namespace = new Nette\PhpGenerator\PhpNamespace('App\Core\Controller');
$namespace->addUse("App\Core\Lib\Page");
$namespace->addUse("App\\Core\\$extends");
$namespace->addUse("App\Core\Lib\Language");

if ($extends == "TableController")
    $namespace->addUse("App\Core\Lib\Form");

foreach ($implements as $i)
    $namespace->addUse("App\\Core\\$i");

if ($model != "ClassNameToRename") {
    $namespace->addUse("App\\Models\\$model");

    if (! file_exists("models/$model.php"))
        copy("models/_GenericModel.php", "models/$model.php");
}

$class = $namespace->addClass($className);
$class->setExtends("App\\Core\\$extends")->addComment("Classe controller per la gestione della pagina $folder\nClasse autogenerata\n\n");

foreach ($implements as $i)
    $class->addImplement("App\\Core\\$i");

$construct = $class->addMethod('__construct')
    ->addBody('$this->page = Page::getInstance();')
    ->addBody('$this->alias = $alias;')
    ->addBody('$this->src["alias"] = $alias;');

if ($extends == "TableController")
    $construct->addBody('$this->custom_template = false;')
        ->addBody('$this->table = "TABLE_NAME";')
        ->addBody('$this->pk = "PRIMARY_KEY";')
        ->addBody('$this->mappings = [')
        ->addBody('"sql_column_1" => "html_field_1",')
        ->addBody('"sql_column_2" => "html_field_2",')
        ->addBody('"sql_column_n" => "html_field_n"')
        ->addBody('];')
        ->addBody('$this->other = [];')
        ->addBody('$this->src["alias"] = $alias;')
        ->addBody('$this->src["title"] = Language::get("Registra nuovo record");')
        ->addBody('$this->src["pk"] = $this->pk;')
        ->addBody('$this->src["custom-template"] = $this->custom_template;')
        ->addBody('$this->src["writable"] = true;')
        ->addBody('$this->src["edit"] = true;')
        ->addBody('$this->src["delete"] = true;')
        ->addBody('$this->src["add"] = true;')
        ->addBody('$this->src["clone"] = true;')
        ->addBody('$this->src["fields"] = [')
        ->addBody('"SQL_FIELD_1" => [')
        ->addBody('"label" => Language::get("Es. textbox"),')
        ->addBody('"writable" => true | false // true di default')
        ->addBody('],')
        ->addBody('"SQL_FIELD_2" => [')
        ->addBody('"label" => Language::get("Dettaglio")')
        ->addBody('],')
        ->addBody('"SQL_FIELD_3" => [')
        ->addBody('"label" => Language::get("Es. checkbox"),')
        ->addBody('"type" => "checkbox",')
        ->addBody('"others" => [')
        ->addBody('"required" => "required"')
        ->addBody(']')
        ->addBody('],')
        ->addBody('"SQL_FIELD_4" => [')
        ->addBody('"label" => Language::get("Es. select option"),')
        ->addBody('"type" => "select",')
        ->addBody('"others" => [')
        ->addBody('"src" => [')
        ->addBody('"1" => "si",')
        ->addBody('"0" => "no"')
        ->addBody('],')
        ->addBody('"first" => true,')
        ->addBody('"required" => "required"')
        ->addBody(']')
        ->addBody('],')
        ->addBody('"SQL_FIELD_5" => [')
        ->addBody('"label" => Language::get("Es. radio"),')
        ->addBody('"type" => "radio",')
        ->addBody('"others" => [')
        ->addBody('"required" => "required"')
        ->addBody(']')
        ->addBody('],')
        ->addBody('"SQL_FIELD_6" => [')
        ->addBody('"label" => Language::get("Es. text con value"),')
        ->addBody('"value" => "numero_release", // se il campo ritornato dalla query è differente dal nome della colonna')
        ->addBody('"type" => "number",')
        ->addBody('"others" => [')
        ->addBody('"size" => 8,')
        ->addBody('"required" => "required",')
        ->addBody('"min" => 1')
        ->addBody(']')
        ->addBody(']')
        ->addBody('];');

$construct->addParameter('alias');

$methods = [];
foreach ($implements as $imp)
    switch ($imp) {
        case "IController":
            $methods = array_merge($methods, [
                "edit",
                "show",
                "index",
                "create",
                "update",
                "store",
                "delete"
            ]);
            break;
        case "ITableController":
            $methods = array_merge($methods, [
                "store_preview",
                "store_new",
                "update_preview",
                "clone"
            ]);
            break;
    }

foreach (array_unique($methods) as $methodName) {
    $method = $class->addMethod($methodName);
    $method->addParameter('request');

    if (in_array($methodName, [
        "store",
        "update"
    ]))
        $method->addParameter('redirect', true);

    if ($extends = "TableController")
        switch ($methodName) {
            case "index":
                $method->addBody('$rows = ' . $model . '::all()->toArray();')
                    ->addBody('$this->src["rows"] = $rows;')
                    ->addBody('$this->page->assign("src", $this->src);');
                break;
            case "create":
                $method->addBody('$this->page->assign("src", $this->src);');
                break;
            case "show":
                $method->addBody('$row = ' . $model . '::find($request["id"])->toArray();')
                    ->addBody('$this->src["rows"] = $row;')
                    ->addBody('$this->src["view"] = "edit";')
                    ->addBody('$this->page->assign("src", $this->src);');
                break;
            case "edit":
                $method->addBody('$row = ' . $model . '::find($request["id"])->getOriginal();')
                    ->addBody('Form::mappingsAssignPost([$row], "mod", $request["id"], $this->pk, $this->mappings, $this->page);')
                    ->addBody('$this->src["rows"] = $row;')
                    ->addBody('$this->src["view"] = "edit";')
                    ->addBody('$this->page->assign("src", $this->src);');
                break;
            case "update":
                $method->addBody('$result = false;')
                    ->addBody('$id = $request["id"];')
                    ->addBody('// TODO:')
                    ->addBody('// Personalizzare se necessario la logica per effettuare l\'operazione di Update')
                    ->addBody('// Se l\'operazione è andata a buon fine eseguire il redirect')
                    ->addBody('$obj = new ' . $model . '();')
                    ->addBody('foreach ($obj->getFillable() as $field)')
                    ->addBody('$params[$field] = $request[$field];')
                    ->addBody('try {')
                    ->addBody($model . '::where($this->pk, $id)->update($params);')
                    ->addBody('} catch (\Illuminate\Database\QueryException $ex) {')
                    ->addBody('$this->page->addError(Language::get("Errore in fase di aggiornamento"));')
                    ->addBody('return false;')
                    ->addBody('}')
                    ->addBody('if ($redirect)')
                    ->addBody('Page::redirect($this->alias, "", true, Language::get("Record aggiornato"));')
                    ->addBody('else')
                    ->addBody('return true;');
                break;
            case "store":
                $method->addBody('// TODO:')
                    ->addBody('// Personalizzare se necessario la logica per effettuare l\'operazione di Insert')
                    ->addBody('$obj = new ' . $model . '();')
                    ->addBody('foreach ($obj->getFillable() as $field)')
                    ->addBody('$params[$field] = $request[$field];')
                    ->addBody('$newId = $obj->insertGetId($params);')
                    ->addBody('if (! $newId) {')
                    ->addBody('$this->page->addError("Errore in fase di registrazione");')
                    ->addBody('return false;')
                    ->addBody('}')
                    ->addBody('if ($redirect)')
                    ->addBody('Page::redirect($this->alias, "", true, Language::get("Record registrato"));')
                    ->addBody('else')
                    ->addBody('return true;');
                break;
            case "delete":
                $method->addBody('$result = false;')
                    ->addBody('$id = $request["id"];')
                    ->addBody('// TODO:')
                    ->addBody('// Personalizzare se necessario la logica per effettuare l\'operazione di Delete')
                    ->addBody('$result = ' . $model . '::destroy($id);')
                    ->addBody('if (! $result) {')
                    ->addBody('$this->page->addError("Errore in fase di cancellazione");')
                    ->addBody('return false;')
                    ->addBody('}')
                    ->addBody('Page::redirect($this->alias, "", true, Language::get("Record eliminato"));');
                break;

            case "store_preview":
                $method->addBody('$newId = $this->store($request, false);')
                    ->addBody('if ($newId > 0)')
                    ->addBody('Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Record inserito"));');
                break;

            case "update_preview":

                $method->addBody('$result = $this->update($request, false);')
                    ->addBody('if ($result)')
                    ->addBody('Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Record aggiornato"));');
                break;

            case "store_new":
                $method->addBody('$newId = $this->store($request, false);')
                    ->addBody('if ($newId > 0)')
                    ->addBody('Page::redirect($this->alias . "/create", "", true, Language::get("Record inserito, procedi con un altro inserimento"));');
                break;
            case "clone":
                $method->addBody('// TODO:')
                    ->addBody('// Personalizzare se necessario la logica per effettuare l\'operazione di Clone')
                    ->addBody('$oldRow = ' . $model . '::find($request["id"]);')
                    ->addBody('$newRow = $oldRow->replicate();')
                    ->addBody('$obj = new ' . $model . '();')
                    ->addBody('foreach ($obj->getFillable() as $field)')
                    ->addBody('if (! empty($newRow->$field))')
                    ->addBody('$newRow->$field = $oldRow->$field . " (" . Language::get("copia") . ") ";')
                    ->addBody('$newId = $newRow->save();')
                    ->addBody('if (! $newId) {')
                    ->addBody('$this->page->addError("Errore in fase di clonazione");')
                    ->addBody('return false;')
                    ->addBody('}')
                    ->addBody('Page::redirect($this->alias, "", true, Language::get("Record clonato"));');
                break;
        }
}

$printer = new Nette\PhpGenerator\PsrPrinter();
$output = $printer->printNamespace($namespace);

$output = "<?php\n\n$output";

file_put_contents("core/controller/$className.php", $output);

mkdir("pages/$folder", 0755, true);
mkdir("pages/$folder/templates", 0755, true);
file_put_contents("pages/$folder/templates/main.css", "");

copy("pages/_generic/page.js", "pages/$folder/page.js");
copy("pages/_generic/templates/index.tpl", "pages/$folder/templates/index.tpl");
copy("pages/_generic/templates/show.tpl", "pages/$folder/templates/show.tpl");
copy("pages/_generic/templates/edit.tpl", "pages/$folder/templates/edit.tpl");
copy("pages/_generic/templates/create.tpl", "pages/$folder/templates/create.tpl");
die("\e[0;32mController $className e relative cartelle create\e[\n");