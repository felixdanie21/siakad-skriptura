<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMPORT CSV</title>
</head>
<body>
    <p><?= $this->session->userdata('message') ?></p>
    <?php $this->session->unset_userdata('message');?>
    <form action="<?= base_url() ?>SuperAdmin/importCsv_insert" method="post" enctype="multipart/form-data">
        <label for="exampleInputFile" class="font-weight-normal">File Csv</label>
        <select class="form-control" name="file" required>
            <option value="">Pilih</option>
            <?php $jml = count($file) - 1; ?>
            <?php for ($i = 2; $i <= $jml; $i++) : ?>
                <option value="<?= $file[$i]; ?>"><?= $file[$i] ?></option>
            <?php endfor; ?>
        </select>
        <label for="exampleInputFile" class="font-weight-normal">Table</label>
        <select class="form-control" name="table" required>
            <option value="">PILIH</option>
            <?php foreach ($table as $t) : ?>
                <option value="<?= $t; ?>"><?= $t ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-block btn-info">Proses</button>
    </form>
</body>
</html>