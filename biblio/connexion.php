<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "unilibrary";

// Connexion à la base existante
$conn = mysqli_connect($server, $user, $password, $dbname);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

echo "Connexion réussie !";



 $tableLivre =" CREATE TABLE livre(
              id INT AUTO_INCREMENT PRIMARY KEY,
              titre  VARCHAR(100),
              auteur varchar(100),
              description TEXT ,
              maison_edition varchar(100),
              nombre_exemplair INT )";

//   if (mysqli_query($conn , $tableLivre)){
//     echo " Table creer !" ;
//   }else{
//     echo" erreur de creation de table! " . mysqli_error($conn) ;
//   } ;   
  


//   $tableLecteurs= "CREATE TABLE lecteurs(
//                    id int AUTO_INCREMENT PRIMARY KEY,
//                    nom varchar(100),
//                    prenom varchar(100),
//                    email varchar (100)
//                    )";

//     if (mysqli_query($conn , $tableLecteurs)){
//     echo " Table lecteurs creer !" ;
//   }else{
//     echo" erreur de creation de table lecteures ! " . mysqli_error($conn) ;
//   } ;          


$tableListeLectures = "CREATE TABLE liste_lecture(
                      id_livre int not null,
                      id_lecteur int not null ,
                      date_emprunt date,
                      date_retour date
                     )";


// if (mysqli_query($conn , $tableListeLectures)){
//     echo " Table liste lecture creer !" ;
//   }else{
//     echo" erreur de creation de table liste lecture ! " . mysqli_error($conn) ;

//   }     



   $tableCathegorie =" CREATE TABLE cathegorie(
              id INT AUTO_INCREMENT PRIMARY KEY,
              nom VARCHAR(100) not null
              )";
        
//     if (mysqli_query($conn , $tableCathegorie)){
//     echo " Table cathegorie creer !" ;
//   }else{
//     echo" erreur de creation de table cathegorie ! " . mysqli_error($conn) ;

//   }    


$AdditionDecathegorie = "ALTER TABLE livre  
                         ADD cathegorie_id INT,
                         ADD CONSTRAINT fk_cathegorie
                         FOREIGN KEY (cathegorie_id) REFERENCES cathegorie(id);

                         ";


//     if (mysqli_query($conn , $AdditionDecathegorie)){
//     echo " cle etrangere creer !" ;
//   }else{
//     echo" erreur de creation de la  cle etrangere ! " . mysqli_error($conn) ;

//   } 


$modifierLivre = " ALTER TABLE livre 
                   ADD image VARCHAR(255) DEFAULT NULL,   
                   ADD fichier_pdf VARCHAR(255) DEFAULT NULL
                  ";

//                  if (mysqli_query($conn , $modifierLivre)){
//     echo " modification de la structure livre avec succes !" ;
//   }else{
//     echo" erreur de modification de la structure livre ! " . mysqli_error($conn) ;

//   } 

  $ajoutpdfCathegorie=" INSERT INTO cathegorie(nom) VALUES
                      ('aventure'),
                      ('litterature'),
                      ('roman'),
                      ('sciencefiction');

                      ";

//    if(mysqli_query($conn,$ajoutpdfCathegorie)){
//     echo "ajout des donnees a la table cathegories succes";
//    } else{
//     echo "erreur d'ajout!" .  mysqli_error($conn);
//    }                  

