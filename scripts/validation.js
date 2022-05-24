function validationMDP() {
    var str = document.getElementById("login").value;
    if (str.match(/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/g) ) {
        etatConnexion = true;
    } else {
        document.getElementById('etatConnexion').innerHTML = "Login invalide";
        document.getElementById('etatConnexion').className = "mdpInvalide"
        etatConnexion = false;
    }
    return etatConnexion;
}