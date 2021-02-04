function addDeviceLine(id) {
    let info = document.getElementById('deviceInfo' + id);
    let name = info.querySelector('#deviceName').innerHTML;
    let compensation = info.querySelector('#deviceCompensation').innerHTML;
    let table = document.getElementById('takenDevices');
    let columns = document.querySelectorAll('#takenDevices tr');

    var row = table.insertRow(0);
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);

    cell1.innerHTML = name;
    cell2.innerHTML = compensation;
    cell2.classList.add('compensationMoney', 'text-right');

    input = document.createElement('input');

    input.name = "device_ID[" + columns.length + "]";
    input.value = id;
    input.type = 'hidden';

    row.appendChild(input);
}

function openMaintenanceMenu() {
    let links = document.querySelectorAll('.maintenance-menu .depth-link');
    let menu = document.getElementsByClassName('maintenance-menu');

    if (menu.item(0).classList.contains('green-background')) {
        menu.item(0).classList.remove('green-background');

        for (var i = 0; i < links.length; i++) {
            links[i].style.display = "none";
        }
    } else {
        menu.item(0).classList.add('green-background');

        for (var i = 0; i < links.length; i++) {
            links[i].style.display = "block";
        }
    }
}

let maintenanceMenu = document.getElementById('maintenance-menu');

if (maintenanceMenu) {
    maintenanceMenu.addEventListener("click", openMaintenanceMenu);
}

function openReportMenu() {
    let links = document.querySelectorAll('.report-menu .depth-link');
    let menu = document.getElementsByClassName('report-menu');

    if (menu.item(0).classList.contains('green-background')) {
        menu.item(0).classList.remove('green-background');

        for (var i = 0; i < links.length; i++) {
            links[i].style.display = "none";
        }
    } else {
        menu.item(0).classList.add('green-background');

        for (var i = 0; i < links.length; i++) {
            links[i].style.display = "block";
        }
    }
}

let reportMenu = document.getElementById('report-menu');

if (reportMenu) {
    reportMenu.addEventListener("click", openReportMenu);
}

