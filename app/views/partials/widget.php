<!-- Gerekli Kütüphaneler (Dış Linkler - BASE_URL Kaldırıldı) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<style>
    /* --- WIDGET STİLLERİ --- */
    #ai-widget-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .ai-toggle-btn {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s;
    }
    .ai-toggle-btn:hover { transform: scale(1.1); }
    .ai-toggle-btn svg { fill: white; width: 30px; height: 30px; }

    .ai-chat-window {
        width: 380px;
        height: 550px;
        background-color: #1e1e2e;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        margin-bottom: 15px;
        border: 1px solid #313244;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        transform: translateY(20px);
    }

    .ai-chat-window.open { display: flex; opacity: 1; transform: translateY(0); }

    .ai-header {
        background: #181825;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #313244;
        color: #cdd6f4;
    }
    .status-dot { width: 8px; height: 8px; background: #a6e3a1; border-radius: 50%; display: inline-block; }
    .ai-close-btn, .ai-clear-btn { background: none; border: none; color: #a6adc8; cursor: pointer; font-size: 18px; }
    .ai-clear-btn:hover { color: #f38ba8; }

    .ai-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background-color: #1e1e2e;
        color: #cdd6f4;
    }
    .ai-messages::-webkit-scrollbar { width: 5px; }
    .ai-messages::-webkit-scrollbar-thumb { background: #45475a; border-radius: 10px; }

    .ai-msg { margin-bottom: 15px; display: flex; flex-direction: column; max-width: 85%; }
    .ai-msg.user { align-self: flex-end; align-items: flex-end; }
    .ai-msg.bot { align-self: flex-start; align-items: flex-start; }

    .ai-bubble {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.5;
        word-wrap: break-word;
        max-width: 100%;
    }
    .ai-msg.user .ai-bubble { background: #6366f1; color: white; border-bottom-right-radius: 2px; }
    .ai-msg.bot .ai-bubble { background: #313244; color: #cdd6f4; border-bottom-left-radius: 2px; }

    .ai-bubble pre { background: #11111b; padding: 10px; border-radius: 8px; overflow-x: auto; margin: 5px 0; }
    .ai-bubble code { font-family: monospace; font-size: 0.9em; }
    .ai-bubble img { max-width: 100%; border-radius: 8px; margin-top: 5px; }

    .ai-input-area {
        padding: 15px;
        background: #181825;
        border-top: 1px solid #313244;
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    #ai-input {
        flex: 1;
        background: #313244;
        border: 1px solid #45475a;
        color: white;
        padding: 10px;
        border-radius: 8px;
        resize: none;
        height: 40px;
        max-height: 100px;
        outline: none;
        font-family: inherit;
    }
    #ai-input:focus { border-color: #6366f1; }

    .ai-attach-btn, .ai-send-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        color: #a6adc8;
        transition: color 0.3s;
    }
    .ai-send-btn { background: #6366f1; border-radius: 8px; color: white; }
    .ai-send-btn:hover { background: #5457cd; }
    .ai-attach-btn:hover { color: #cdd6f4; }
    .ai-attach-btn.active { color: #a6e3a1; }

    .ai-loading { display: none; padding: 10px; font-size: 12px; color: #a6adc8; font-style: italic; }
    .dot-flashing { display: inline-block; width: 6px; height: 6px; border-radius: 5px; background-color: #6366f1; animation: dot-flashing 1s infinite linear alternate; delay: 0.5s; }
    @keyframes dot-flashing { 0% { opacity: 1; } 100% { opacity: 0.2; } }

    @media (max-width: 480px) {
        .ai-chat-window { width: 90vw; height: 80vh; bottom: 80px; right: 5vw; }
    }
</style>

<div id="ai-widget-container">

    <!-- Sohbet Penceresi -->
    <div class="ai-chat-window" id="chatWindow">
        <div class="ai-header">
            <h3><span class="status-dot"></span> AI Asistan</h3>
            <div>
                <button class="ai-clear-btn" title="Geçmişi Temizle" onclick="clearChat()">🗑️</button>
                <button class="ai-close-btn" onclick="toggleChat()">✕</button>
            </div>
        </div>

        <div class="ai-messages" id="messagesList">
            <div class="ai-msg bot">
                <div class="ai-bubble">Merhaba! 👋 Size nasıl yardımcı olabilirim?</div>
            </div>
        </div>

        <div class="ai-loading" id="loadingIndicator">AI yazıyor<span class="dot-flashing"></span></div>

        <div class="ai-input-area">
            <input type="file" id="fileInput" style="display: none;" onchange="handleFileSelect()">
            <button class="ai-attach-btn" onclick="document.getElementById('fileInput').click()" title="Dosya Ekle">📎</button>

            <textarea id="ai-input" placeholder="Mesaj yaz..." rows="1" onkeydown="if(event.key === 'Enter' && !event.shiftKey){ event.preventDefault(); sendMessage(); }"></textarea>

            <button class="ai-send-btn" onclick="sendMessage()">➤</button>
        </div>
    </div>

    <!-- Yuvarlak Açma Butonu -->
    <div class="ai-toggle-btn" onclick="toggleChat()">
        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
    </div>

</div>

<script>
    const chatWindow = document.getElementById('chatWindow');
    const messagesList = document.getElementById('messagesList');
    const inputField = document.getElementById('ai-input');
    const loading = document.getElementById('loadingIndicator');
    let selectedFile = null;

    function toggleChat() {
        chatWindow.classList.toggle('open');
        if(chatWindow.classList.contains('open')) inputField.focus();
    }

    function handleFileSelect() {
        const fileInput = document.getElementById('fileInput');
        if (fileInput.files.length > 0) {
            selectedFile = fileInput.files[0];
            document.querySelector('.ai-attach-btn').classList.add('active');
            inputField.placeholder = "Dosya eklendi. Sorunu yaz...";
        }
    }

    function appendMessage(role, text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `ai-msg ${role}`;

        let content = text;
        if (role === 'bot') {
            content = marked.parse(text);
        } else {
            content = text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        }

        msgDiv.innerHTML = `<div class="ai-bubble">${content}</div>`;
        messagesList.appendChild(msgDiv);
        messagesList.scrollTop = messagesList.scrollHeight;
        if (role === 'bot') hljs.highlightAll();
    }

    function clearChat() {
        if(confirm("Sohbet geçmişi silinsin mi?")) {
            fetch('<?php echo BASE_URL; ?>/index.php/api/ai', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=clear'
            }).then(() => {
                messagesList.innerHTML = '<div class="ai-msg bot"><div class="ai-bubble">Hafıza temizlendi. Yeni bir konu konuşalım!</div></div>';
            });
        }
    }

    async function sendMessage() {
        const text = inputField.value.trim();
        if (!text && !selectedFile) return;

        appendMessage('user', text + (selectedFile ? ' 📎 [Dosya]' : ''));
        inputField.value = '';
        inputField.style.height = '40px';

        loading.style.display = 'block';

        const formData = new FormData();
        formData.append('question', text);
        if (selectedFile) {
            formData.append('file', selectedFile);
            selectedFile = null;
            document.querySelector('.ai-attach-btn').classList.remove('active');
            inputField.placeholder = "Mesaj yaz...";
            document.getElementById('fileInput').value = '';
        }

        try {
            // BASE_URL ile API yolunu düzelttik
            const response = await fetch('<?php echo BASE_URL; ?>/index.php/api/ai', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            loading.style.display = 'none';

            if (data.status === 'success') {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', '⚠️ Hata: ' + (data.message || 'Bilinmeyen bir sorun oluştu.'));
            }

        } catch (error) {
            loading.style.display = 'none';
            appendMessage('bot', '⚠️ Bağlantı hatası oluştu.');
            console.error(error);
        }
    }
</script>