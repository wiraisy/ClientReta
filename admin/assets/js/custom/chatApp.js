const usersList = document.querySelector(".users-list");
let xhr = new XMLHttpRequest();
xhr.open("GET", "chat/getAllUsers", true);
xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            let data = xhr.response;
            usersList.innerHTML = data;
        }
    }
}
xhr.send();

// Refresh User
function refreshUser() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "chat/getAllUsers", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.send();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    Toast.fire({
        icon: 'success',
        title: '&nbsp;Refresh User Berhasil'
    })
}


// Refresh Chat
function refreshChat(custid) {
    var xhrnew = new XMLHttpRequest();
    xhrnew.open("POST", "chat/getmessage", true);
    xhrnew.onload = () => {
        if (xhrnew.readyState === XMLHttpRequest.DONE) {
            if (xhrnew.status === 200) {
                let data = xhrnew.response;
                chatApp.innerHTML = data;
            }
        }
    }
    xhrnew.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrnew.send("incoming_id=" + custid);

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    Toast.fire({
        icon: 'success',
        title: '&nbsp;Refresh Chat Berhasil'
    })
}

function openMessage(custid) {
    const headerInfoUser = document.querySelector(".headerInfoUser");
    const chatApp = document.querySelector("#chatApp");
    const idcustomer = custid;

    $(this).removeClass("active");
    $(this).addClass("active");

    $('.headerInfoUser').empty();
    $('.chatApp').empty();
    $('.footerChat').empty();

    $('.footerChat').append(`<form action="#" class="typing-area input-group mb-0"><input type="hidden" name="custid" id="custid" value="${custid}"><button id="sendBtn" class="input-group-prepend"><i class="fa fa-send"></i></button><input name="message" id="input-field" type="text" class="form-control" autocomplete="off" placeholder="Enter text here..."></form>`);

    const form = document.querySelector(".typing-area"),
        inputField = document.getElementById("input-field"),
        sendBtn = document.getElementById("sendBtn"),
        userlist = document.getElementById(`userChat${custid}`),
        chatBox = document.getElementById("chatApp");

    // Get Information User
    let xhrUser = new XMLHttpRequest();
    xhrUser.open("POST", "chat/getbyUser", true);
    xhrUser.onload = () => {
        if (xhrUser.readyState === XMLHttpRequest.DONE) {
            if (xhrUser.status === 200) {
                let data = xhrUser.response;
                headerInfoUser.innerHTML = data;
            }
        }
    }
    xhrUser.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrUser.send("incoming_id=" + custid);

    // Get Message
    var xhrMessage = new XMLHttpRequest();
    xhrMessage.open("POST", "chat/getmessage", true);
    xhrMessage.onload = () => {
        if (xhrMessage.readyState === XMLHttpRequest.DONE) {
            if (xhrMessage.status === 200) {
                let data = xhrMessage.response;
                chatApp.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhrMessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrMessage.send("incoming_id=" + custid);

    // Preventing frorm Refresh Browser
    form.onsubmit = (e) => {
        e.preventDefault();
    }

    // Add & Remove Active Class in Chatbox Div
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }

    // Waktu ada inputan,button send aktif
    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    }

    // Kirim Pesan
    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chat/insertChat", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);

        var xhrnew = new XMLHttpRequest();
        xhrnew.open("POST", "chat/getmessage", true);
        xhrnew.onload = () => {
            if (xhrnew.readyState === XMLHttpRequest.DONE) {
                if (xhrnew.status === 200) {
                    let data = xhrnew.response;
                    chatApp.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhrnew.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrnew.send("incoming_id=" + custid);
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }


};