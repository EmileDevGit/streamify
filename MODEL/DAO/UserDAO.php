<?php 

include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\User.class.php");


class UserDAO implements DAO{

    // Méthodes DAO
    public static function chercher(string $userID):?object{

        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $user=null;

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM user WHERE userID LIKE ?");
        $query->execute(array($userID));
        $e = $query->fetch();

        // Validation du résultat & création de l'objet User
        if($query->rowCount()==0){
            throw new Exception("L'utilisateur n'existe pas");
        } else {
            $user = new User(
                $e['userID'],
                $e['password'],
                $e['email']
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
        $query = $connexion->prepare("SELECT * FROM user WHERE userID LIKE '%".$filtre."%'");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute();
        foreach($query as $e){
            $user = new User(
                $e['userID'],
                $e['password'],
                $e['email']
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
        $query = $connexion->prepare("SELECT * FROM user");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute();
        foreach($query as $e){
            $user = new User(
                $e['userID'],
                $e['password'],
                $e['email']
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
        $query = $connexion->prepare("INSERT INTO users(userID, password, email) VALUES (?,?,?)");

        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $user->getUserID(),
                                        $user->getPassword(), 
                                        $user->getEmail()
                                    )
                                );
        
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }
    // Modifier pour email-password
    public static function modifier($user):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("UPDATE users SET password=?, email=? WHERE userID = ?");
        
        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $user->getPassword(), 
                                        $user->getEmail(),
                                        $user->getUserID()
                                    )
                                );
        
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }
    // Méthode additionnelle pour username
    public static function modifierUserID($user):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("UPDATE users SET userID=? WHERE email = ?");
        
        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $user->getUserID(),
                                        $user->getEmail()
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
        $query = $connexion->prepare("DELETE FROM users WHERE userID LIKE ?");
        $retour = $query->execute(array
                                    (
                                        $user->getUserID()
                                    )
                                );

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        // Retour du résultat true|false
        return $retour;
    }

}






?>