@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Audit Logs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Event</th>
                <th>Auditable Type</th>
                <th>Auditable ID</th>
                <th>Timestamp</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->id }}</td>
                <td>{{ optional($audit->user)->name }}</td>
                <td>{{ $audit->event }}</td>
                <td>{{ $audit->auditable_type }}</td>
                <td>{{ $audit->auditable_id }}</td>
                <td>{{ $audit->created_at }}</td>
                <td>
                    <a href="{{ route('audits.show', $audit->id) }}" class="btn btn-primary btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $audits->links() }}
</div>
@endsection
