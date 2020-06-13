'use strict';


// search in the table

var searchBar = document.getElementById('searchintable');
var tableData = document.querySelectorAll("#tableData > tr > .filter > input");

searchBar.addEventListener('input', function search(e) {
    for (let elem of tableData) {
        if (!elem.value.toLowerCase().includes(e.target.value.toLowerCase())) {
            elem.parentNode.parentNode.style.display = "none";
        } else {
            elem.parentNode.parentNode.style.display = "table-row";
        }
    }
})