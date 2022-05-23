function EtTaFonctionJS() {
    var msg; 
    var str = document.getElementById("mdp").value; 
   
    if (str.match( /[A-Z]/g) && str.match(/^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/)) 
            msg = "<p style='color:green'>Authentification réussie</p>";      
       return True;
}