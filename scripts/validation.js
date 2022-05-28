/*
La fonction pour valider le login n'a pas de sens car on a déjà des comptes créés,
il aurait été plus judicieux de faire ce test lors de l'insertion d'une array
Nous avons donc décidé de faire un test lors de l'insertion d'un matériel
*/


/*
On vérifie que le type de matériel 

*/

function validationMateriel() {
    var str = document.getElementById("nom_val").value;
    if (str.match(/	^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/g) ) {
        etatConnexion = true;
    } else {
        document.getElementById('etatConnexion').innerHTML = "Login invalide";
        document.getElementById('etatConnexion').className = "mdpInvalide"
        etatConnexion = false;
    }
    return etatConnexion;
}