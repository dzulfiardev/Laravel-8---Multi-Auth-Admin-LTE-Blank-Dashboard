@extends('templates/main/main')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if (session('status'))
      <div id="alertSuccess" class="alert alert-success mx-3 mt-3">{{ session('status') }}</div>
      <script>
        setTimeout(() => {
          $('#alertSuccess').fadeOut(300, () => {
            $('#alertSuccess').remove()
          })
        }, 3500)
      </script>
    @endif

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ url('profile/update', $profile->userid) }}" method="post" class="form-horizontal"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
            {{-- Photo Card --}}
            <div class="col-md-4">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img id="imageUpload" class="profile-user-img img-fluid img-circle"
                      src="{{ url('image') }}/profile/{{ $profile->image }}" alt="User profile picture"
                      style="width:200px;height:200px;object-fit:cover;object-position:center">
                  </div>

                  <h3 class=" profile-username text-center">{{ $profile->fullname }}</h3>

                  <p class="text-muted text-center">{{ $profile->display_name }}</p>

                </div>
                <!-- /.card-body -->
              </div>
            </div>

            <div class="col-md-7">
              <div class="card">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Name" value="{{ $profile->fullname }}">
                      @error('name')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Email" value="{{ $profile->email }}">
                      @error('email')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-3">
                      <label for="uploadImage">Upload Photo</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="uploadImage" style="cursor:pointer">
                        <label id="uploadImageLabel" class="custom-file-label" for="uploadImage">Choose file</label>
                      </div>
                      <small id="errorUpload" class="text-danger"></small>
                      @error('image')
                        <small id="errorUpload2" class="text-danger">{{ $message }}</small>
                        <script>
                          setTimeout(() => {
                            $('#errorUpload2').remove()
                          }, 3500)
                        </script>
                      @enderror
                    </div>
                  </div>

                  {{-- Hidden Input --}}
                  <input type="hidden" name="image_old" value="{{ $profile->image }}">

                  <div class="form-group row">
                    <div class="offset-sm-3 col-sm-9">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- End Row --}}
        </form>
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    $(document).ready(function() {

      // Upload Image Preview
      $('#uploadImage').change(function(e) {
        const filePath = e.target.value
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i

        // File Validation
        if (!allowedExtensions.exec(filePath)) {
          $('#errorUpload').html('Please upload file having extensions .jpg .jpeg .png')
          e.target.value = ''
          setTimeout(() => {
            $('#errorUpload').html('')
          }, 4000)

        } else {
          let file = e.target.files[0]
          if (e.target.files && file) {
            let url = URL.createObjectURL(file)
            $('#imageUpload').attr('src', url)
            $('#uploadImageLabel').html(file.name)
          }
        }
      }) // End Upload Image
    })
  </script>

@endsection
