@extends('layouts.app')

@section('content')
<style>
    /* Container for the entire chat section */
    .chat-container {
        max-width: 800px; /* Set a max-width for the container */
        margin: 0 auto; /* Center horizontally */
    }

    /* Basic styles for message cards */
    #message-list .card {
        border-radius: 15px;
        max-width: 100%; /* Ensure cards don’t exceed their container */
    }

    #message-list .card-header {
        border-bottom: none;
        display: none; /* Hide the card header */
    }

    #message-list li {
        display: flex;
        margin-bottom: 1rem;
        width: 100%;
    }

    #message-list li.justify-content-end .card {
        background-color: #e0f7fa; /* Light cyan for sender messages */
        align-self: flex-end;
    }

    #message-list li.justify-content-start .card {
        background-color: #ffffff; /* White for receiver messages */
        align-self: flex-start;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #message-list .card {
            border-radius: 10px;
        }

        #message-list li {
            margin-bottom: 0.5rem;
        }

        #message-list .card-body {
            font-size: 0.875rem; /* Slightly smaller text for smaller screens */
        }

        /* Ensure the message input area and send button are full-width on small screens */
        #send-message-form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center form elements horizontally */
        }

        #message-input {
            width: 100%;
        }

        #send-message-form button {
            width: 100%;
            margin-top: 0.5rem;
        }
    }

    @media (min-width: 769px) {
        #message-list .card {
            max-width: 75%; /* Limit the width of message cards on larger screens */
        }

        #send-message-form {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center; /* Center form elements horizontally on larger screens */
        }

        #message-input {
            flex: 1;
            margin-right: 0.5rem;
        }

        #send-message-form button {
            flex-shrink: 0;
        }
    }
</style>

<div class="container py-5">
Chat with <a href="{{ url("/profileU/{$receiver->id}") }}" class="text-success text-decoration-none">{{ $receiver->name }}</a>
    <div class="chat-container">
        
        <div class="row">
            <div class="col-md-12">
                <ul id="message-list" class="list-unstyled">
                    @foreach($messages as $message)
                        <li class="d-flex mb-4 @if($message->sender_id == Auth::id()) justify-content-end @else justify-content-start @endif">
                            <div class="card w-75">
                                <div class="card-body">
                                    <p class="fw-bold mb-1">
                                        @if($message->sender_id == Auth::id())
                                            You
                                        @else
                                        <img src="{{ $receiver->avatar ? '/avatars/' . $receiver->avatar : 'https://via.placeholder.com/150' }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px;">
                                        <a href="{{ url("/profileU/{$receiver->id}") }}" class="text-success text-decoration-none"> <b>{{ $receiver->name }}</b></a>
                                        @endif
                                    </p>
                                    <p class="mb-0">{{ $message->message }}</p>
                                    <p class="text-muted small mb-0 text-end"><i class="far fa-clock"></i> {{ $message->created_at->format('H:i') }}
                                    <a href="{{ url("/chat/delete/$message->id") }}"
                   class="bi bi-trash float-end" aria-label="Delete"
                   style="font-size: 1.5rem; text-decoration: none; color: red;">
                </a></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <form id="send-message-form" method="POST" action="{{ route('send.message') }}">
                    @csrf
                    <div class="form-outline mb-3">
                        <textarea id="message-input" name="message" class="form-control" rows="2" placeholder="Type your message here" required></textarea>
                    </div>
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <button type="submit" class="btn btn-info btn-rounded">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function markMessagesAsRead(receiverId) {
        fetch(`{{ url('/mark-messages-as-read') }}/${receiverId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Messages marked as read.');
                updateUnreadCount(); // Update the unread count after marking as read
            } else {
                console.error('Failed to mark messages as read.');
            }
        })
        .catch(error => console.error('Error marking messages as read:', error));
    }

    function updateUnreadCount() {
        fetch('{{ route('unread.count') }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('unread-count');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('d-none');
                } else {
                    badge.textContent = '0';
                    badge.classList.add('d-none');
                }
            })
            .catch(error => console.error('Error fetching unread count:', error));
    }

    // Get receiver ID from the Blade template
    const receiverId = '{{ $receiver->id }}';
    if (receiverId) {
        markMessagesAsRead(receiverId);
    }
});
</script>
@endsection
