<link href="<?= base_url() ?>assets/css/chat.css" rel="stylesheet" />

<!-- Chat Content-->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app" id="containerChat">
            <div id="plist" class="people-list">
                <div class="row text-center border-bottom">
                    <div class="col-8">
                        <h1 class="mb-0" style="color:#f5869e;">Reta Chat</h1>
                    </div>
                    <div class="col-4 refresh-user" onclick="refreshUser()">
                        <i class="fa fa-sync"></i>
                    </div>
                </div>
                <ul class="users-list list-unstyled chat-list mt-2 mb-0">
                </ul>
            </div>
            <div class="chat">
                <div class="chat-header clearfix headerInfoUser">
                </div>
                <div class="chat-history">
                    <ul class="chatApp m-b-0" id="chatApp">
                    </ul>
                </div>
                <div class="chat-message clearfix footerChat">
                </div>
            </div>
        </div>
    </div>
</div>
                    
<script src="<?= base_url() ?>assets/js/custom/chatApp.js"></script>