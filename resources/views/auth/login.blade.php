<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Digital SMP Negeri 3 Tapango</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-primary">
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-3 shadow-lg">
                    <div class="card-body">
                        <a href="" class="text-decoration-none text-default">
                            <p class="fs-4 fw-bold mb-4">Perpus Digital SMP Negeri 3 Tapango</p>
                        </a>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('authenticate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="device_id" id="device_id">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="password" class="mb-2 mt-3">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button class="btn btn-primary mt-4 float-end fw-bold px-4 py-2 rounded-5 text-default"
                                type="submit">Masuk</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script>
        if (!localStorage.getItem("device_id")) {
            localStorage.setItem("device_id", crypto.randomUUID());
        }
        document.getElementById("device_id").value = localStorage.getItem("device_id");
    </script>
</body>

</html>
