<meta name="csrf-token" content="{{ csrf_token() }}">

<header>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="header-container">
        <div class="header-wrapper">
            <div class="logoBox">
                <span>UniAds</span>
            </div>

            <div class="searchBox">
                <input type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </div>

            <div class="iconBox1">
                <a href="{{ url('/feed') }}"><i class="fa fa-home"></i></a>
                <a href="{{ url('/institutions') }}"><i class="fa fa-building"></i></a>
                <a href="{{ url('/courses') }}"><i class="fa fa-graduation-cap"></i></a>
                <div id="notification-bell">
                    <button>
                        <i class="fa fa-bell"></i>
                        <span id="notification-count">0</span>
                    </button>
                    <div id="notifications-dropdown">
                        <ul id="notifications-list"></ul>
                    </div>
                </div>
                <!-- New Message Icon -->
                <div id="message-icon">
                    <button onclick="openChatModal()">

                    <i class="fa fa-comments"></i>
                </button>
                
                </div>
            </div>
            

            <div class="nav-icons">
                <div class="profile-dropdown">
                    <button onclick="toggleDropdown()" class="profile-btn">
                        <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? Auth::user()->institute->profile_photo ?? 'default-avatar.png')) }}" alt="Profile Picture" id="profile-preview" class="profile-img">

                        <span class="username">{{ Auth::user()->name }}</span>
                    </button>
                    <div id="dropdown-menu" class="dropdown-content">
                        <a href="{{ route('profile.edit') }}">Profile Management</a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-link">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
<!-- Chat Modal -->
<!-- Chat Modal -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="chatModal" class="chat-modal">
    <div class="chat-modal-content">
        <!-- Header -->
        <div id="chatHeader" class="chat-header">
            Chat with <span id="selectedInstituteName">Select an Institute</span>
            <button class="close-modal" onclick="closeChatModal()">×</button>
        </div>

        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Sidebar: Approved Institutes -->
            @if(auth()->user()->role == 'User')
            <div class="chat-sidebar">
                <h4>Approved Institutes</h4>
                <ul id="chatSidebar">
                    @foreach($institutes as $institute)
                    <li id="institute-{{ $institute->id }}" 
                        onclick="selectInstitute({{ $institute->id }}, '{{ $institute->institute_name }}')">
                        {{ $institute->institute_name }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Chat Body -->
            <div class="chat-body">
                <div id="chatMessages" class="chat-messages">
                    <p>Select an institute to start chatting.</p>
                </div>
                <div class="chat-input">
                    <input id="chatInput" type="text" placeholder="Type a message..." />
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>






<script>


let selectedInstituteId = null;
let currentChatId = null;

function openChatModal() {
    document.getElementById('chatModal').style.display = 'block';
}

function closeChatModal() {
    document.getElementById('chatModal').style.display = 'none';
}

function selectInstitute(instituteId, instituteName) {
    document.querySelectorAll("#chatSidebar li").forEach(li => li.classList.remove("selected"));
    document.getElementById(`institute-${instituteId}`).classList.add("selected");

    document.getElementById("chatHeader").textContent = `Chat with ${instituteName}`;
    selectedInstituteId = instituteId;

    // Get chat ID and load messages
    loadMessages();
}

function loadMessages() {
    if (!selectedInstituteId) return;

    const chatMessages = document.getElementById("chatMessages");
    chatMessages.innerHTML = "Loading messages...";

    fetch(`/get-messages/${selectedInstituteId}`)
        .then(response => response.json())
        .then(data => {
            chatMessages.innerHTML = '';  // Clear existing messages
            data.messages.forEach(message => {
                const msgDiv = document.createElement('div');
                msgDiv.classList.add(message.sender_id === {{ Auth::id() }} ? 'sent-message' : 'received-message');
                msgDiv.textContent = message.message;
                chatMessages.appendChild(msgDiv);
            });
        });
}

function sendMessage() {
    const messageInput = document.getElementById("chatInput");
    const message = messageInput.value.trim();

    if (!message || !selectedInstituteId) {
        alert("Please select an institute and type a message.");
        return;
    }

    fetch('/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            receiver_id: selectedInstituteId,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        messageInput.value = '';  // Clear input
        loadMessages();  // Reload chat messages
    })
    .catch(error => {
        console.error("Error sending message:", error);
    });
}


</script>




</header>


