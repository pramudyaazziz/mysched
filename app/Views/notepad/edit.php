<?= $this->extend("layouts/user") ?>
<?= $this->section("content") ?>
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
        <form action="/notepad/edit/<?= $note['note_id'] ?>" method="POST">
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <input type="text" name="note_title" class="form-control note-title" placeholder="Note Title" value="<?= $note['note_title'] ?>">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control note-content" name="note_content" id="summernote" placeholder="Note Content"><?= $note['note_content'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-floppy-disk mr-1"></i> Update</button>
            <a href="<?= route_to('notepad') ?>" class="btn btn-primary"><i class="fa-solid fa-close mr-1"></i> Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>