$ajoutpdflivre = "INSERT INTO livre(titre,auteur,description,maison_edition,nombre_exemplair,cathegorie_id,image,fichier_pdf) 
                  VALUES ('Candide','Voltaire','livre aventure','Flammarion',150000000,1,'candide.jpg','candide.pdf'),
                  ('Amitié amoureuse',' Hermine Oudinot','livre aventure','Calmann-Lévy',20000,1,'amitie amoureuse.jpg','amitie amoureuse.pdf'),
                  ('Les trois mousquetaires',' Dumas Alexandre','livre aventure','Baudry',200000,1,'les trois mousquetaires.jpg','les trois mousquetaires.pdf'),
                  ('Maman Léo',' Féval Paul','livre aventure','tredition',80000,1,'maman leo.jpg','maman leo.pdf'),
                  ('A rebours',' Huysmans','livre de litterature',' Charpentie',2000,2,'a rebours.jpg','a rebours.pdf'),
                  ('La Comédie humaine',' Balzac Honoré ','livre de litterature',' Furne',200000000,2,'comedie humaine.jpg','comedie humaine.pdf'),
                  ('homme Qui Rit',' Victor Hugo ','livre de litterature','Flammarion',60000000,2,'homme qui rit.jpg','homme qui rit.pdf'),
                  ('Madame Bovary','Flaubert Gustave','livre de litterature','Charpentier',80000000,2,'madame bovary.jpg','madame bovary.pdf'),
                  ('Les crimes de amour','Sade marquis','Roman','Massé',15000000,3,'crime de amour.jpg','crime de amour.pdf'),
                  ('Les misérables Tome I: Fantine','victor Hugo','Roman','A. Lacroix',8000000,3,'les miserables tome1.jpg','les miserables tome1.pdf'),
                  ('Les misérables Tome II: Fantine','victor Hugo','Roman','A. Lacroix',8000000,3,'les miserables tome2.jpg','les miserables tome2.pdf'),
                  ('Lourdes','Emile Zola','Roman','Charpentier',5000000,3,'lourdes.jpg','lourdes.pdf'),
                  ('Autour de la lune','Jules Verne','science fiction','Hetzel',1000000,4,'autour de la lune.jpg','autour de la lune.pdf'),
                  ('île mystérieuse','Jules Verne','science fiction','Hetzel',1500000,4,'île mystérieuse.jpg','île mystérieuse.pdf'),
                  ('La Fin Des Livres','Uzanne Octave','science fiction','Manucius',5000,4,'la fin des livres.jpg','la fin des livres.pdf'),
                  ('Le Vingtième Siècle: La Vie Électrique','Robida Albert','science fiction',': Georges Decaux',20000,4,'le vingtieme siecle.jpg','le vingtieme siecle.pdf'),
                  ('Voyage au Centre de la Terre','Jules Verne','science fiction',': Hetzel',20000000,4,'voyage au centre de la terre.jpg','voyage au centre de la terre.pdf')";



  // if(mysqli_query($conn,$ajoutpdflivre)){
  //   echo "ajout des donnees a la table livre succes";
  // } else{
  //   echo "erreur d'ajout!" .  mysqli_error($conn);
  //  }    

$ajoutepdflivre = "INSERT INTO livre(titre,auteur,description,maison_edition,nombre_exemplair,cathegorie_id,image,fichier_pdf) 
                  VALUES ('Le Vingtième Siècle: La Vie Électrique','Robida Albert','science fiction',': Georges Decaux',20000,4,'le vingtieme siecle.jpg','le vingtieme siecle.pdf'),
                  ('Voyage au Centre de la Terre','Jules Verne','science fiction',': Hetzel',20000000,4,'voyage au centre de la terre.jpg','voyage au centre de la terre.pdf')";


//  if(mysqli_query($conn,$ajoutepdflivre)){
//     echo "ajout des modification a la table livre succes";
//   } else{
//     echo "erreur de modification!" .  mysqli_error($conn);
//    }    

$ajoutListe_lecture ="ALTER TABLE liste_lecture
ADD COLUMN lu TINYINT(1) DEFAULT 0";


//  $ajouterList_lecture = "ALTER TABLE liste_lecture ADD COLUMN statut ENUM('à lire','lu') DEFAULT 'à lire' ";

  
  // if(mysqli_query($conn, $ajoutListe_lecture)){
  //   echo "ajout des modification a la table liste_lecture succes";
  // } else{
  //   echo "erreur de modification!" .  mysqli_error($conn);
  //  }    


$contact = "CREATE TABLE messages_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

//  if(mysqli_query($conn, $contact)){
//     echo "table contact creer";
//   } else{
//     echo "erreur de creation!" .  mysqli_error($conn);
//    }   
//    mysqli_close($conn);

?>
