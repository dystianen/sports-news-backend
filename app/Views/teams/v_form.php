<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($role) ? 'Edit' : 'Add' ?> Team</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/teams/save') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= isset($team) ? $team['team_id'] : '' ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          value="<?= isset($team) ? esc($team['name']) : '' ?>"
          placeholder="e.g. Real Madrid"
          required>
      </div>

      <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input
          type="file"
          name="logo"
          class="form-control"
          <?= isset($team) ? '' : 'required' ?> />

        <?php if (isset($team) && $team['logo']): ?>
          <div class="mt-2">
            <img src="<?= base_url('uploads/teams/' . $team['logo']) ?>" alt="Logo" width="100">
          </div>
        <?php endif; ?>
      </div>

      <a href="<?= base_url('/teams') ?>" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary"><?= isset($team) ? 'Update' : 'Save' ?></button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>