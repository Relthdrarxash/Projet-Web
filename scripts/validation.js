/*
La fonction pour valider le login n'a pas de sens car on a déjà des comptes créés,
il aurait été plus judicieux de faire ce test lors de l'insertion d'une array
Nous avons donc décidé de faire un test lors de l'insertion d'un matériel
*/


/*
On vérifie que le type de matériel 

*/

function validationMateriel() {
    console.log("t");
    var description = document.getElementById("id_description").value;
    var marque = document.getElementById("id_marque").value;
    var prix = document.getElementById("id_prix").value;

    var nom_image = document.getElementById("id_nom_image").value;
    var etatConnexion = true;
    document.getElementById('res_insertion').className = " Invalide";
    if (!/^[A-Za-z0-9 _.,!'$ ]*/g.test(description)) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }
    else if (!/^[A-z'-_ ]*$/g.test(marque)) {
        document.getElementById('res_insertion').innerHTML = "Marque invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }
    else if (!/(.*\/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g.test(nom_image)) {
        document.getElementById('res_insertion').innerHTML = "Erreur du nom de fichier de l'image";
        etatConnexion = false;
    }
    else if (isNaN(prix)) {
        document.getElementById('res_insertion').innerHTML = "Prix incorrect";
        etatConnexion = false;
    }
    
    else {
        etatConnexion = true;
    }
    return etatConnexion;
}