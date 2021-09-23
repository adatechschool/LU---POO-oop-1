<!-- cf Cours youtube PROMGRAMMATION ORIENTEE OBJET LIOR CHAMLA -->

<?php
// code surchargé et facilement trompeur si beaucoup d'employés
// $nom= "Ragot";
// $prenom = "Noémie";
// $age = 43;

// $nom2= "Jolivet";
// $prenom2 = "Lou";
// $age2 = 16;

// function presentation($nom, $prenom, $age){
//     var_dump("Bonjour, je suis $prenom $nom et j'ai $age ans");
// }
// presentation($nom, $prenom, $age);
// presentation($nom2, $prenom2, $age2);

 
//-----------------------------------

interface Travailleur {
    public function travailler();
}
// la classe "employé" doit implémenter l'interface "Travailleur". Donc implémenter toutes les méthodes qui sont dans l'interface

class Employe implements Travailleur{
    public $nom;
    public $prenom;
    protected $age;

    //fonction de construction qui sera appelé à chaque fois que l'on créera un nouvel employé: (constructor en JS à la place de __construct)
    public function __construct($prenom, $nom, $age){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;

    }
    // Implémentation oblgatoire de la fonction travailler vu dans l'interface
    public function travailler(){
        return "Je suis un employé et je travaille";
    }

// setter et getter de la propriété "age"
    public function setAge($age){
        //condition pour que le changement ne mettent pas tout le code en l'air
        if(is_int($age) && $age>1 && $age<120){
            $this->$age = $age;
        }
        else{
            throw new Exception("L'âge d'un employé devrait être un entier entre 1 et 120");
        }
    }

    public function getAge(){
    return $this->$age;
    }

    public function presentation(){
        //this = "de ceci". (Ex: je veux le prénom de ceci). This = l'objet dans lequel on se trouve
        var_dump("Salut, je suis $this->prenom $this->nom et j'ai $this->age ans");
    }
}

//classe patron = employe mais a des propriétés et méthodes en plus. En faisant comme ci-dessous, on ne respecte pas le DRY!!!!

// class Patron{
//     public $nom;
//     public $prenom;
//     private $age;
//     public $voiture;

//     public function __construct($prenom, $nom, $age, $voiture){
//         $this->nom = $nom;
//         $this->prenom = $prenom;
//         $this->age = $age;
//         $this->voiture = $voiture;
//     }

//     public function setAge($age){
//         if(is_int($age) && $age>1 && $age<120){
//             $this->$age = $age;
//         }
//         else{
//             throw new Exception("L'âge d'un employé devrait être un entier entre 1 et 120");
//         }
//     }

//     public function getAge(){
//     return $this->$age;
//     }

//     public function presentation(){
//         var_dump("Bonjour, je suis $this->prenom $this->nom et j'ai $this->age ans");
//     }

//     public function rouler(){
//         var_dump("Bonjour je roule avec ma $this->voiture !");
//     }
// }

// //opérateur flêche permet d'accéder aux propriétés de l'employé. (equivalent du point en js)
// $employe1 = new Employe("Noémie", "Ragot", 43);

// $employe2 = new Employe("Lou", "Jolivet", 16);

// //$employe1->setAge(52);

// $employe1->presentation();

// $patron= new Patron("Jospeh", "Durand", 54, "Mercédes");

// $patron->presentation();
// $patron->rouler();

//+++++++ BONNE FORMULE: HERITAGE
class Patron extends Employe {
    public $voiture;

    public function __construct($prenom, $nom, $age, $voiture){
    //appeler le constructeur de la classe parente pour ne pas répéter    
        parent:: __construct($prenom, $nom, $age);
        $this->voiture = $voiture;
    }

    //je ne veux pas que mon patron se présente comme un employé. je redéfinis la présentation. Mais attention, comme l'âge était réglé en private, je ne ouvais pas le lire depuis patron. Du coup, j'ai du le passer en "protected" 
    public function presentation(){
        var_dump("Bonjour, je suis $this->prenom $this->nom et j'ai $this->age ans et j'ai une voiture !");
    }
    public function rouler(){
        var_dump("Bonjour, je roule avec ma $this->voiture !");
    }
}

$employe1 = new Employe("Noémie", "Ragot", 43);

$employe2 = new Employe("Lou", "Jolivet", 16);

$employe1->presentation();
$patron= new Patron("Joseph", "Durand", 54, "Mercedes");

$patron->presentation();
$patron->rouler();

faireTravailler($employe1);
// quel que soit l'objet que l'on passe à la fonction "faire travailler", on veut être sûr à 100% que l'objet qu'on a passé, ait une fonction "travailler"

// Rajouter "travailleur" précise que dans tous les cas, ce qu'on recevra comme argument, implémente l'interface travailleur
function faireTravailler(Humain $objet){
    var_dump("Travail en cours: {$objet->travailler()}");
}

//A partir de tout ça, n'importe quel codeur peut venir créer une classe à sa guise,même complètement déconnectée, sans héritage. Il peut quand même implémenter l'interface travailleur. C'est l'avantage de l'avoir ajouter en définissant la fonction . Ex:

class Etudiant implements Travailleur{
    public function travailler(){
        return "Je suis un étudiant et je révise";
    }
}

//****************************** */
// CLASSES ABSTRAITES

abstract class Humain{
    public $nom;
    public $prenom;
    protected $age;

    public function __construct($prenom, $nom, $age){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }

    abstract public function travailler();

    public function setAge($age){
        //condition pour que le changement ne mettent pas tout le code en l'air
        if(is_int($age) && $age>1 && $age<120){
            $this->$age = $age;
        }
        else{
            throw new Exception("L'âge d'un employé devrait être un entier entre 1 et 120");
        }
    }

    public function getAge(){
    return $this->$age;
    }
}

class Employe extends Humain{
    public function travailler(){
        return "Je suis un employé et je travaille";
    }

    public function presentation(){
        var_dump("Salut, je suis $this->prenom $this->nom et j'ai $this->age ans");
    }
}