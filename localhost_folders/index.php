<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SERVER['HTTP_HOST'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="styles.css" rel="stylesheet"/>
</head>

<body>

    <main class="container my-5">
        <div class="card card-folders">
            <section class="card-header">
                <div class="row align-items-center">
                    <div class="col mr-auto">
                        <h4 class="card-title m-0"><?= $_SERVER['HTTP_HOST'] ?></h4>
                    </div>
                    <div class="col col-auto pr-2">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary" id="btn-list"><i class="fa fa-th-list fa-lg"></i></button>
                            <button class="btn btn-sm btn-outline-secondary outline-none active" id="btn-grid"><i class="fa fa-th-large fa-lg"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Folders Container -->
            <section class="card-body" id="foldersGroup">
                <div id="main-folders" class="d-flex align-items-stretch flex-wrap">
                    <?php
                    if ($handle = opendir('.')) {
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != "..") {
                                if (is_dir($entry)) {

                                    echo " <a href='/{$entry}' class='d-inline-flex'>
                                        <button class='folder-container'>
                                            <div class='folder-icon'>
                                                <i class='fa fa-folder folder-icon-color'></i>
                                            </div>
                                            <div class='folder-name'>{$entry}</div>
                                        </button>
                                    </a>";
                                }
                            }
                        }

                        closedir($handle);
                    }
                    ?>
                </div>
            </section>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Grid or list selection
            $('#btn-list').on('click', function() {
                $('#main-folders').addClass('flex-column');
                $('#btn-grid').removeClass('active')
                $(this).addClass('active')
            });
            $('#btn-grid').on('click', function() {
                $('#main-folders').removeClass('flex-column');
                $('#btn-list').removeClass('active')
                $(this).addClass('active')
            });

        });
    </script>
</body>

</html>