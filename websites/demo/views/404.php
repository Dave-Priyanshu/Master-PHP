<?php require "views/partials/head.php"; ?>
<?php require "views/partials/nav.php"; ?>

<main>
    <div class="flex flex-col items-center justify-center min-h-[80vh] px-4 py-12 sm:px-6 lg:px-8 text-center">
        <h1 class="text-9xl font-extrabold text-gray-300 tracking-widest">404</h1>
        <div class="bg-indigo-500 px-2 text-sm text-white rounded rotate-12 absolute mt-[-3rem]">
            Page Not Found
        </div>

        <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Oops! We couldn't find that page.</h2>
        <p class="mt-2 text-lg text-gray-600">
            The page you're looking for doesn't exist or has been moved.
        </p>

        <a href="/" 
           class="mt-6 inline-block px-6 py-3 text-lg font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
            Go to Home
        </a>
    </div>
</main>

<?php require "views/partials/footer.php"; ?>
