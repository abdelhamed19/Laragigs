<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>
<body class="mb-48">
<main>
    <div class="mx-4">
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">

            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Register
                </h2>
                <a href="{{route("showlogin")}}" class="mb-4 text-red-500 hover:text-black">Already have account? Login</a>
            </header>

            <form method="post" action="{{route("register")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label
                        for="name"
                        class="inline-block text-lg mb-2"
                    >Name</label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="name" value="{{old("name")}}"

                    />
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="title" class="inline-block text-lg mb-2"
                    >Email</label
                    >
                    <input
                        type="email"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email" value="{{old("email")}}"
                        placeholder="JobFiled@email.com"
                    />
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="password"
                        class="inline-block text-lg mb-2"
                    >Password</label
                    >
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password"
                    />
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="cpassword"
                        class="inline-block text-lg mb-2"
                    >Confirm Password</label
                    >
                    <input
                        type="password"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation"
                    />
                    @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <button
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Register
                    </button>

                    <a href="/" class="text-black ml-4"> Back to Home Page </a>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>
