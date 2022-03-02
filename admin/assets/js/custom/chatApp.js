const usersList = document.querySelector(".users-list");

const interval = setInterval(() => {
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
}, 3000);

function openMessage(custid) {
    const headerInfoUser = document.querySelector(".headerInfoUser");
    const chatApp = document.querySelector("#chatApp");

    $('.footerChat').empty();
    $('.footerChat').append(`<form action="#" class="typing-area"><input type="hidden" name="custid" id="custid" value="${custid}"><input type="text" name="message" id="input-field" placeholder="Write a message..." autocomplete="off"><button id="sendBtn" class="chatbox__send--footer"><i class="fab fa-telegram-plane"></i></button></form>`);

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

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chat/getmessage", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatApp.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + custid);
    }, 500);


    // Insert Message
    const form = document.querySelector(".typing-area"),
        outgoing_id = custid,
        inputField = document.getElementById("input-field"),
        sendBtn = document.getElementById("sendBtn"),
        chatBox = document.getElementById("chatApp");

    // Preventing frorm Refresh Browser
    form.onsubmit = (e) => {
        e.preventDefault();
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
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

};