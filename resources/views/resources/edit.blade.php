@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Edit Blog</strong>
                        </div>
                        <div id="response-message" class="mb-3"></div>
                        <div class="card-body card-block">
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="editBlogForm">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="title-input" class="form-control-label">Blog Title</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="title-input" name="title" value="{{ $blog->title }}" class="form-control">
                                        <span class="text-danger" id="error-title"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="content-input" class="form-control-label">Content</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="content-input" name="content" class="form-control">{{ $blog->content }}</textarea>
                                        <span class="text-danger" id="error-content"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="author-input" class="form-control-label">Author</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="author-input" name="author" value="{{ $blog->author }}" class="form-control">
                                        <span class="text-danger" id="error-author"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="slug-input" class="form-control-label">Slug</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="slug-input" name="slug" value="{{ $blog->slug }}" class="form-control">
                                        <span class="text-danger" id="error-slug"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="published-input" class="form-control-label">Published</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id="published-input" name="published" class="form-control">
                                            <option value="0" {{ !$blog->published ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ $blog->published ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        <span class="text-danger" id="error-published"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="image-input" class="form-control-label">Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        @if($blog->image)
                                            <img src="{{ asset('storage/' . $blog->image) }}" style="width:50px;height:50px;">
                                        @endif
                                        <input type="file" id="image-input" name="image" class="form-control-file">
                                        <span class="text-danger" id="error-image"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-end align-items-center btn-group">
                            <button type="button" class="btn btn-secondary btn-lg" id="update">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <span id="loader" style="display:none; margin-left:10px;">
                                <i class="fa fa-spinner fa-spin fa-2x"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.querySelector('#update').addEventListener('click', function() {
    document.getElementById('loader').style.display = 'inline-block';
    document.getElementById('error-title').textContent = '';
    document.getElementById('error-content').textContent = '';
    document.getElementById('error-author').textContent = '';
    document.getElementById('error-slug').textContent = '';
    document.getElementById('error-published').textContent = '';
    document.getElementById('error-image').textContent = '';
    document.getElementById('response-message').textContent = '';

    const formData = new FormData();
    formData.append('title', document.querySelector('input[name="title"]').value);
    formData.append('content', document.querySelector('textarea[name="content"]').value);
    formData.append('author', document.querySelector('input[name="author"]').value);
    formData.append('slug', document.querySelector('input[name="slug"]').value);
    formData.append('published', document.querySelector('#published-input').value);
    const imageInput = document.querySelector('input[name="image"]');
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    }
    formData.append('_method', 'PUT');

    fetch('{{ route("blog.update", $blog->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('loader').style.display = 'none';
        if (data.success) {
            document.getElementById('response-message').textContent = data.message;
            document.getElementById('response-message').className = 'alert alert-success mb-3';
            setTimeout(function() {
                window.location.href = '{{ route("blog.index") }}';
            }, 1500);
        } else {
            if (data.errors) {
                if (data.errors.title) document.getElementById('error-title').textContent = data.errors.title[0];
                if (data.errors.content) document.getElementById('error-content').textContent = data.errors.content[0];
                if (data.errors.author) document.getElementById('error-author').textContent = data.errors.author[0];
                if (data.errors.slug) document.getElementById('error-slug').textContent = data.errors.slug[0];
                if (data.errors.published) document.getElementById('error-published').textContent = data.errors.published[0];
                if (data.errors.image) document.getElementById('error-image').textContent = data.errors.image[0];
            }
            if (data.message) {
                document.getElementById('response-message').textContent = data.message;
                document.getElementById('response-message').className = 'alert alert-danger mb-3';
            }
        }
    })
    .catch(error => {
        document.getElementById('loader').style.display = 'none';
        document.getElementById('response-message').textContent = 'An error occurred. Please try again.';
        document.getElementById('response-message').className = 'alert alert-danger mb-3';
        console.error('Error:', error);
    });
});
</script>
@endpush
