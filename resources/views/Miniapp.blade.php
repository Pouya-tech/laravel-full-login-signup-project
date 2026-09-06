<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLACKHOLE INTELLIGENCE</title>
    <script src="/_sdk/element_sdk.js"></script>
    <script src="/_sdk/data_sdk.js"></script>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>

    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body><!-- Loading Screen -->
    <div id="loading-screen">
        <div class="galaxy-container">
            <div class="stars"></div>
            <div class="accretion-disk"></div>
            <div class="black-hole"></div>
        </div>
    </div><!-- Main App -->
    <div id="app">
        <div class="animated-bg"></div><!-- Header -->
        <div class="header">
            <div class="brand-box">
                <div class="brand-name" id="brandName">
                    BLACKHOLE AI
                </div>
            </div><button class="profile-btn" id="profileBtn" aria-label="View profile"> <span
                    class="profile-icon">👤</span> </button>
        </div><!-- Chat Container -->
        <div class="chat-container">
            <div class="welcome-overlay" id="welcomeOverlay">
                <div class="welcome-text"><span class="user-name" id="welcomeUserName">Guest</span>, <span
                        id="welcomeMessage">چطور میتونم کمکت کنم؟</span>
                </div>
            </div>
            <div class="messages-area" id="messagesArea"></div>
        </div><!-- Input Area -->
        <div class="input-area">
            <form id="messageForm" class="input-container">
                <div class="image-input-wrapper"><button type="button" class="image-btn" id="imageBtn"
                        aria-label="Add image">
                        <svg viewbox="0 0 24 24" fill="none">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg></button> <input type="file" id="imageInput" accept="image/*">
                </div>
                <textarea id="messageInput" class="message-input" placeholder="Type a message..." rows="1"
                    aria-label="Message input"></textarea> <button type="submit" class="send-btn" id="sendBtn"
                    aria-label="Send message">
                    <svg viewbox="0 0 24 24">
                        <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                    </svg></button>
            </form>
        </div>
    </div><!-- Profile Page -->
    <div id="profile-page">
        <div class="profile-container"><button class="back-btn" id="backBtn" aria-label="Back to chat">
                <svg viewbox="0 0 24 24" fill="none">
                    <path d="M19 12H5M12 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg></button>
            <div class="profile-avatar" id="profileAvatar"><span class="profile-avatar-placeholder">👤</span>
            </div>
            <div class="profile-info">
                <div class="profile-name" id="profileName">
                    Guest User
                </div>
                <div class="profile-username" id="profileUsername">
                    @@guest
                </div>
                <div class="profile-details">
                    <div class="profile-detail">
                        <div class="profile-detail-label">
                            User ID
                        </div>
                        <div class="profile-detail-value" id="profileId">
                            N/A
                        </div>
                    </div>
                    <div class="profile-detail">
                        <div class="profile-detail-label">
                            Username
                        </div>
                        <div class="profile-detail-value" id="profileUsernameDetail">
                            @@guest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Configuration
        const defaultConfig = {
            brand_name: 'BLACKHOLE INTELLIGENCE',
            welcome_message: 'How can I help you today?',
            webhook_url: ' ',
            primary_color: '#8a2be2',
            secondary_color: '#ba55d3',
            background_color: '#0f0c29',
            text_color: '#ffffff',
            surface_color: '#302b63'
        };

        // State
        let selectedImage = null;
        let telegramUser = null;
        let chatStarted = false;
        let isLoading = false;

        // Initialize Telegram WebApp
        function initTelegram() {
            if (window.Telegram && window.Telegram.WebApp) {
                const webapp = window.Telegram.WebApp;
                webapp.ready();
                webapp.expand();

                if (webapp.initDataUnsafe && webapp.initDataUnsafe.user) {
                    telegramUser = webapp.initDataUnsafe.user;
                    updateUserInterface();
                }
            }
        }

        // Update UI with user data
        function updateUserInterface() {
            if (telegramUser) {
                const firstName = telegramUser.first_name || 'Guest';
                const lastName = telegramUser.last_name || '';
                const fullName = `${firstName} ${lastName}`.trim();
                const username = telegramUser.username ?
                    String.fromCharCode(64) + telegramUser.username :
                    String.fromCharCode(64) + 'guest';


                document.getElementById('welcomeUserName').textContent = firstName;
                document.getElementById('profileName').textContent = fullName;
                document.getElementById('profileUsername').textContent = username;
                document.getElementById('profileUsernameDetail').textContent = username;
                document.getElementById('profileId').textContent = telegramUser.id || 'N/A';

                if (telegramUser.photo_url) {
                    const profileBtn = document.getElementById('profileBtn');
                    profileBtn.innerHTML = `<img src="${telegramUser.photo_url}" alt="Profile">`;

                    const profileAvatar = document.getElementById('profileAvatar');
                    profileAvatar.innerHTML = `<img src="${telegramUser.photo_url}" alt="Profile">`;
                }
            }
        }

        // Detect language and set direction
        function detectLanguage(text) {
            const persianPattern = /[\u0600-\u06FF]/;
            return persianPattern.test(text);
        }

        function setTextDirection(element, text) {
            if (detectLanguage(text)) {
                element.setAttribute('dir', 'rtl');
            } else {
                element.setAttribute('dir', 'ltr');
            }
        }

        // Convert URLs to links
        function linkify(text) {
            const urlPattern = /(https?:\/\/[^\s]+)/g;
            return text.replace(urlPattern, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>');
        }

        // Add message to chat
        function addMessage(content, sender, imageData = null) {
            const messagesArea = document.getElementById('messagesArea');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}`;

            const linkedContent = linkify(content);
            messageDiv.innerHTML = linkedContent;
            setTextDirection(messageDiv, content);

            if (imageData) {
                const img = document.createElement('img');
                img.src = imageData;
                img.alt = 'Uploaded image';
                messageDiv.appendChild(img);
            }

            messagesArea.appendChild(messageDiv);
            messagesArea.scrollTop = messagesArea.scrollHeight;

            if (!chatStarted) {
                chatStarted = true;
                document.getElementById('welcomeOverlay').classList.add('hidden');
            }
        }

        // Show loading indicator
        function showLoading() {
            const messagesArea = document.getElementById('messagesArea');
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'message assistant';
            loadingDiv.id = 'loading-indicator';
            loadingDiv.innerHTML = `
        <div class="loading-indicator">
          <div class="loading-dot"></div>
          <div class="loading-dot"></div>
          <div class="loading-dot"></div>
        </div>
      `;
            messagesArea.appendChild(loadingDiv);
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        function hideLoading() {
            const loading = document.getElementById('loading-indicator');
            if (loading) {
                loading.remove();
            }
        }

        // Send message to webhook
        async function sendToWebhook(messageText, imageBase64, mimeType) {
            const config = window.elementSdk ? window.elementSdk.config : defaultConfig;
            const webhookUrl = config.webhook_url || defaultConfig.webhook_url;

            if (!webhookUrl) {
                return 'الان در برقراری ارتباط مشکل دارم. لطفا بعدا دوباره امتحان کنید.';
            }

            const payload = {
                user: telegramUser || {
                    id: 'guest',
                    first_name: 'Guest',
                    username: 'guest'
                },
                message_text: messageText,
                image_base64: imageBase64,
                mime_type: mimeType,
                timestamp: Date.now(),
                platform: window.Telegram && window.Telegram.WebApp ? 'telegram' : 'web'
            };

            try {
                const response = await fetch(webhookUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                return data.answer || data.response || data.message || 'Message received successfully!';
            } catch (error) {
                console.error('Webhook error:', error);
                return `الان در اتصال مشکل دارم. لطفا بعدا دوباره امتحان کنید.`;
            }
        }

        // Handle form submission
        async function handleSubmit(e) {
            e.preventDefault();

            if (isLoading) return;

            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();

            if (!messageText && !selectedImage) return;

            isLoading = true;
            document.getElementById('sendBtn').disabled = true;

            let imageBase64 = null;
            let mimeType = null;

            if (selectedImage) {
                imageBase64 = selectedImage.data;
                mimeType = selectedImage.type;
            }

            addMessage(messageText || 'Image', 'user', imageBase64);

            if (window.dataSdk) {
                const createResult = await window.dataSdk.create({
                    id: Date.now().toString(),
                    message: messageText || '[Image]',
                    sender: 'user',
                    timestamp: Date.now(),
                    imageData: imageBase64 || ''
                });

                if (!createResult.isOk) {
                    console.error('Failed to save message');
                }
            }

            messageInput.value = '';
            selectedImage = null;
            updateImageBadge();
            adjustTextareaHeight();

            showLoading();

            const response = await sendToWebhook(messageText, imageBase64, mimeType);

            hideLoading();

            addMessage(response, 'assistant');

            if (window.dataSdk) {
                const createResult = await window.dataSdk.create({
                    id: Date.now().toString(),
                    message: response,
                    sender: 'assistant',
                    timestamp: Date.now(),
                    imageData: ''
                });

                if (!createResult.isOk) {
                    console.error('Failed to save response');
                }
            }

            isLoading = false;
            document.getElementById('sendBtn').disabled = false;
        }

        // Handle image selection
        function handleImageSelect(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                selectedImage = {
                    data: event.target.result,
                    type: file.type
                };
                updateImageBadge();
            };
            reader.readAsDataURL(file);
        }

        function updateImageBadge() {
            const wrapper = document.querySelector('.image-input-wrapper');
            let badge = wrapper.querySelector('.image-badge');

            if (selectedImage && !badge) {
                badge = document.createElement('div');
                badge.className = 'image-badge';
                badge.textContent = '1';
                wrapper.appendChild(badge);
            } else if (!selectedImage && badge) {
                badge.remove();
            }
        }

        // Adjust textarea height
        function adjustTextareaHeight() {
            const textarea = document.getElementById('messageInput');
            const container = document.querySelector('.input-container');

            textarea.style.height = 'auto';
            const newHeight = Math.min(textarea.scrollHeight, 120);
            textarea.style.height = newHeight + 'px';

            if (textarea.value.includes('\n') || newHeight > 40) {
                container.classList.add('expanded');
            } else {
                container.classList.remove('expanded');
            }
        }

        // Element SDK implementation
        const element = {
            defaultConfig: defaultConfig,

            onConfigChange: async function(config) {
                const brandName = config.brand_name || defaultConfig.brand_name;
                const welcomeMsg = config.welcome_message || defaultConfig.welcome_message;
                const primaryColor = config.primary_color || defaultConfig.primary_color;
                const secondaryColor = config.secondary_color || defaultConfig.secondary_color;
                const bgColor = config.background_color || defaultConfig.background_color;
                const textColor = config.text_color || defaultConfig.text_color;
                const surfaceColor = config.surface_color || defaultConfig.surface_color;

                document.getElementById('brandName').textContent = brandName;
                document.getElementById('welcomeMessage').textContent = welcomeMsg;

                document.documentElement.style.setProperty('--primary-color', primaryColor);
                document.documentElement.style.setProperty('--secondary-color', secondaryColor);
                document.documentElement.style.setProperty('--bg-color', bgColor);
                document.documentElement.style.setProperty('--text-color', textColor);
                document.documentElement.style.setProperty('--surface-color', surfaceColor);
            },

            mapToCapabilities: function(config) {
                return {
                    recolorables: [{
                            get: () => config.background_color || defaultConfig.background_color,
                            set: (value) => {
                                if (window.elementSdk) {
                                    window.elementSdk.setConfig({
                                        background_color: value
                                    });
                                }
                            }
                        },
                        {
                            get: () => config.surface_color || defaultConfig.surface_color,
                            set: (value) => {
                                if (window.elementSdk) {
                                    window.elementSdk.setConfig({
                                        surface_color: value
                                    });
                                }
                            }
                        },
                        {
                            get: () => config.text_color || defaultConfig.text_color,
                            set: (value) => {
                                if (window.elementSdk) {
                                    window.elementSdk.setConfig({
                                        text_color: value
                                    });
                                }
                            }
                        },
                        {
                            get: () => config.primary_color || defaultConfig.primary_color,
                            set: (value) => {
                                if (window.elementSdk) {
                                    window.elementSdk.setConfig({
                                        primary_color: value
                                    });
                                }
                            }
                        },
                        {
                            get: () => config.secondary_color || defaultConfig.secondary_color,
                            set: (value) => {
                                if (window.elementSdk) {
                                    window.elementSdk.setConfig({
                                        secondary_color: value
                                    });
                                }
                            }
                        }
                    ],
                    borderables: [],
                    fontEditable: undefined,
                    fontSizeable: undefined
                };
            },

            mapToEditPanelValues: function(config) {
                return new Map([
                    ['brand_name', config.brand_name || defaultConfig.brand_name],
                    ['welcome_message', config.welcome_message || defaultConfig.welcome_message],
                    ['webhook_url', config.webhook_url || defaultConfig.webhook_url]
                ]);
            }
        };

        // Data SDK implementation
        const dataHandler = {
            onDataChanged: function(data) {
                // Data is persisted but UI updates happen in real-time during chat
            }
        };

        // Initialize everything
        async function init() {
            setTimeout(() => {
                document.getElementById('loading-screen').classList.add('hidden');
                document.getElementById('app').classList.add('visible');
            }, 3000);

            initTelegram();

            if (window.elementSdk) {
                window.elementSdk.init(element);
            }

            if (window.dataSdk) {
                await window.dataSdk.init(dataHandler);
            }

            document.getElementById('messageForm').addEventListener('submit', handleSubmit);
            document.getElementById('imageBtn').addEventListener('click', () => {
                document.getElementById('imageInput').click();
            });
            document.getElementById('imageInput').addEventListener('change', handleImageSelect);
            document.getElementById('messageInput').addEventListener('input', adjustTextareaHeight);
            document.getElementById('profileBtn').addEventListener('click', () => {
                document.getElementById('profile-page').classList.add('visible');
            });
            document.getElementById('backBtn').addEventListener('click', () => {
                document.getElementById('profile-page').classList.remove('visible');
            });
        }

        init();
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9a6f1ba5b3633626',t:'MTc2NDU1NTY1NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>
