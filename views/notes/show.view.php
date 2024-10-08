<?php require view_path('layouts/app/head.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="mt-6">
            <a href="/notes" class="text-blue-500 hover:underline">Back to notes...</a>
        </p>
        <hr class="mb-6 mt-2"/>

        <p><?= isset($note['body']) ? htmlspecialchars($note['body']) : 'Note load error' ?></p>

        <footer class="mt-6">
            <a href="/notes/edit?id=<?= $note['id'] ?>" class="test-gray-500 border border-current px-4 py-2 rounded">Edit</a>

            <form class="mt-4" method="POST" action="/notes/destroy">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>
        </footer>


    </div>
</main>

<?php require view_path('layouts/app/footer.php') ?>
