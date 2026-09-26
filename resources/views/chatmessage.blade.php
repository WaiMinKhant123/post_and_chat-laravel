@extends('layouts.app')

@section('content')
<style>
    .chat-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Message list and card styling */
    #message-list {
        max-height: 500px;
        overflow-y: auto;
        padding: 10px;
    }

    #message-list .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        max-width: 100%;
    }

    #message-list .card-header {
        border-bottom: none;
        display: none;
    }

    #message-list li {
        display: flex;
        margin-bottom: 1rem;
        width: 100%;
    }

    /* Sender messages (Right side - Light Cyan) */
    #message-list li.justify-content-end .card {
        background-color: #e3f2fd; 
        align-self: flex-end;
    }

    /* Receiver messages (Left side - Clean White) */
    #message-list li.justify-content-start .card {
        background-color: #ffffff; 
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
            font-size: 0.875rem;
        }
        #send-message-form {
            display: flex;
            flex-direction: column;
            align-items: center;
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
            max-width: 75%;
        }
        #send-message-form {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
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

<div class="container py-4">
    <div class="d-flex align-items-center mb-3">
        <h5 class="mb-0 text-muted">Chat with 
            <a href="{{ url("/profileU/{$receiver->id}") }}" class="text-success text-decoration-none fw-bold">
                {{ $receiver->name }}
            </a>
        </h5>
    </div>

    <div class="chat-container">
        <div class="row">
            <div class="col-md-12">
                
                <!-- Message List -->
                <ul id="message-list" class="list-unstyled">
    @foreach($messages as $message)
        <li class="d-flex mb-3 @if($message->sender_id == Auth::id()) justify-content-end @else justify-content-start @endif">
            <div class="card w-75 shadow-sm">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center mb-1">
                        @if($message->sender_id != Auth::id())
                            <!-- Cloudinary Receiver Avatar -->
                            <img src="{{ $receiver->avatar ? $receiver->avatar : 'https://via.placeholder.com/150' }}" 
                                 alt="Profile Image" 
                                 class="rounded-circle me-2" 
                                 style="width: 35px; height: 35px; object-fit: cover;">
                            <a href="{{ url("/profileU/{$receiver->id}") }}" class="text-success text-decoration-none fw-bold small">
                                {{ $receiver->name }}
                            </a>
                        @else
                            <span class="fw-bold text-primary small">You</span>
                        @endif
                    </div>

                    <p class="mb-1 text-dark" style="word-break: break-word;">{{ $message->message }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">
                            <i class="far fa-clock"></i> {{ $message->created_at->format('H:i') }}
                        </span>
                        <a href="{{ url("/chat/delete/$message->id") }}" 
                           class="bi bi-trash text-danger" 
                           aria-label="Delete" 
                           style="font-size: 1rem; text-decoration: none;"
                           onclick="return confirm('Are you sure you want to delete this message?');">
                        </a>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

                <!-- Send Message Form -->
                <form id="send-message-form" method="POST" action="{{ route('send.message') }}" class="mt-3">
                    @csrf
                    <div class="form-outline flex-grow-1 mb-2 mb-md-0">
                        <textarea id="message-input" name="message" class="form-control" rows="2" placeholder="Type your message here..." required></textarea>
                    </div>
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <button type="submit" class="btn btn-success btn-rounded px-4 py-2">
                        <i class="bi bi-send"></i> Send
                    </button>
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
                updateUnreadCount();
            }
        })
        .catch(error => console.error('Error marking messages as read:', error));
    }

    function updateUnreadCount() {
        fetch('{{ route('unread.count') }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('unread-count');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('d-none');
                    } else {
                        badge.textContent = '0';
                        badge.classList.add('d-none');
                    }
                }
            })
            .catch(error => console.error('Error fetching unread count:', error));
    }

    const receiverId = '{{ $receiver->id }}';
    if (receiverId) {
        markMessagesAsRead(receiverId);
    }
});
</script>
@endsection