<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/index.js"></script>
</head>

<body>
    <nav>
        <div class="hamburger-menu" onclick="toggleSidebar()">
            &#9776;
        </div>
        <a href="#">Content Generator</a>

        <div class="profile-container">
            <img src="/images/ppic.png" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="editprofile.blade.php">Edit</a>
                <a href="#"Logout>Logout</a>
                
            </div>
        </div>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <div class="sidebar" id="sidebar">
        <a href="dashboard.html">Dashboard</a>
        <a href="settings.html">Settings</a>
        <a href="contact-us.html">Contact Us</a>
    </div>

    <div class="midbar">
        <div class="chat-box" id="chats">
            I am JournalistAI, a finetuned model of LLama2. I am an artificial intelligence designed to
            process and generate human-like text based on the input provided to me. I am here to assist you with any
            questions or tasks you may have to the best of my abilities!
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
                <button id="send-btn">
                    <img src="/images/send-message.png" alt="Send Button">
                </button> 
                <!--  <img src="/images/dm.png" alt="send btn" id="send-btn"> -->
                
                <!-- <input type="button" id="btn" value="->" > 
                <img src="/images/send.png" alt="Profile Picture" he> -->
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load previous prompts from local storage
            var promptsHistory = JSON.parse(localStorage.getItem('promptsHistory')) || [];

            // Function to update chat history
            function updateChatHistory() {
                $('#chats').empty();
                promptsHistory.forEach(function (prompt) {
                    $('#chats').append('<div>' + prompt + '</div><hr>');
                });
            }

            // Initial update
            updateChatHistory();

            // Click event for generating new prompt
            $("#btn").click(function (e) {
                e.preventDefault();
                $("#btn").val("■");
                // Get form data
                var formData = $("#wordVocabForm").serialize();
                // Make AJAX request
                $.ajax({
                    url: $("#wordVocabForm").attr("action"),
                    type: "post",
                    data: formData,
                    success: function (data) {
                        // Add new prompt to history
                        promptsHistory.push(data);
                        // Limit the history to 10 prompts
                        if (promptsHistory.length > 10) {
                            promptsHistory.shift(); // Remove the oldest prompt
                        }
                        // Update local storage
                        localStorage.setItem('promptsHistory', JSON.stringify(promptsHistory));
                        // Update chat history display
                        updateChatHistory();
                        $("#btn").val("->");
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        $("#btn").val("->");
                    }
                });
            });
        });

        
    </script>
</body>

</html>
