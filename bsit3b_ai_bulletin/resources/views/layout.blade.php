<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  
  <link rel="stylesheet" href="{{ asset('template.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
  @yield('css')
</head>

<body>
  <div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="Logo">
        <h2>BSIT 3B</h2>
      </div>

      <nav>
        <ul>
          <a href="/"><li @yield('home_active')><i class="ri-home-4-line"></i> Home</li></a>
          <a href="/courses"><li @yield('courses_active')><i class="ri-book-line"></i> Courses</li></a>
          <a href="/announcements"><li @yield('announcement_active')><i class="ri-megaphone-line"></i> Announcements</li></a>
          <a href="/contactus"><li @yield('contactus_active')><i class="ri-contacts-line"></i> Contact Us</li></a>
          <br><br><br>
        </ul>
      </nav>
      
      <div class="mode-toggle">
        <button id="mode-toggle" class="mode-btn"><i class="ri-moon-fill"></i></button>
      </div>

    </aside>

    <!-- Main Content -->
    <main class="main">
      @yield('content')
    </main>
    
  </div>

  <!-- Chatbot Button -->
  <div id="chatbot-icon">
    <i class="ri-chat-3-line"></i>
  </div>

  <!-- Chatbot Window -->
  <div id="chatbot-window">
    <div class="chat-header">
      <h3>Buzzee</h3>
    </div>

    <div class="chat-body" id="chat-body">
      <div class="bot-message">👋 Hi there! How can I help you today?</div>
    </div>

    <div class="chat-input">
      <input type="text" id="user-input" placeholder="Type your message..." />
      <button id="send-btn">Send</button>
    </div>
  </div>
</body>


<script>
  const modeToggle = document.getElementById('mode-toggle');
  const body = document.body;

  const chatIcon = document.getElementById("chatbot-icon");
  const chatWindow = document.getElementById("chatbot-window");
  const chatBody = document.getElementById("chat-body");
  const userInput = document.getElementById("user-input");
  const sendBtn = document.getElementById("send-btn");

  if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    modeToggle.innerHTML = '<i class="ri-sun-line"></i>';
  }

  modeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
      modeToggle.innerHTML = '<i class="ri-sun-line"></i>';
      localStorage.setItem('theme', 'dark');
    } else {
      modeToggle.innerHTML = '<i class="ri-moon-fill"></i>';
      localStorage.setItem('theme', 'light');
    }
  });

// Show chat window
  chatIcon.addEventListener("click", () => {
    if (chatWindow.style.display === "flex") {
      chatWindow.style.display = "none";
      chatIcon.innerHTML = '<i class="ri-chat-3-line"></i>';
    } else {
      chatWindow.style.display = "flex";
      chatIcon.innerHTML = '<i class="ri-close-line"></i>';
    }
  });

// Send message
  sendBtn.addEventListener("click", sendMessage);
  userInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") sendMessage();
  });

  let chatHistory = [
    { role: "system", content: "You are a helpful AI assistant for the dashboard." }
  ];

  async function sendMessage() {
  const message = userInput.value.trim();
  if (message === "") return;

  // Display user message
  const userMsg = document.createElement("div");
  userMsg.classList.add("user-message");
  userMsg.textContent = message;
  chatBody.appendChild(userMsg);
  userInput.value = "";
  chatBody.scrollTop = chatBody.scrollHeight;

  // Typing indicator
  const typingMsg = document.createElement("div");
  typingMsg.classList.add("bot-message", "typing");
  typingMsg.textContent = "Buzzee is typing...";
  chatBody.appendChild(typingMsg);
  chatBody.scrollTop = chatBody.scrollHeight;

  // Send message to Laravel backend
  fetch("http://127.0.0.1:8000/chat", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
    body: JSON.stringify({ message }),
  })
    .then((res) => res.json())
    .then((data) => {
      // Remove typing indicator
      typingMsg.remove();

      // Display bot response
      const botMsg = document.createElement("div");
      botMsg.classList.add("bot-message");
      botMsg.textContent = data.reply || data.message || "No response.";
      chatBody.appendChild(botMsg);
      chatBody.scrollTop = chatBody.scrollHeight;
    })
    .catch((error) => {
      console.error("Error:", error);

      typingMsg.remove();

      const botMsg = document.createElement("div");
      botMsg.classList.add("bot-message");
      botMsg.textContent = "Failed to connect to AI server.";
      chatBody.appendChild(botMsg);
    });
}

</script>
</html>