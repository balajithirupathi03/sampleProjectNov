function hideAccommodation() {
    document.getElementById('acccomadtaionHiddenPart').style.display = 'none';
}

function showAccommodation() {
    document.getElementById('acccomadtaionHiddenPart').style.display = 'contents';
}

function setMinimunTodate() {
    var minToDate = document.getElementById('tournamentDaysFrom').value;
    document.getElementById('tournamentDaysTo').setAttribute("min", minToDate);
    document.getElementById('lastDateForRegistration').setAttribute("max", minToDate);
}

function setMinimumAge(){
    var minAge = documnet.getElementById('minAge').value;
    document.getElementById('maxAge').setAttribute("min", minAge);
}

function setMinimumWeight(){
    var minWeight = documnet.getElementById('minWeight').value;
    document.getElementById('maxWeight').setAttribute("min", minWeight);
}

function checkFileType(fieldId,fieldCheckMessageId)
{   
    var extension = '.' + document.getElementById(fieldId).value.split('.').slice(-1)[0];
    if ((extension.toLowerCase() != ".gif") &&
       (extension.toLowerCase() != ".jpg") &&
       (extension.toLowerCase() != ".jpeg") &&
       (extension.toLowerCase() != ".gif") &&
       (extension != ""))
    {
        document.getElementById(fieldCheckMessageId).style.display = 'contents';
        document.getElementById(fieldId).value='';
        document.getElementById(fieldId).focus();
    }
    else{
    document.getElementById(fieldCheckMessageId).style.display = 'none';}
}
