@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Audit Details</h1>
    <ul>
        <li><strong>ID:</strong> {{ $audit->id }}</li>
        <li><strong>User:</strong> {{ optional($audit->user)->name }}</li>
        <li><strong>Event:</strong> {{ $audit->event }}</li>
        <li><strong>Auditable Type:</strong> {{ $audit->auditable_type }}</li>
        <li><strong>Auditable ID:</strong> {{ $audit->auditable_id }}</li>
        <li><strong>Old Values:</strong> {{ json_encode($audit->old_values) }}</li>
        <li><strong>New Values:</strong> {{ json_encode($audit->new_values) }}</li>
        <li><strong>URL:</strong> {{ $audit->url }}</li>
        <li><strong>IP Address:</strong> {{ $audit->ip_address }}</li>
        <li><strong>User Agent:</strong> {{ $audit->user_agent }}</li>
        <li><strong>Tags:</strong> {{ $audit->tags }}</li>
        <li><strong>Created At:</strong> {{ $audit->created_at }}</li>
    </ul>
    <a href="{{ route('audits.index') }}" class="btn btn-secondary">Back to Audit Logs</a>
</div>
@endsection
