function sendMessage(){
    let name = document.getElementById('name').value;
    let subject = document.getElementById('email').value;
    let messageBody = document.getElementById('message').value;

    let url = 'https://wa.me/+2349043375932?text='
    + 'Name: ' + name + '%0a' + '%0a'
    + 'Email: ' + subject + '%0a' + '%0a'
    + 'Message: ' + messageBody;

        return window.open(url, "_blank").focus();
}

document.getElementById('send').addEventListener("click", function(){
    sendMessage();
})