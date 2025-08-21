@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Testimonials</strong> Edit
                        </div>
                        <div class="card-body card-block">
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="testimonialForm">
                                @csrf
                                @method('PUT')

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name-input" class="form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name-input" name="name" 
                                               value="{{ $testimonial->name }}" 
                                               class="form-control">
                                        <span class="text-danger" id="error-name"></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="designation-input" class="form-control-label">Designation</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="designation-input" name="designation" 
                                               value="{{ $testimonial->designation }}" 
                                               class="form-control">
                                        <span class="text-danger" id="error-designation"></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="message-input" class="form-control-label">Message</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="message-input" name="message" 
                                               value="{{ $testimonial->message }}" 
                                               class="form-control">
                                        <span class="text-danger" id="error-message"></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class="form-control-label">Type</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="type" id="select" class="form-control">
                                            <option value="0" disabled>Select Testimonial Type</option>
                                            <option value="live_transformed" {{ $testimonial->type == 'live_transformed' ? 'selected' : '' }}>Lives Transformed</option>
                                            <option value="success_stories" {{ $testimonial->type == 'success_stories' ? 'selected' : '' }}>Success Stories</option>
                                            <option value="readers_say" {{ $testimonial->type == 'readers_say' ? 'selected' : '' }}>What Readers Say</option>
                                        </select>
                                        <span class="text-danger" id="error-type"></span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer d-flex justify-content-end align-items-center btn-group">
                            <button type="button" class="btn btn-primary btn-lg" id="update">
                                <i class="fa fa-check-circle"></i> Update
                            </button>
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
        // Clear previous errors
        document.getElementById('error-name').textContent = '';
        document.getElementById('error-designation').textContent = '';
        document.getElementById('error-message').textContent = '';
        document.getElementById('error-type').textContent = '';

        const formData = new FormData();
        formData.append('name', document.querySelector('input[name="name"]').value);
        formData.append('designation', document.querySelector('input[name="designation"]').value);
        formData.append('message', document.querySelector('input[name="message"]').value);
        formData.append('type', document.querySelector('#select').value);
        formData.append('_method', 'PUT'); // important for Laravel

        fetch('{{ route("testimonials.update", $testimonial->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = '{{ route("testimonials.index") }}';
            } else {
                if (data.errors) {
                    if (data.errors.name) {
                        document.getElementById('error-name').textContent = data.errors.name[0];
                    }
                    if (data.errors.designation) {
                        document.getElementById('error-designation').textContent = data.errors.designation[0];
                    }
                    if (data.errors.message) {
                        document.getElementById('error-message').textContent = data.errors.message[0];
                    }
                    if (data.errors.type) {
                        document.getElementById('error-type').textContent = data.errors.type[0];
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endpush
