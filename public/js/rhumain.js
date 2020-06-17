"use strict";

// send request of acceptation of a demande;
function acceptDemande(targt) {
    var parent = targt.parentNode.parentNode;
    var demandeId = parent.getAttribute('id');
    var xhr = new XMLHttpRequest();
    // the the respoce is recieved do 
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if (xhr.responseText == 1) {
                    parent.style.display = "none";
                } else {
                    alert('sorry something goes wrong');
                }
            }
        }
    }

    // // open the connection with the server
    xhr.open('POST', 'rhumain/acceptDemande', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // then we send the request
    xhr.send("numero=" + demandeId);
}


// send request of refuser of a demande;
function refuseDemande(targt) {
    var parent = targt.parentNode.parentNode;
    var parent = targt.parentNode.parentNode;
    var demandeId = parent.getAttribute('id');
    console.log(demandeId);
    var xhr = new XMLHttpRequest();
    // the the respoce is recieved do 
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                if (xhr.responseText == 1) {
                    parent.style.display = "none";
                }
                else {
                    alert('sorry something goes wrong');
                }
            }
        }
    }

    // // open the connection with the server
    xhr.open('POST', 'rhumain/refuseDemande', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // then we send the request
    xhr.send("numero=" + demandeId);
}