<?php
/**
 * Simple Chat v2.0.3 by Stephan Soller
 * http://arkanis.de/projects/simple-chat/
 * Updated with light theme, visible messages, persistent name storage, and enhanced UI
 */

// Name of the message buffer file. You have to create it manually with read and write permissions for the webserver.
$messages_buffer_file = "messages.json";
// Number of most recent messages kept in the buffer.
$messages_buffer_size = 50;
// Disabled by default, set to true to enable. Appends each chat messages to a chatlog.txt text file.
$enable_chatlog = false;

if (isset($_POST["content"]) && isset($_POST["name"])) {
    // Create the message buffer file if it doesn't exist yet.
    if (!file_exists($messages_buffer_file))
        touch($messages_buffer_file);
    
    // Open, lock and read the message buffer file
    $buffer = fopen($messages_buffer_file, "r+b");
    flock($buffer, LOCK_EX);
    $buffer_data = stream_get_contents($buffer);
    
    // Append new message to the buffer data or start with a message id of 0 if the buffer is empty
    $messages = $buffer_data ? json_decode($buffer_data, true) : [];
    $next_id = (count($messages) > 0) ? $messages[count($messages) - 1]["id"] + 1 : 0;
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
    $content = htmlspecialchars($_POST["content"], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
    $messages[] = ["id" => $next_id, "time" => time(), "name" => $name, "content" => $content];
    
    // Remove old messages if necessary to keep the buffer size
    if (count($messages) > $messages_buffer_size)
        $messages = array_slice($messages, count($messages) - $messages_buffer_size);
    
    // Handle message deletion
    if (isset($_POST['delete_id'])) {
        $delete_id = (int)$_POST['delete_id'];
        $messages = array_filter($messages, fn($msg) => $msg['id'] !== $delete_id);
        $messages = array_values($messages); // Reindex array
    }
    
    // Rewrite and unlock the message file
    ftruncate($buffer, 0);
    rewind($buffer);
    fwrite($buffer, json_encode($messages));
    flock($buffer, LOCK_UN);
    fclose($buffer);
    
    // Optional: Append message to log file
    if ($enable_chatlog && !isset($_POST['delete_id']))
        file_put_contents("chatlog.txt", date("Y-m-d H:i:s") . "\t" . strtr($name, "\t", " ") . "\t" . strtr($content, "\t", " ") . "\n", FILE_APPEND);
    
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <meta name="author" content="Stephan Soller">
    <title>Simple Chat</title>
    <!-- Load Lexend font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            @apply bg-white text-gray-900 min-h-screen flex flex-col;
        }
        /* Dark mode */
        body.dark {
            @apply bg-gray-900 text-white;
        }
        /* Full-screen chat container */
        #chat-container {
            @apply w-full h-screen flex flex-col;
        }
        #messages li {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Message bubble styles */
        #messages li {
            @apply flex mb-3 px-2;
        }
        #messages li.pending {
            @apply justify-end;
        }
        #messages li:not(.pending) {
            @apply justify-start;
        }
        #messages li .bubble {
            @apply p-3 rounded-xl max-w-[70%] shadow-sm;
        }
        #messages li:not(.pending) .bubble {
            @apply bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white;
        }
        #messages li.pending .bubble {
            @apply bg-blue-500 text-white dark:bg-blue-600;
        }
        #messages li .bubble small {
            @apply block text-xs opacity-75 mb-1;
        }
        /* Button hover animation */
        button {
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        button:hover {
            transform: scale(1.05);
        }
        /* Delete button */
        .delete-btn {
            @apply mt-1 text-xs underline text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300;
        }
        /* Toast animation */
        @keyframes toastFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fixed {
            animation: toastFade 0.3s ease-in;
        }
    </style>
    <script type="module">
        // Load saved name from localStorage or default to "Anonymous"
        const savedName = localStorage.getItem("chatName") || "Anonymous";
        document.querySelector("input[name='name']").value = savedName;

        // Remove the "loading…" list entry
        document.querySelector("ul#messages > li").remove();
        
        // Auto-resize textarea
        document.querySelector('textarea[name="content"]').addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = `${this.scrollHeight}px`;
        });
        
        // Form submission
        document.querySelector("form").addEventListener("submit", async event => {
            const form = event.target;
            const name = form.name.value;
            const content = form.content.value;
            
            event.preventDefault();
            
            if (name === "" || content === "")
                return;
            
            // Save the name to localStorage
            localStorage.setItem("chatName", name);
            
            // Add pending message
            const messageList = document.querySelector("ul#messages");
            const messageElement = messageList.querySelector("template").content.cloneNode(true);
                messageElement.querySelector("small").textContent = name + " (sending...)";
                messageElement.querySelector("span").textContent = content;
            messageList.append(messageElement);
            
            await fetch(form.action, { method: "POST", body: new URLSearchParams({name, content}) });
            
            // Show sent confirmation
            const toast = document.createElement('div');
            toast.textContent = 'Message sent!';
            toast.className = 'fixed bottom-4 right-4 p-2 bg-green-500 text-white rounded-lg shadow-lg';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
            
            messageList.scrollTop = messageList.scrollHeight;
            form.content.value = "";
            form.content.focus();
        });
        
        // Delete message handler
        document.querySelector('ul#messages').addEventListener('click', async (e) => {
            if (e.target.classList.contains('delete-btn')) {
                const li = e.target.closest('li');
                const id = li.dataset.id;
                await fetch(document.querySelector('form').action, { method: 'POST', body: new URLSearchParams({ delete_id: id }) });
                li.remove();
            }
        });
        
        // Update delete buttons visibility
        function updateDeleteButtons() {
            const userName = localStorage.getItem('chatName') || 'Anonymous';
            document.querySelectorAll('ul#messages li').forEach(li => {
                const name = li.querySelector('small').textContent.split(': ')[1]?.replace(' (sending...)', '');
                li.querySelector('.delete-btn').style.display = (name === userName) ? 'block' : 'none';
            });
        }
        
        async function poll_for_new_messages() {
            const response = await fetch("messages.json", { cache: "no-cache" });
            
            if (!response.ok)
                return;
            
            const messages = await response.json();
            const messageList = document.querySelector("ul#messages");
            const messageTemplate = messageList.querySelector("template").content.querySelector("li");
            
            const pixelDistanceFromListeBottom = messageList.scrollHeight - messageList.scrollTop - messageList.clientHeight;
            const scrollToBottom = (pixelDistanceFromListeBottom < 50);
            
            for (const li of messageList.querySelectorAll("li.pending"))
                li.remove();
            
            const lastMessageId = parseInt(messageList.dataset.lastMessageId ?? "-1");
            
            for (const msg of messages) {
                if (msg.id > lastMessageId) {
                    const date = new Date(msg.time * 1000);
                    const messageElement = messageTemplate.cloneNode(true);
                        messageElement.classList.remove("pending");
                        messageElement.dataset.id = msg.id;
                        messageElement.querySelector("small").textContent = Intl.DateTimeFormat(undefined, { dateStyle: "medium", timeStyle: "short" }).format(date) + ": " + msg.name;
                        messageElement.querySelector("span").textContent = msg.content;
                    messageList.append(messageElement);
                    messageList.dataset.lastMessageId = msg.id;
                }
            }
            
            for (const li of Array.from(messageList.querySelectorAll("li")).slice(0, -20))
                li.remove();
            
            // Scroll to bottom on initial load or if near the bottom
            if (scrollToBottom || messageList.dataset.initialLoad !== 'false') {
                messageList.scrollTop = messageList.scrollHeight - messageList.clientHeight;
                messageList.dataset.initialLoad = 'false';
            }
            
            updateDeleteButtons();
        }
        
        poll_for_new_messages();
        setInterval(poll_for_new_messages, 5000);
    </script>
