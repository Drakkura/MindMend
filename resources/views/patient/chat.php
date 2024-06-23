<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chatify Styles -->
    <link href="{{ asset('css/chatify.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Contacts</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <!-- List of contacts will be populated by Chatify -->
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Chat</h4>
                    </div>
                    <div class="card-body chat-body">
                        <!-- Chat messages will be populated by Chatify -->
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="send-btn">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pubble Chatify App -->
    <div class="pubble-app" data-app-id="126604" data-app-identifier="126604"></div>
    <script type="text/javascript" src="https://cdn.chatify.com/javascript/loader.js" defer></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Chatify Script -->
    <script src="{{ asset('js/chatify.js') }}"></script>
</body>
</html>
