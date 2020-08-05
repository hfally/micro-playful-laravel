<!Doctype html>

<html lang="en">
<head>
    <title>LawPavilion | AI Document Review</title>

    <!-- IMPORT STYLESHEET -->
    <link rel="stylesheet" href="<?= asset('bootstrap/bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>"/>
</head>

<body>
<main class="bg-white">
    <!-- LOADER -->
    <div id="loader" style="display: none">
        <div class="inner">
            ANALYZING
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar"
                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-6 p-5">
                <div class="container">
                    <h3 class="font-weight-bold mb-4">Document Review</h3>
                    <form id="document-review">
                        <div class="form-group file">
                            <input type="file" name="pdf" class="form-control" accept="application/pdf"/>
                            <div class="upload-room d-flex flex-column justify-content-center align-content-center">
                                <span class="text-center">Upload your file here</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-center align-content-center">
                                <hr class="w-100"/>

                                <div style="margin-top: 3px; color: #495057" class="mx-2">
                                    or
                                </div>

                                <hr class="w-100"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Copy and paste file content..."
                                      title="Content" rows="12"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="label">LABEL</label>
                            <select class="form-control" name="label" id="label">
                                <option value="">Select an option...</option>

                                <option value="case">Cases</option>
                                <option value="law">Laws</option>
                            </select>
                        </div>

                        <hr class="my-4">

                        <div class="text-right">
                            <button class="btn" type="reset">Clear</button>
                            <button class="btn btn-theme">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-6 p-5 result">
                <div id="placeholder" class="placeholder d-flex flex-column justify-content-center align-items-center">
                    <img src="<?= asset('images/man.png') ?>" alt="Document"/>

                    <div class="text-center mt-3 text-dark">
                        Currently, there is no available
                        <br/>
                        note to be analysed.
                    </div>
                </div>

                <div id="analysis" style="display: none">
                    <div class="d-flex align-content-center justify-content-between">
                        <h3 class="font-weight-bold mb-4">Analyzed Result</h3>

                        <div class="text-theme font-weight-bold"><span class="total-result">4</span> Results found
                        </div>
                    </div>

                    <li class="list-group-item d-none justify-content-between align-items-center my-1 " id="list-template" >
                        <div>
                            <span class="title"></span> <span class="text-theme year"></span>
                        </div>
                        <button class="btn btn-sm">View</button>
                    </li>

                    <ul class="list-group result-set" id="result-set">
                        <?php foreach (range(1, 5) as $each): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center my-1">
                                <div>
                                    Audu v. Bayo <span class="text-theme">(1981)</span>
                                </div>
                                <button class="btn btn-sm">View</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- IMPORT SCRIPT -->
<script>
    const baseUrl = "<?= env('APP_URL') ?>";
</script>
<script src="<?= asset('js/jquery.js') ?>"></script>
<script src="<?= asset('bootstrap/bootstrap.min.js') ?>"></script>
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>