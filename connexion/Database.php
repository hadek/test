<?php 
######################################################################################################### 
////////////////////////////////// /************************************************/ # 
// # # // /* ***** class par Fadel HADEK */ # 
// # ## // /* ***** pcm2013@yahoo.fr ****************/ # 
// ### ##### // /* ***** cette classe permet d'avoir les outils de connexion et d'écriture/lecture dans la BDD**/ # 
######################################################################################################### 
class Connexion extends PDO 
{ 
    private $db = '***********'; // base de données 
    private $host = '*****************'; // adresse de la base 
    private $user = 'sio'; // nom 
    private $pwd = '**************'; // mot de passe 
    private $con; // 
    
    private $dns; 
 /**
 * connexion à la BDD et gère les  erreurs.
 *
 * @return con la connexion
 */
    public function __construct () 
    { 
        try 
        { 
				$options = array(	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'	);
            $this->con = parent::__construct($this->getDns(), $this->user, $this->pwd,$options); 
            // pour mysql on active le cache de requête 
            if($this->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') 
                $this->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); 
                $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION ); 
					 return $this->con; 
        		} 
        catch(PDOException $e) { 
          echo 'Échec lors de la connexion : ' . $e->getMessage();
        } 
    } 
/**
 * connexion à la BDD et gère les  erreurs.
 *@param  varchar  $reqSelect requete sujet de selection
 *
 * @return $con la connexion
 */ 
    public function select($reqSelect) 
    { 
        try 
        { 
            $this->con = parent::beginTransaction(); 
            $result = parent::prepare($reqSelect); 
            $result->execute(); 
            $this->con = parent::commit(); 
            return $result; 
        } 
        catch (Exception $e) 
        { 
             echo 'Échec lors de la connexion : ' . $e->getMessage();
        } 
    } 
 /**
 * retourne les resultats sous forme de tableau
 *@param varchar $reqSelect la requete 
 *@return $resultat sous forme de tableau
 */     
    public function selectTableau($reqSelect ) 
    { 
        $result = parent::prepare($reqSelect); 
        $result->execute(); 
        $resultat = $result->fetchAll(); 
        return $resultat; 
    } 
    public function selectClause($reqSelect,$table ) 
    { 
         try 
        { 
            $this->con = parent::beginTransaction(); 
            $result = parent::prepare($reqSelect); 
            $result->execute($table ); 
            $this->con = parent::commit(); 
            return $result->fetch(); 
        } 
        catch (Exception $e) 
        { 
             echo 'Échec lors de la connexion : ' . $e->getMessage();
        } 
    } 
 /**
 
 * insérer des enregistrements dans une table
 *@param varchar $reqinsert la requete 
 *@param array $table tableau des valeurs à inserer
 */  
    public function insertion($reqinsert,$table) 
    { 
        try 
        { 
            $this->con = parent::beginTransaction(); 
            $result = parent::prepare($reqinsert);
            $result ->execute($table);
             $this->con = parent::commit(); 
         } 
        catch (Exception $e) 
        { 
              echo 'Échec lors de la connexion : ' . $e->getMessage();
        } 
    } 
 /**
 * change la BDD si besoin

 */ 
    public function getDns() 
    { 
        return 'mysql:dbname='.$this->db.';host='.$this->host; 
    } 
 /**
 * Calculer le nombre de lignes résultat
 *@param varchar $reqSelect la requete 
 *@preturn int count($countries) 
 */ 
	 public function NombreLigne($reqSelect) 
    { 
        try 
        { 
            $this->con = parent::beginTransaction(); 
            $result= parent::query($reqSelect); 
            $countries = $result->fetchAll();
				return count($countries);
            $this->con = parent::commit(); 
         } 
        	catch (Exception $e) 
        	{ 
              echo 'Échec lors de la connexion : ' . $e->getMessage();
        	} 
    } 
    
} 
    
    
    
    