</head>
<body>
    <div id="chat-container">
        <h1 class="text-3xl font-medium text-center p-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white dark:bg-gradient-to-r dark:from-blue-600 dark:to-indigo-700">Simple Chat</h1>

        <ul id="messages" data-initial-load="true" class="flex-1 overflow-auto p-4 bg-white dark:bg-gray-900">
            <li>loading…</li>
            <template>
                <li class="pending" data-id="">
                    <div class="bubble">
                        <small class="text-xs text-gray-500 dark:text-gray-300">…</small>
                        <span class="block text-base">…</span>
                        <button class="delete-btn text-xs text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" style="display: none;">Delete</button>
                    </div>
                </li>
            </template>
        </ul>

        <form method="post" action="<?= htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8") ?>" class="p-4 bg-white dark:bg-gray-900" aria-label="Chat message form">
            <div class="flex gap-2">
                <input type="text" name="name" placeholder="Your Name" value="Anonymous" class="flex-none w-32 p-2 text-base border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400" aria-label="Your name">
                <textarea name="content" placeholder="Type your message..." class="flex-1 p-2 text-base border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400 resize-none" aria-label="Message input"></textarea>
                <button type="submit" class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700" aria-label="Send message">Send</button>
            </div>
        </form>
    </div>
</body>
</html>