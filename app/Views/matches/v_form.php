<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($match) ? 'Edit' : 'Add' ?> Match</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/matches/save') ?>" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= isset($match) ? $match['match_id'] : '' ?>">

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="sport_id" class="form-label">Category</label>
          <select class="form-select" id="sport_id" name="sport_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($categories as $category): ?>
              <option value="<?= $category['sport_id'] ?>"
                <?= old('sport_id', $match['sport_id'] ?? '') == $category['sport_id'] ? 'selected' : '' ?>>
                <?= esc($category['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="match_date" class="form-label">Match Date</label>
          <input type="date" class="form-control" name="match_date" id="match_date"
            value="<?= old('match_date', $match['match_date'] ?? '') ?>" required>
        </div>

        <div class="col-md-6 mb-3">
          <label for="team_home_id" class="form-label">Team Home</label>
          <select class="form-select" id="team_home_id" name="team_home_id" required>
            <option value="">-- Select Team Home --</option>
            <?php foreach ($teams as $team): ?>
              <option value="<?= $team['team_id'] ?>"
                <?= old('team_home_id', $match['team_home_id'] ?? '') == $team['team_id'] ? 'selected' : '' ?>>
                <?= esc($team['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="team_away_id" class="form-label">Team Away</label>
          <select class="form-select" id="team_away_id" name="team_away_id" required>
            <option value="">-- Select Team Away --</option>
            <?php foreach ($teams as $team): ?>
              <option value="<?= $team['team_id'] ?>"
                <?= old('team_away_id', $match['team_away_id'] ?? '') == $team['team_id'] ? 'selected' : '' ?>>
                <?= esc($team['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="score_home" class="form-label">Score Home</label>
          <input
            type="number"
            name="score_home"
            id="score_home"
            class="form-control"
            value="<?= old('score_home', $match['score_home'] ?? '') ?>"
            placeholder="e.g. 5"
            min="0">
        </div>

        <div class="col-md-6 mb-3">
          <label for="score_away" class="form-label">Score Away</label>
          <input
            type="number"
            name="score_away"
            id="score_away"
            class="form-control"
            value="<?= old('score_away', $match['score_away'] ?? '') ?>"
            placeholder="e.g. 0"
            min="0">
        </div>

        <div class="col-md-6 mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" name="status" id="status" required>
            <option value="">-- Select Status --</option>
            <option value="upcoming"
              <?= old('status', $match['status'] ?? '') === 'upcoming' ? 'selected' : '' ?>>
              Upcoming
            </option>
            <option value="ongoing"
              <?= old('status', $match['status'] ?? '') === 'ongoing' ? 'selected' : '' ?>>
              Ongoing
            </option>
            <option value="finished"
              <?= old('status', $match['status'] ?? '') === 'finished' ? 'selected' : '' ?>>
              Finished
            </option>
          </select>
        </div>
      </div>

      <div class="mt-3">
        <a href="<?= base_url('/matches') ?>" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary"><?= isset($match) ? 'Update' : 'Save' ?></button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>