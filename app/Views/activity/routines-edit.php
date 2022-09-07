<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>
<?php if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">x</button>
            <?= session()->getFlashdata('success') ?>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col">
        <form action="/routines/update/<?= $routines['routine_id'] ?>" method="POST">
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <label class="text-dark"><strong>Activity</strong></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g Reading" value="<?= $routines['title'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="text-dark"><strong>Description</strong></label>
                        <textarea class="form-control" rows="10" name="description" placeholder="e.g Reading novel 10 pages"><?= $routines['description'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="text-dark"><strong>Time</strong></label>
                        <input type="time" name="time" class="form-control" value="<?= $routines['time'] ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-floppy-disk mr-1"></i> Update</button>
            <a href="<?= route_to('routine') ?>" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Back</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>