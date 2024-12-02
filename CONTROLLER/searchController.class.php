<?php

include_once("CONTROLLER/controller.abstract.class.php");
include_once("MODEL/DAO/SongDAO.php");
include_once("MODEL/DAO/ArtistDAO.php");
include_once("MODEL/DAO/AlbumDAO.php");
include_once("MODEL/DAO/UserDAO.php");

class SearchController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function executerAction(): string {
        $query = $_POST["query"];
        $category = $_POST["category"];
        $results = [];

        try {
            // Gestion catégories
            switch ($category) {
                case "songs":
                    $results = !isset($query) ? SongDAO::chercherTous() : SongDAO::chercherAvecFiltre($query);
                    break;
                case "artists":
                    $results = !isset($query) ? ArtistDAO::chercherTous() : ArtistDAO::chercherAvecFiltre($query);
                    break;
                case "albums":
                    $results = !isset($query) ? AlbumDAO::chercherTous() : AlbumDAO::chercherAvecFiltre($query);
                    break;
                case "users":
                    $results = !isset($query) ? UserDAO::chercherTous() : UserDAO::chercherAvecFiltre($query);
                    break;
                default:
                    throw new Exception("Catégorie invalide.");
            }
        } catch (Exception $e) {
            $this->messagesErreur[] = $e->getMessage();
        }

        // Stock les résultat
        $_COOKIE["searchResults"] = $results;
        $_COOKIE["category"] = $category;

        return "manageSearch.php"; // Retourner vue
    }
}
?>

