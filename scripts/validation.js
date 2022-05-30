/*
La fonction pour valider le login n'a pas de sens car on a déjà des comptes créés,
il aurait été plus judicieux de faire ce test lors de l'insertion d'une array
Nous avons donc décidé de faire un test lors de l'insertion d'un matériel

On vérifie que le type de matériel 

*/


function validationMateriel() {
    var description = document.getElementById("id_description").value;
    var marque = document.getElementById("id_marque").value;
    var prix = document.getElementById("id_prix").value;
    var nom_image = document.getElementById("id_nom_image").value;
    var etatConnexion = false;
    document.getElementById('res_insertion').className = " Invalide";
    if (!description.match("/^[A-Za-z0-9 _.,!'$ ]*/g")) {
        document.getElementById('res_insertion').innerHTML = "Marque invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
        console.log(description);
    }
    else if (!marque.match("/^[A-Za-z0-9 _.,!'$ ]*/g")) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
        console.log("marque");
    }
    else if (!nom_image.match("/(.*)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g")) {
        document.getElementById('res_insertion').innerHTML = "Erreur du nom de fichier de l'image";
        etatConnexion = false;
        console.log("image");
    }
    else if (isNaN(prix)) {
        document.getElementById('res_insertion').innerHTML = "Erreur, entrez un nombre";
        etatConnexion = false;
        console.log("Prix");
    }
    else {
        etatConnexion = true;
        console.log("tout est nickel");
        document.getElementById('res_insertion').className = " Valide"
    }
    return etatConnexion;
}