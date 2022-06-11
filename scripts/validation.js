/*
La fonction pour valider la connexion n'a pas de sens car on a déjà des comptes créés qui correspondent aux attentes,
il aurait été plus judicieux de faire ce test lors de l'insertion d'une array
Nous avons donc décidé de faire un test lors de l'insertion d'un matériel
*/

function validationMateriel() {
    /*
    On valide les entrées utilisateurs pour pas qu'elles ne puissent causer de problème dans la BDD
    */

    var description = document.getElementById("id_description").value;
    var marque = document.getElementById("id_marque").value;
    var prix = document.getElementById("id_prix").value;
    var nom_image = document.getElementById("id_nom_image").value;
    var etatConnexion = false;
    document.getElementById('res_insertion').className = " Invalide";

    // On vérifie que la description ne comporte pas de caractères compliqués
    if (!/^[A-Za-z0-9 àéè_.,!'$ ]*/g.test(description)) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }

    // On vérifie que la marque soit en caractères simples
    else if (!/^[A-z'-_àéè& ]*$/g.test(marque)) {
        document.getElementById('res_insertion').innerHTML = "Marque invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }

    // On vérifie que le nom de l'image corresponde bien à un nom d'image
    else if (!/(.*\/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g.test(nom_image)) {
        document.getElementById('res_insertion').innerHTML = "Erreur du nom de fichier de l'image";
        etatConnexion = false;
    }

    // On vérifie que le prix soit bien un nombre
    else if (isNaN(prix)) {
        document.getElementById('res_insertion').innerHTML = "Prix incorrect";
        etatConnexion = false;
    }

    else {
        etatConnexion = true;
    }
    return etatConnexion;
}