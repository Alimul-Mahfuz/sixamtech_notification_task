@extends('layouts._layout')
@section('title')
    Notification List
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-12">
            <h3 class="mb-4">📬 Notifications</h3>
        </div>
    </div>

    <div class="row">
        @forelse($notifications as $notification)
            <div class="col-12 mb-4">
                <div class="card shadow-sm border-0 {{ $notification->read ? 'bg-light' : 'bg-white' }}">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $notification->title }}</h5>
                        <p class="card-text">{{ $notification->description }}</p>
                        <small class="text-muted">
                            From: {{ $notification->sender->name }} <br>
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                        @if(!$notification->read)
                            <form action="{{route('notification.markAsRead',["id"=>$notification->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-success">Mark as read</button>
                            </form>
                        @else
                            <span class="badge bg-success">Read</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No notifications yet.
                </div>
            </div>
        @endforelse
        <div class="col-12">
            {{$notifications->links()}}
        </div>
    </div>
@endsection
