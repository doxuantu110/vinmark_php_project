$(document).ready(function () {
    $("#chat-toggle").click(function () {
        $("#chat-box").toggleClass("hidden");
        $("#scrollUp").toggleClass("hidden");
        if ($("#chat-box").hasClass("hidden")) {
            $("#chat-widget").css('bottom', '140px');
        } else {
            loadMessages();
            $("#chat-widget").css('bottom', '20px');
        }
    });

    $("#chat-close").click(function () {
        $("#chat-box").addClass("hidden");
        $("#chat-widget").css('bottom', '140px');
    });

    $("#send-btn").click(function () {
        let msg = $("#message-input").val().trim();
        if (!msg) return;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('/chat/send', {
            message: msg
        }, function (res) {
            // res.user and res.bot
            if (res.user) appendOne(res.user);
            if (res.bot) appendOne(res.bot);
            $("#message-input").val('');
        }).fail(function () {
            appendOne({
                sender: 'bot',
                message: 'Lỗi: không gửi được tin nhắn.'
            });
        });
    });

    //Enter to send message
    $("#message-input").keypress(function (e) {
        if (e.which === 13) {
            $("#send-btn").click();
            return false;
        }
    });

    function loadMessages() {
        $("#chat-messages").html('');
        $.get('/chat/messages', function (msgs) {

            if (!msgs || msgs.length === 0) {
                $("#chat-messages").append(`<div class="bot-msg">Xin chào 👋, tôi có thể giúp gì cho bạn?</div>`);
                return;
            }

            msgs.forEach(function (m) {
                appendOne(m);
            });
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        });
    }

    function appendOne(m) {
        let cls = m.sender === 'user' ? 'user-msg' : 'bot-msg';
        $("#chat-messages").append(`<div class="${cls}">${escapeHtml(m.message)}</div>`);
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }
});
