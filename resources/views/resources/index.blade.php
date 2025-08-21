@extends('layouts.admin')

@section('content')

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Blogs</strong>
                        </div>
                        <div class="card-body card-block">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>description</th>
                                        <th>Author</th>
                                        <th>Published At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>
                                                @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="Blog Image" style="width: 50px; height: 50px;">

                                                    {{-- <img src="{{asset('images') . '/' . $blog->image}}" alt="Blog Image" style="width: 50px; height: 50px;"> --}}
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->slug }}</td>
                                            <td>{{ Str::limit($blog->content, 100) }}</td>
                                            <td>{{ $blog->author }}</td>
                                            <td>
                                                @if($blog->published_at)
                                                    @php
                                                        $publishedAt = \Carbon\Carbon::parse($blog->published_at);
                                                    @endphp
                                                    {{ $publishedAt->format('d M Y h:i A') }}
                                                @else
                                                    Draft
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <button class="btn btn-sm btn-danger delete-blog" data-id="{{ $blog->id }}">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $blogs->links() }} <!-- Pagination links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.delete-blog').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (!confirm('Are you sure you want to delete this blog?')) return;
        const id = this.getAttribute('data-id');
        fetch('{{ url("/blog") }}/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Delete failed');
            }
        });
    });
});
</script>
@endpush