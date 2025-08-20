@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Testimonials</strong> Create
                        </div>
                        <div class="card-body card-block">
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="testimonialForm">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name-input" class=" form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name-input" name="name" placeholder="John Doe" class="form-control">
                                        <span class="text-danger" id="error-name"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="designation-input" class=" form-control-label">Designation</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="designation-input" name="designation" placeholder="Teacher" class="form-control">
                                        <span class="text-danger" id="error-designation"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="message-input" class=" form-control-label">Message</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="message-input" name="message" placeholder="Write review here" class="form-control">
                                        <span class="text-danger" id="error-message"></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="" class="form-control-label">Type</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="select" id="select" class="form-control">
                                            <option value="0" disabled selected>Select Testimonial Type</option>
                                            <option value="live_transformed">Lives Transformed</option>
                                            <option value="success_stories">Success Stories</option>
                                            <option value="readers_say">What Readers Say</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-end align-items-center btn-group">
                            <button type="button" class="btn btn-primary btn-lg" id="save">
                                <i class="fa fa-dot-circle-o"></i> Create
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
        
        // call testimonials.store route via AJAX
        document.querySelector('#save').addEventListener('click', function() {
            // Clear previous errors
            document.getElementById('error-name').textContent = '';
            document.getElementById('error-designation').textContent = '';
            document.getElementById('error-message').textContent = '';

            const formData = new FormData();
            formData.append('name', document.querySelector('input[name="name"]').value);
            formData.append('designation', document.querySelector('input[name="designation"]').value);
            formData.append('message', document.querySelector('input[name="message"]').value);
            formData.append('type', document.querySelector('#select').value);

            fetch('{{ route("testimonials.store") }}', {
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
                    // Show error messages under fields
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
                    } else {
                        alert('Error: ' + data.message);
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    
@endpush