function checkFileType(fieldId,fieldCheckMessageId)
{
    var extension = document.getElementById(fieldId).value.substr(document.getElementById(fieldId).value.lastIndexOf('.'));
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