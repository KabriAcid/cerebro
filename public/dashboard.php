<?php require __DIR__ . '/../config/database.php'; ?>
<?php require __DIR__ . '/../util/utilities.php'; ?>
<?php
$user = [
    "name" => "M Shehu",
    "username" => "Shehu",
    "email" => "shehu@gmail.com",
    "registration_status" => "complete",
]
?>
<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main>
        <?php
        if ($user['registration_status'] != 'complete') {
        ?>
            <section class="my-5" id="select-role">
                <div class="container" style="max-width: 600px;">
                    <div class="card p-3 border-0 rounded mt-5">
                        <div class="card-body">
                            <div class="mb-5">
                                <h2 class="primary">What is your role?</h2>
                                <p class="text-secondary">Select what best describes you.</p>
                            </div>
                            <div class="row mb-3">
                                <!-- Card -->
                                <div class="col-6">
                                    <div class="info-card">
                                        <div>
                                            <svg width="32" height="30" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#141C25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-secondary fw-bold">Student</h6>
                                        </div>

                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="col-6">
                                    <div class="info-card">
                                        <div>
                                            <svg width="30" height="30" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 17V16C1 12.134 4.13401 9 8 9M15 17V16C15 12.134 11.866 9 8 9M8 9C10.2091 9 12 7.20914 12 5C12 2.79086 10.2091 1 8 1C5.79086 1 4 2.79086 4 5C4 7.20914 5.79086 9 8 9Z" stroke="#141C25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                        </div>
                                        <div>
                                            <h6 class="text-secondary fw-bold">Teacher</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Card -->
                                <div class="col-6">
                                    <div class="info-card">
                                        <div>
                                            <svg width="32" height="30" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#141C25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-secondary fw-bold">Student</h6>
                                        </div>

                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="col-6">
                                    <div class="info-card">
                                        <div>
                                            <svg width="32" height="30" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#141C25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-secondary fw-bold">Student</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="text-end mt-5">
                                <button id="submit-role" style="background-color: #e500ac;border-radius:4px;" class="border-0 text-white fw-bold py-2 px-4 d-block">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>
        <section class="my-5">
            <h1 class="text-center fw-bold mt-5">How may I assist you today?</h1>
        </section>
        <section class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="position-relative d-flex align-items-center">
                    <!-- Upload Media Button -->
                    <button type="button" class="upload-media-btn" title="Upload Media">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 16V8M8 12H16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#e500ac" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Input Field -->
                    <input type="text" class="input-field" placeholder="Type message here" name="message">

                    <!-- Upload Button Inside Input -->
                    <button type="submit" class="submit-btn">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>
    </main>
    <script src="../assets/js/ajax.js"></script>
</body>

</html>