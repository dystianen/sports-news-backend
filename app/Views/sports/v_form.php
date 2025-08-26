<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($role) ? 'Edit' : 'Add' ?> Sport</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/sports/save') ?>" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= isset($sport) ? $sport['sport_id'] : '' ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          value="<?= isset($sport) ? esc($sport['name']) : '' ?>"
          required>
      </div>

      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input
          type="text"
          name="slug"
          class="form-control"
          value="<?= isset($sport) ? esc($sport['slug']) : '' ?>"
          required>
      </div>

      <a href="<?= base_url('/sports') ?>" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary"><?= isset($sport) ? 'Update' : 'Save' ?></button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>