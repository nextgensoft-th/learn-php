<?php require view_path('layouts/app/head.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-4 py-2">
                <h1 class="text-gray-900 font-bold text-2xl">Edit Note</h1>
                <form action="/notes/update" method="POST" class="mt-6">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="mb-4">
                        <input type="hidden" name="id" value="<?= $note['id'] ?>">
                        <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
                        <textarea name="body" id="body" cols="30" rows="10" placeholder="Here's an idea for a note..."
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= isset($_POST['body']) ? htmlspecialchars($_POST['body']) : htmlspecialchars($note['body']) ?></textarea>
                        <?php if (isset($errors['body'])): ?>
                            <p class="text-red-500 text-xs italic mt-2"><?= $errors['body'] ?></p>
                        <?php endif; ?>
                        <input name="writer" id="writer" type="hidden" value="John Doe">
                    </div>
                    <div class="flex items center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update
                        </button>
                        <a href="/notes"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                           type="button">
                            Back
                        </a>
                    </div>
</main>

<?php require view_path('layouts/app/footer.php') ?>
