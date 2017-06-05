<?php
use Illuminate\Support\HtmlString;

/**
 * Supprime le prefix de "attachable_type".
 *
 * E.g: Un exemple de "attachable_type" App\Post.
 * Donc cette fonctionne va supprimer le "App\".
 * Le reste sera utilisé pour créer un dossier où seront
 * stockés tous les fichiers associés à cet type d'objet.
 *
 * @param string $dir
 * @return bool|string
 */
function normalizeDir(string $dir) {
    return strtolower(substr($dir, 4));
}

if (! function_exists('action_field')) {
    function action_field(string $type)
    {
        return new HtmlString('<input type="hidden" name="action" value="'. $type .'">');
    }
}