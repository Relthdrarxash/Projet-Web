/*
La fonction pour valider le login n'a pas de sens car on a déjà des comptes créés,
il aurait été plus judicieux de faire ce test lors de l'insertion d'une array
Nous avons donc décidé de faire un test lors de l'insertion d'un matériel
*/


/*
On vérifie que le type de matériel 

*/

function validationMateriel() {
    var description = document.getElementById("id_description").value;
    var marque = document.getElementById("id_marque").value;
    var prix = document.getElementById("id_prix").value;
<<<<<<< HEAD
<<<<<<< Updated upstream
    var nom_image = document.getElementById("id_nom_image").value
    if (!description.match("/^[a-zA-Z ]*$/g")) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
=======
    var nom_image = document.getElementById("id_nom_image").value;
    var etatConnexion = false;
    document.getElementById('res_insertion').className = " Invalide";

    if (!description.match("/^[A-Za-z0-9 _.,!'$ ]*/g")) {
        document.getElementById('res_insertion').innerHTML = "Marque invalide, veuillez n'entrer que des caractères simples";
>>>>>>> Stashed changes
        etatConnexion = false;
    }
<<<<<<< Updated upstream
    else if (!marque.match("/^[a-zA-Z ]*$/g")) {
=======

    else if (!marque.match("/^[A-Za-z0-9 _.,!'$ ]*/g")) {
>>>>>>> Stashed changes
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }
<<<<<<< Updated upstream
    else if (!nom_image.match("/(.*/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g")) {
=======

    else if (!nom_image.match("/(.*)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g")) {
>>>>>>> Stashed changes
=======
    var nom_image = document.getElementById("id_nom_image").value
    if (!description.match("/^[a-zA-Z ]*$/g")) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }
    else if (!marque.match("/^[a-zA-Z ]*$/g")) {
        document.getElementById('res_insertion').innerHTML = "Description invalide, veuillez n'entrer que des caractères simples";
        etatConnexion = false;
    }
    else if (!nom_image.match("/(.*/)*.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$/g")) {
>>>>>>> 321a6246df5b8f108ef3e42bff27d058ac1f150c
        document.getElementById('res_insertion').innerHTML = "Erreur du nom de fichier de l'image";
        etatConnexion = false;
    }

    else if (isNaN(prix)) {
        document.getElementById('res_insertion').innerHTML = "Erreur du nom de fichier de l'image";
        etatConnexion = false;
    }
    
    else {
        etatConnexion = true;
    }
    return etatConnexion;
}