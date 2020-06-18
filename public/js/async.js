"use strict";
// this file will handle all the staff of communication with server behind the scenne with ajax;

// var spinner = document.getElementById('spinner');


function deleteUser(target) {
    var xhr = new XMLHttpRequest();
    var result = '';
    var parentElems = target.parentNode.children;
    for (var elem of parentElems) {
        if (elem.classList.contains("usercin")) {
            result = elem.children[0].value;
            break;
        }
    }

    // the the respoce is recieved do 
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // console.log(this.responseText);
                target.parentNode.style.display = 'none';
            }
        }
    }

    // open the connection with the server
    xhr.open('POST', 'admin/delete', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // then we send the request
    xhr.send("id=" + result);

}




// to add user ***********************
function addUsers(evt) {
    // table body
    var tableData = document.getElementById('tableData');
    var xhr = new XMLHttpRequest();
    var form = document.forms['addUserForm']
    console.log(form);
    var targetForm = new FormData(form);
    console.log(targetForm);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // if there is an existing user
                var responce = JSON.parse(xhr.responseText);
                if (!responce.firstnameErr && !responce.lastnameErr && !responce.emailErr
                    && !responce.telnumErr && !responce.cinErr && !responce.gradeErr && !responce.serviceErr) {
                    tableData.appendChild(addRow(responce));
                } else {
                    validateAddingUsser(responce);
                }

            }
        }
    }
    xhr.open('POST', 'admin/adduser', true);
    xhr.send(targetForm);
    // clear the form from data;
    form.reset();

    // then hide form 
    // showHideForm();
    evt.preventDefault();

}
// end add user



// for updating users
function updateUser(e, id) {
    var xhr = new XMLHttpRequest();
    var formdata = new FormData();
    var parent = document.getElementById('user' + id).children;
    for (let i = 0; i < parent.length; i++) {
        if (parent[i].children[0].nodeName === 'INPUT' && i !== 3) {
            formdata.append(parent[i].children[0].name, parent[i].children[0].value);
        }
    }

    formdata.append('id', id);


    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                parent[0].children[0].children[0].checked = false;
                // disable the property of updating data in table
                openUpdate(this, id)
                var responce = JSON.parse(xhr.responseText);
                parent[1].children[0].value = responce.firstName;
                parent[2].children[0].value = responce.lastName;
                parent[4].children[0].value = responce.email;
                parent[5].children[0].value = responce.service;
                parent[6].children[0].value = responce.grade;
            }
        }
    }

    xhr.open('POST', 'admin/update', true);
    xhr.send(formdata);
}




// to unable input for updating
function openUpdate(target, id) {
    // console.log(target.checked);
    var parent = document.getElementById('user' + id);
    var updateBtn = document.getElementById(id);
    if (target.checked) {
        for (let i = 0; i < parent.children.length; i++) {
            if (parent.children[i].children[0].nodeName === 'INPUT' && i !== 3) {
                parent.children[i].children[0].disabled = false;
            }
        }
        updateBtn.disabled = false;
    } else {
        for (let i = 0; i < parent.children.length; i++) {
            if (parent.children[i].children[0].nodeName === 'INPUT') {
                parent.children[i].children[0].disabled = true;
            }
        }
        updateBtn.disabled = true;
    }
}




// responsable for show and hide the form of adding new user 

function showHideForm() {
    var addUserForm = document.getElementById('addUserForm');
    if (addUserForm.classList.contains('hide')) {
        addUserForm.classList.remove('hide');
    } else {
        addUserForm.classList.add('hide');
    }
}



// add row in html table
function addRow(respoce) {
    var row = document.createElement('tr');
    row.setAttribute("class", "user");
    row.setAttribute("id", "user" + respoce.CIN);
    row.innerHTML = `
    <td >
        <div class='form-check'>
            <input class='form-check-input' type='checkbox' onclick='openUpdate(this, ${respoce.CIN})'>
        </div>
    </td>
    <td>
        <input type='text' value='${respoce.firstName}' class='form-control' name = 'upfirstname' disabled/>
    </td>
    <td>
        <input type='text' value='${respoce.lastName}' class='form-control' name = 'uplastname' disabled>
    </td>
    <td  class='usercin'>
        <input type='text' value='${respoce.CIN}' class='form-control' disabled>
    </td>
    <td>
        <input type='text' value='${respoce.email}' name = 'upemail' class='form-control' disabled>
    </td>
    <td>
        <input type='text' value='${respoce.service}' class='form-control' name = 'upservice' disabled>
    </td>
    <td>
        <input type='text' value='${respoce.grade}' class='form-control' name = 'upgrade' disabled>
    </td>
    <td>
    <button type='button' class='btn bg-warning text-white' id='${respoce.CIN}' disabled onclick='updateUser(this, ${respoce.CIN})'>
        <i class='fas fa-pen'></i>
    </button>
    </td>
    <td class='del' onclick='deleteUser(this)'>
        <button class='btn btn-danger'>
    <i class='fas fa-trash-alt'></i>
        </button>
    </td>
    `
    return row;
}



// display validaions errors of adding users
function validateAddingUsser(errMess) {
    var targetElems = document.querySelectorAll('#addUserForm .is-invalid');
    if (errMess.firstnameErr) {
        targetElems[0].textContent = errMess.firstnameErr;
    } else {
        targetElems[0].textContent = "";
    }
    if (errMess.lastnameErr) {
        targetElems[1].textContent = errMess.lastnameErr;
    } else {
        targetElems[1].textContent = "";
    }
    if (errMess.telnumErr) {
        targetElems[2].textContent = errMess.telnumErr;
    } else {
        targetElems[2].textContent = "";
    }
    if (errMess.cinErr) {
        targetElems[3].textContent = errMess.cinErr;
    } else {
        targetElems[3].textContent = "";
    }
    if (errMess.emailErr) {
        targetElems[4].textContent = errMess.emailErr;
    } else {
        targetElems[4].textContent = "";
    }
    if (errMess.serviceErr) {
        targetElems[5].textContent = errMess.serviceErr;
    } else {
        targetElems[5].textContent = "";
    }
    if (errMess.gradeErr) {
        targetElems[6].textContent = errMess.gradeErr;
    } else {
        targetElems[6].textContent = "";
    }

}

