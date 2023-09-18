<?php
  session_start();
  require __DIR__.'/../vendor/autoload.php';
  $authKey = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:xx"; // Replace with your key
  $translator = new \DeepL\Translator($authKey);
  $usage = $translator->getUsage();

  $langs = [
    [
      "name" => "Italian",
      "value" => "IT",
      "flag" => "&#x1F1EE&#x1F1F9"
    ],
    [
      "name" => "English",
      "value" => "EN-GB",
      "flag" => "&#x1F1EC&#x1F1E7"
    ],
    [
      "name" => "French",
      "value" => "FR",
      "flag" => "&#x1F1EB&#x1F1F7"
    ],
    [
      "name" => "Spanish",
      "value" => "ES",
      "flag" => "&#x1F1EA&#x1F1F8"
    ],
    [
      "name" => "German",
      "value" => "DE",
      "flag" => "&#x1F1E9&#x1F1EA"
    ],
  ];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DeepL by signoredellarete.org" />
    <meta property="og:title" content="DeepL by signoredellarete.org" />
    <meta property="og:url" content="https://deepl.signoredellarete.org/" />
    <meta property="og:description" content="DeepL by signoredellarete.org" />
    <meta property="og:image" content="/img/icons/logo-deepl-signoredellarete-org.png" />

    <title>DeepL by signoredellarete.org</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" 
      type="image/png" 
      href="/img/favicon/favicon_16.png" />
  </head>
  <body style="background-color: lightsteelblue;">
    <div class="row">
      <div class="col text-center">
        <?php if ($usage->anyLimitReached()) { ?>
        <div class="alert alert-danger font-monospace  fw-bold h4" role="alert">
          Translation limit exceeded!
        </div>
        <?php } ?>
      </div>
    </div>

    <div class="row">
      <div class="col text-center mb-5">
        <h1><a class="text-decoration-none" href="/index.php">DeepL</a></h1>
        <p class="font-monospace h6">by <span class="fw-bold">signoredellarete.org</span></p>
      </div>
    </div>

    <div class="container">
      <div class="row">

        <div class="col">

          <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="mb-3">
              <label for="text" class="form-label font-monospace h5">Input Text</label>
              <textarea id="text" name="text" class="form-control" id="text" rows="12" required><?php if (isset($_POST['text'])) {echo $_POST['text'];} ?></textarea>
            </div>

            <div class="mb-3">
              <label for="lang" class="form-label font-monospace h5">Translate into:</label>
              <select role="button" id="lang" name="lang" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php foreach ($langs as $lang) { ?>
                <option 
                  value="<?php echo $lang['value'] ?>" 
                  <?php if (isset($_POST['lang']) && $_POST['lang'] == $lang['value']) {
                    echo "selected";
                  }
                  ?>
                ><?php echo $lang['flag'] ?> <?php echo $lang['name'] ?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="text-end d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg font-monospace">Translate</button>
              <a class="btn btn-link font-monospace fw-bold" href="/index.php">Reset</a>
            </div>
            
          </form>

        </div> <!-- /col -->

        <div class="col">

          <div class="mb-3">
            <label for="translation" class="form-label font-monospace h5">Translation</label>
              <?php
                if (isset($_POST['text']) && isset($_POST['lang'])) {
                  $result = $translator->translateText($_POST['text'], null, $_POST['lang']);
                  $usage = $translator->getUsage();
                }
              ?>
            <textarea class="form-control" id="translation" rows="12"><?php echo $result->text; ?></textarea>
          </div>

          <div class="mb-3">

            <label
              for="limits"
              class="form-label font-monospace h5"
            >
              Used characters: 
              <span class="text-primary fw-bolder">
                <?php echo $usage->character->count ?>
              </span> 
              of 
              <span class="fw-bolder">
                <?php echo $usage->character->limit; ?>
              </span>
            </label>

            <div id="limits" class="progress font-monospace" style="height:24px; border-radius:50px; position: relative;">
              <?php
                $percentage = round((100 * $usage->character->count / $usage->character->limit), 1);
              ?>
              <div
                class="progress-bar bg-secondary"
                role="progressbar"
                aria-label="Example with label"
                style="width: <?php echo $percentage ?>%; font-size:20px"
                aria-valuenow="<?php echo $percentage ?>"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
              <div class="text-center h5" style="position: absolute; width: 100%; left: 0px; line-height: 24px">
                <?php echo $percentage ?>%
              </div>
            </div>

          </div>

        </div> <!-- /col -->

      </div> <!-- /row -->
    </div> <!-- /container -->

    














    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>