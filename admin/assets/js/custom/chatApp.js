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
        timer: 4000
    });
    Toast.fire({
        icon: 'success',
        title: '&nbsp;Mohon tunggu sebentar...'
    })
}


function deleteChat(iduserchat) {
    Swal.fire({
        title: "Hapus Pesan ?",
        text: "Aksi ini tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            var xhrdel = new XMLHttpRequest();
            xhrdel.open("POST", "chat/deleteChat", true);
            xhrdel.onload = () => {
                if (xhrdel.readyState === XMLHttpRequest.DONE) {
                    if (xhrdel.status === 200) {
                        let data = xhrdel.response;
                        console.log(data);
                    }
                }
            }
            xhrdel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhrdel.send("incoming_id=" + iduserchat);
            window.location.reload();
        }
    });
};


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

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

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
        chatBox.scrollTop = chatBox.scrollHeight;
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

        var xhrnew2 = new XMLHttpRequest();
        xhrnew2.open("POST", "chat/getmessage", true);
        xhrnew2.onload = () => {
            if (xhrnew2.readyState === XMLHttpRequest.DONE) {
                if (xhrnew2.status === 200) {
                    let data = xhrnew2.response;
                    chatApp.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhrnew2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrnew2.send("incoming_id=" + custid);
    }
};
