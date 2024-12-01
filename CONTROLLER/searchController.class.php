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
        $category = $_GET['category'] ?? ''; 
        $query = $_GET['query'] ?? '';      
        $results = [];

        try {
            // Gestion catégories
            switch ($category) {
                case "songs":
                    $results = empty($query) ? SongDAO::chercherTous() : SongDAO::chercherAvecFiltre($query);
                    break;
                case "artists":
                    $results = empty($query) ? ArtistDAO::chercherTous() : ArtistDAO::chercherAvecFiltre($query);
                    break;
                case "albums":
                    $results = empty($query) ? AlbumDAO::chercherTous() : AlbumDAO::chercherAvecFiltre($query);
                    break;
                case "users":
                    $results = empty($query) ? UserDAO::chercherTous() : UserDAO::chercherAvecFiltre($query);
                    break;
                default:
                    throw new Exception("Catégorie invalide.");
            }
        } catch (Exception $e) {
            $this->messagesErreur[] = $e->getMessage();
        }

        // Stock les résultat
        $_SESSION['searchResults'] = $results;
        $_SESSION['searchCategory'] = $category;

        return "manageSearch.php"; // Retourner vue
    }
}
?>

