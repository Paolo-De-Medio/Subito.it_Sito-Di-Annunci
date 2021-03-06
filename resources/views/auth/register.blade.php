<x-layout>
  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    <div class="container-fluid body-register h-100 m-0">
        <div class="row">
          <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5 shadow">
              <div class="card-img-left d-none d-md-flex">
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">{{ __('ui.registrati') }}</h5>
                <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="userName" class="form-label">{{ __('ui.ins user') }}</label>
                      <input type="text" name="name" class="form-control" id="userName">
                    </div>
                    <div class="mb-3">
                      <label for="userMail" class="form-label">{{ __('ui.ins email') }}</label>
                      <input type="email" name="email" class="form-control" id="userMail">
                    </div>
                    <div class="mb-3">
                        <label for="userPass" class="form-label">{{ __('ui.ins pw') }}</label>
                        <input type="password" name="password" class="form-control" id="userPass">
                    </div>
                    <div class="mb-3">
                        <label for="confirmationPass" class="form-label">{{ __('ui.conf pw') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirmationPass">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('ui.registrati') }}</button>
                    <p class="mt-2">
                      {{ __('ui.gia iscritto') }} <a class="tc-accent" href="{{'login'}}">{{ __('ui.accedi') }}</a>
                    </p>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>








    </x-layout>
