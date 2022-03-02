<link href="<?= base_url() ?>assets/css/chat.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/css/stylechat.css" rel="stylesheet" />

<div class="chatbox">
    <div class="chatbox__support">
        <div class="chatbox__header">
            <div class="chatbox__image--header">
                <img src="<?= base_url() ?>assets/image.png" alt="image">
            </div>
            <div class="chatbox__content--header">
                <h4 class="chatbox__heading--header">Chat Support</h4>
                <p class="chatbox__description--header">Hubungi kami apabila anda menemukan kendala.</p>
            </div>
        </div>
            <!-- If pengguna belum pernah melakukan chat / data chat telah terhapus di database -->
            <?php if (empty($dataChatPasien)) { ?>
            <div id="startingpoint">
                <div class="container">
                    <div class="chatbox__start">
                        <input type="hidden" id="custid" value="<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>">
                        <input type="hidden" id="custnama" value="<?= $this->session->userdata('data_user_reta')['data']['custnama'] ?>">
                        <button class="btn btn-info" onclick="startChat()">Mulai Percakapan</button>
                    </div>
                </div>
            </div>
            <?php } else { ?>
                <!-- Else pengguna pernah chat / data mash tersimpan di database -->
                <div class="chatbox__messages " id="chat-box">
                    <div>
                    </div>
                </div>
                <div class="chatbox__footer">
                    <form action="#" class="typing-area">
                        <input type="hidden" name="custid" id="custid" value="<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>">
                        <input type="text" name="message" class="input-field" placeholder="Write a message..." autocomplete="off">
                        <button id="sendBtn" class="chatbox__send--footer"><i class="fab fa-telegram-plane"></i></button>
                    </form>
                </div>                
                <script>
                    // Case : Pengguna telah melakukan chat & data masih tersimpan di database
                    const form = document.querySelector(".typing-area"),
                            incoming_id = "ADMINCS",
                            inputField = form.querySelector(".input-field"),
                            sendBtn = form.querySelector("#sendBtn"),
                            custid = document.getElementById('custid').value,
                            chatBox = document.getElementById("chat-box");

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
                    sendBtn.onclick = ()=>{
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "chat/insertChat", true);
                        xhr.onload = ()=>{
                            if(xhr.readyState === XMLHttpRequest.DONE){
                                if(xhr.status === 200){
                                    inputField.value = "";
                                    scrollToBottom();
                                }
                            }
                        }
                        let formData = new FormData(form);
                        xhr.send(formData);
                    }

                    setInterval(() =>{
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "chat/getChat", true);
                        xhr.onload = ()=>{
                        if(xhr.readyState === XMLHttpRequest.DONE){
                            if(xhr.status === 200){
                                let data = xhr.response;
                                chatBox.innerHTML = data;
                            }
                        }
                        }
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("outgoing_id="+custid);
                    }, 500);

                    function scrollToBottom(){
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                </script>
            <?php } ?>  
    </div>
    <div class="chatbox__button">
        <button></button>
    </div>
</div>

<script src="<?= base_url() ?>assets/js/custom/appchat.js"></script>
<script src="<?= base_url() ?>assets/js/custom/chat.js"></script>
<script>
    const chatButton = document.querySelector('.chatbox__button');
    const chatContent = document.querySelector('.chatbox__support');
    const icons = {
        isClicked: '<img src="<?= base_url() ?>assets/icons/chatbox-icon.svg" />',
        isNotClicked: '<img src="<?= base_url() ?>assets/icons/chatbox-icon.svg" />'
    }
    const chatbox = new InteractiveChatbox(chatButton, chatContent, icons);
    chatbox.display();
    chatbox.toggleIcon(false, chatButton);
</script>