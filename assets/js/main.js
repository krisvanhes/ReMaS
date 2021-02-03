function checkStatus() {
    let status = document.getElementById('mounting_state');
    let statusOthers = document.getElementById('mounting_state_others');

    if (status.value === 'Anders') {
        statusOthers.style.display = "inline";
    } else {
        statusOthers.style.display = "none";
    }
}

function extraDeviceLine() {
    let deviceLine = document.querySelector('.device-line');
    let clonedLine = deviceLine.cloneNode(true);
    clonedLine.className = 'device-line';

    inputs = deviceLine.getElementsByTagName('input');
    for (index = 0; index < inputs.length; ++index) {
        // deal with inputs[index] element.

        console.log(inputs[index]);
    }

    deviceLine.querySelector('[name=device1]');

    deviceLine.parentNode.insertBefore(clonedLine, deviceLine);

}