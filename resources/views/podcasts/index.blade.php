@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Podcasts List</strong>
                        <a href="{{ route('podcasts.create') }}" class="btn btn-primary btn-sm float-right">Add Podcast</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Video URL</th>
                                    <th>Published At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($podcasts as $podcast)
                                <tr>
                                    <td>{{ $podcast->title }}</td>
                                    <td>{{ $podcast->slug }}</td>
                                    <td>{{ $podcast->video_url }}</td>
                                    <td>{{ $podcast->published_at }}</td>
                                    <td>
                                        <a href="{{ route('podcasts.show', $podcast->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('podcasts.edit', $podcast->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="deletePodcast({{ $podcast->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $podcasts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deletePodcast(id) {
    if (!confirm('Are you sure you want to delete this podcast?')) return;
    fetch('/podcasts/' + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Failed to delete podcast.');
        }
    });
}
</script>
@endpush
