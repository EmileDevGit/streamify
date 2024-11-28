<?php 

include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\PlaylistDAO.php");
include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\User.class.php");


class UserDAO implements DAO{

    // Méthodes DAO
    public static function chercher(int $userID):?object{

        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $user=null;

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM users WHERE userID = ?");
        $query->execute(array($userID));
        $e = $query->fetch();

        // Validation du résultat & création de l'objet User
        if($query->rowCount()==0){
            throw new Exception("L'utilisateur n'existe pas");
        } else {
            $tabPlaylist = [];
            $tabPlaylist = PlaylistDAO::collectPlaylist($userID);
            $user = new User(
                $e['userID'],
                $e['userName'],
                $e['password'],
                $e['email'],
                $e['adminStatus'],
                $e['imageFileName'],
                $tabPlaylist
            );
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        //Renvoie du User trouvé
        return $user;
    }
    public static function chercherAvecFiltre(string $filtre):array{

         // Connexion à la base de données & Initialisation
         try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $tabUsers=[];

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM users WHERE userName LIKE ?");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute(array("%".$filtre ."%"));
        foreach($query as $e){
            $tabPlaylist = [];
            $tabPlaylist = PlaylistDAO::collectPlaylist($e['userID']);
            $user = new User(
                $e['userID'],
                $e['userName'],
                $e['password'],
                $e['email'],
                $e['adminStatus'],
                $e['imageFileName'],
                $tabPlaylist
            );
            $tabUsers[] = $user;
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        //Renvoie du tableau des User trouvés
        return $tabUsers;
    }
    public static function chercherTous():array{

        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $tabUsers=[];

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM users");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute();
        foreach($query as $e){
            $tabPlaylist = [];
            $tabPlaylist = PlaylistDAO::collectPlaylist($e['userID']);
            $user = new User(
                $e['userID'],
                $e['userName'],
                $e['password'],
                $e['email'],
                $e['adminStatus'],
                $e['imageFileName'],
                $tabPlaylist
            );
            $tabUsers[] = $user;
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        //Renvoie du tableau des User trouvés
        return $tabUsers;
    }
    public static function inserer($user):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("INSERT INTO users(userName, password, email, adminStatus, imageFileName) VALUES (?,?,?,?,?)");

        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $user->getUserName(),
                                        $user->getPassword(), 
                                        $user->getEmail(),
                                        $user->getAdminStatus(),
                                        $user->getImageFileName()
                                    )
                                );
        
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }
    public static function modifier($user):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("UPDATE users SET userName =?, password=?, email=?, adminStatus=?, imageFileName=? WHERE userID = ?");
        
        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $user->getUserName(), 
                                        $user->getPassword(), 
                                        $user->getEmail(),
                                        $user->getAdminStatus(), 
                                        $user->getImageFileName(),
                                        $user->getUserID()
                                    )
                                );
        
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }
    public static function supprimer($user):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        // Préparation de la requête
        $query = $connexion->prepare("DELETE FROM users WHERE userID = ?");                     
        $retour = $query->execute(array($user->getUserID()));
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        // Reset ID index
        UserDAO::resetID();
        
        // Retour du résultat true|false
        return $retour;
    }
    private static function resetID(){
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $query = $connexion->prepare("ALTER TABLE users AUTO_INCREMENT = 1");                  
        $query->execute();
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
    }

}






?>