<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="icon" href="/images/logo.png" type="image/png">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="/js/index.js"></script>
</head>

<body>
    <nav>
        <div>
            <img width="40px" height="40px" src="/images/logo.png" alt="JournalistAI Logo" class="logo">
        </div>
        <a>JournalistAI</a>
        <div class="profile-container">
            <img src="{{ Auth::user()->avatar }}" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="{{ route('edit_profile') }}">Edit</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

            </div>
        </div>
    </nav>

    <div class="midbar">
        <div class="chat-box" id="chats">
            <p class="responses">
            </p>
            <div class="clear-chat-container">
                <button id="clear-chat-btn">
                    <i class="fas fa-trash fa-2x"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="bottomDiv">
        <form id="wordVocabForm" method="post" action="{{ route('prompt') }}">
            @csrf
            <div id="divform">
                <div class="input-container">
                    <label for="wordLimit">Word limit:</label>
                    <input type="number" id="wordLimit" name="word_limit" value="100" min="100" max="300">
                </div>
                <div class="input-container">
                    <label for="translate">Translate:</label>
                    <select id="translate" name="translate">
                        <option value="">No</option>
                        <option value="ur">Urdu</option>
                    </select>
                </div>
                <div class="input-container">
                    <label for="vocab">Vocabulary type:</label>
                    <select id="vocab" name="vocab_type">
                        <option value="easy">Easy</option>
                        <option value="intermediate">Medium</option>
                        <option value="advanced">Expert</option>
                    </select>
                </div>
            </div>

            <div class="input-with-button">
                <input type="text" id="prmpt" name="prompt" placeholder=" Enter your prompt">
                <button id="send-btn" type="submit">
                    <i class="fas fa-paper-plane fa-2x" id="send-icon"></i>
                </button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var userEmail = "{{ Auth::user()->email }}";
            var originalText =
                "I am JournalistAI, a finetuned model of LLama2. I am an artificial intelligence designed to process and generate human-like text based on the input provided to me. I am here to assist you with any questions or tasks you may have to the best of my abilities!";

            function getUserPromptsHistory() {
                var key = 'promptsHistory_' + userEmail;
                return JSON.parse(localStorage.getItem(key)) || [];
            }

            function updateChatHistory() {
                if (localStorage.length === 0) {
                    $('.responses').empty();
                    $('.responses').append('<div>' + originalText + '</div>');
                } else {
                    $('.responses').empty();
                    var promptsHistory = getUserPromptsHistory();
                    promptsHistory.forEach(function(prompt) {
                        $('.responses').append('<div>' + prompt + '</div><hr>');
                    });
                }
            }

            updateChatHistory();

            function clearChatHistory() {
                var userEmail = "{{ Auth::user()->email }}";
                var key = 'promptsHistory_' + userEmail;
                localStorage.removeItem(key);
                updateChatHistory(); // Update UI after clearing history
            }

            // Attach click event handler to clear chat button
            $("#clear-chat-btn").click(function() {
                clearChatHistory();
            });

            $("#send-btn").click(function(e) {
                e.preventDefault();
                var sendIcon = $("#send-icon");
                sendIcon.removeClass("fa-paper-plane").addClass("fa-spinner fa-spin");

                // Get form data
                var formData = $("#wordVocabForm").serialize();
                // Make AJAX request
                $.ajax({
                    url: $("#wordVocabForm").attr("action"),
                    type: "post",
                    data: formData,
                    success: function(data) {
                        // Add new prompt to history
                        var promptsHistory = getUserPromptsHistory();
                        promptsHistory.push(data);
                        // Limit the history to 10 prompts
                        if (promptsHistory.length > 10) {
                            promptsHistory.shift();
                        }
                        var key = 'promptsHistory_' + userEmail;
                        localStorage.setItem(key, JSON.stringify(promptsHistory));
                        updateChatHistory();
                        sendIcon.removeClass("fa-spinner fa-spin").addClass("fa-paper-plane");
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        sendIcon.removeClass("fa-spinner fa-spin").addClass("fa-paper-plane");
                    }
                });
            });
        });
    </script>

</body>

</html>
