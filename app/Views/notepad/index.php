<?= $this->extend("layouts/user"); ?>
<?= $this->section("content"); ?>

<div class="row">
    <div class="col">
        <form>
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <input type="text" class="form-control note-title" id="exampleFormControlInput1" placeholder="Note Title">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control note-content" id="summernote" rows="15" placeholder="Note Content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
        </form>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <h5 class="saved-notes mb-3">My Saved Notes</h5>
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Akun ku</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium autem maiores eos similique totam, necessitatibus sunt rerum magnam quo hic. Autem culpa rem, aut magnam aspernatur, in minus expedita odio cumque corrupti consequatur, minima similique soluta voluptas d</td>
                            <td class="d-flex ">
                                <a href="" class="btn btn-success">Detail</a>
                                <a href="" class="btn btn-danger">Delete</a>
                                <a href="" class="btn btn-warning">Update</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>