@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Podcast</strong>
                    </div>
                    <div id="response-message" class="mb-3"></div>
                    <div class="card-body card-block">
                        <form id="podcastForm" class="form-horizontal" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="title" class="form-control-label">Title</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="title" name="title" class="form-control">
                                    <span class="text-danger" id="error-title"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="slug" class="form-control-label">Slug</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="slug" name="slug" class="form-control">
                                    <span class="text-danger" id="error-slug"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="thumbnail" class="form-control-label">Thumbnail URL</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                    <span class="text-danger" id="error-thumbnail"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="video_url" class="form-control-label">Video URL</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="video_url" name="video_url" class="form-control">
                                    <span class="text-danger" id="error-video_url"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="description" class="form-control-label">Description</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                    <span class="text-danger" id="error-description"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="published_at" class="form-control-label">Published At</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="published_at" name="published_at" class="form-control">
                                    <span class="text-danger" id="error-published_at"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="duration" class="form-control-label">Duration (minutes)</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="duration" name="duration" class="form-control">
                                    <span class="text-danger" id="error-duration"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="is_latest" class="form-control-label">Is Latest?</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="checkbox" id="is_latest" name="is_latest" value="1">
                                    <span class="text-danger" id="error-is_latest"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-center btn-group">
                        <button type="button" class="btn btn-primary btn-lg" id="save">
                            <i class="fa fa-dot-circle-o"></i> Create
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
    document.querySelector('#save').addEventListener('click', function() {
        document.getElementById('loader').style.display = 'inline-block';
        // Clear previous errors
        document.getElementById('error-title').textContent = '';
        document.getElementById('error-slug').textContent = '';
        document.getElementById('error-thumbnail').textContent = '';
        document.getElementById('error-video_url').textContent = '';
        document.getElementById('error-description').textContent = '';
        document.getElementById('error-published_at').textContent = '';
        document.getElementById('error-duration').textContent = '';
        document.getElementById('error-is_latest').textContent = '';
        document.getElementById('response-message').textContent = '';

        const formData = new FormData();
        formData.append('title', document.querySelector('input[name="title"]').value);
        formData.append('slug', document.querySelector('input[name="slug"]').value);
        formData.append('thumbnail', document.querySelector('input[name="thumbnail"]').value);
        formData.append('video_url', document.querySelector('input[name="video_url"]').value);
        formData.append('description', document.querySelector('textarea[name="description"]').value);
        formData.append('published_at', document.querySelector('input[name="published_at"]').value);
        formData.append('duration', document.querySelector('input[name="duration"]').value);
        formData.append('is_latest', document.querySelector('input[name="is_latest"]').checked ? 1 : 0);

        fetch('{{ route("podcasts.store") }}', {
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
                // Empty form fields
                document.querySelector('input[name="title"]').value = '';
                document.querySelector('input[name="slug"]').value = '';
                document.querySelector('input[name="thumbnail"]').value = '';
                document.querySelector('input[name="video_url"]').value = '';
                document.querySelector('textarea[name="description"]').value = '';
                document.querySelector('input[name="published_at"]').value = '';
                document.querySelector('input[name="duration"]').value = '';
                document.querySelector('input[name="is_latest"]').checked = false;
                setTimeout(function() {
                    window.location.href = '{{ route("podcasts.index") }}';
                }, 1500);
            } else {
                if (data.errors) {
                    if (data.errors.title) {
                        document.getElementById('error-title').textContent = data.errors.title[0];
                    }
                    if (data.errors.slug) {
                        document.getElementById('error-slug').textContent = data.errors.slug[0];
                    }
                    if (data.errors.thumbnail) {
                        document.getElementById('error-thumbnail').textContent = data.errors.thumbnail[0];
                    }
                    if (data.errors.video_url) {
                        document.getElementById('error-video_url').textContent = data.errors.video_url[0];
                    }
                    if (data.errors.description) {
                        document.getElementById('error-description').textContent = data.errors.description[0];
                    }
                    if (data.errors.published_at) {
                        document.getElementById('error-published_at').textContent = data.errors.published_at[0];
                    }
                    if (data.errors.duration) {
                        document.getElementById('error-duration').textContent = data.errors.duration[0];
                    }
                    if (data.errors.is_latest) {
                        document.getElementById('error-is_latest').textContent = data.errors.is_latest[0];
                    }
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
