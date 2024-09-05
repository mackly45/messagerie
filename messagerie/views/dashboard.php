<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2 class="title is-3 has-text-centered mb-5">Welcome to the Dashboard</h2>

    <!-- Display messages with styling and animation -->
    <div id="messages-section" class="box shadow-lg rounded-lg p-5">
        <?php if (!empty($messages)) { ?>
            <?php foreach ($messages as $message): ?>
                <div class="message p-4 mb-3 bg-white border rounded-lg shadow-sm animate__animated animate__fadeInUp">
                    <div class="is-flex is-align-items-center mb-2">
                        <strong class="mr-3"><?= $message['expediteur'] ?></strong> 
                        <span class="has-text-grey-light"><em><?= date('d M Y H:i', strtotime($message['date_envoi'])) ?></em></span>
                    </div>
                    <p class="has-text-justified"><?= $message['message'] ?></p>
                    <div class="is-flex is-align-items-center mt-3">
                        <!-- Reaction buttons -->
                        <button class="button is-small is-info mr-2">
                            <i class="fas fa-star"></i> Star
                        </button>
                        <button class="button is-small is-warning mr-2">
                            <i class="fas fa-fire"></i> Flame
                        </button>
                        <button class="button is-small is-success mr-2">
                            <i class="fas fa-treasure-chest"></i> Treasure
                        </button>
                        <!-- Edit and delete options -->
                        <button class="button is-small is-light ml-auto">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="button is-small is-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <p class="has-text-centered has-text-grey-light">No messages available.</p>
        <?php } ?>
    </div>

    <!-- File sharing and reactions section -->
    <div class="box mt-5 p-5 bg-light">
        <h3 class="title is-4 has-text-centered mb-4">Share a File</h3>
        <form id="file-sharing-form" class="has-text-centered">
            <div class="file is-centered mb-3">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                </label>
            </div>
            <button type="submit" class="button is-info is-light">Upload File</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
