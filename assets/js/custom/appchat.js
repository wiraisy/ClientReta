// Case : Pengguna belum chat sama sekali / data chat pada database telah dihapus
function startChat() {
    // Upload Data Pasien ke Data Chat
    const custid = document.getElementById('custid').value;
    const custnama = document.getElementById('custnama').value;
    let xhrPostPasien = new XMLHttpRequest();
    xhrPostPasien.open("POST", "chat/postPasien", true);
    let formData = new FormData();
    formData.append('custid', custid);
    formData.append('custnama', custnama);
    xhrPostPasien.send(formData);

    $("#startingpoint").empty();

    let chatContainer = $(`<div class="chatbox__messages" id="chat-box"><div><div class="messages__item messages__item--visitor">Can you let me talk to the support?</div><div class="messages__item messages__item--operator">Sure!</div><div class="messages__item messages__item--visitor">Need your help, I need a developer in my site.</div><div class="messages__item messages__item--operator">Hi... What is it? I'm a front-end developer, yay!</div></div></div><div class="chatbox__footer"><form action="#" class="typing-area"><input type="hidden" name="custid" id="custid" value="${custid}"><input type="text" name="message" class="input-field" placeholder="Write a message..." autocomplete="off"><button id="sendBtn" class="chatbox__send--footer"><i class="fab fa-telegram-plane"></i></button></form></div>`);

    $('#startingpoint').append(chatContainer).hide().fadeIn(1000);

    const form = document.querySelector(".typing-area"),
        incoming_id = "ADMINCS",
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("#sendBtn"),
        chatBox = document.getElementById("chat-box");

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
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chat/getChat", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("outgoing_id=" + custid);
    }, 500);
}