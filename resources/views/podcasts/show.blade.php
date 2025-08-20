@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <strong>Podcast Details</strong>
                        <a href="{{ route('podcasts.edit', $podcast->id) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Title</dt>
                            <dd class="col-sm-8">{{ $podcast->title }}</dd>
                            <dt class="col-sm-4">Slug</dt>
                            <dd class="col-sm-8">{{ $podcast->slug }}</dd>
                            <dt class="col-sm-4">Thumbnail</dt>
                            <dd class="col-sm-8">{{ $podcast->thumbnail }}</dd>
                            <dt class="col-sm-4">Video URL</dt>
                            <dd class="col-sm-8">{{ $podcast->video_url }}</dd>
                            <dt class="col-sm-4">Description</dt>
                            <dd class="col-sm-8">{{ $podcast->description }}</dd>
                            <dt class="col-sm-4">Published At</dt>
                            <dd class="col-sm-8">{{ $podcast->published_at }}</dd>
                            <dt class="col-sm-4">Duration</dt>
                            <dd class="col-sm-8">{{ $podcast->duration }}</dd>
                            <dt class="col-sm-4">Is Latest</dt>
                            <dd class="col-sm-8">{{ $podcast->is_latest ? 'Yes' : 'No' }}</dd>
                        </dl>
                        <a href="{{ route('podcasts.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
