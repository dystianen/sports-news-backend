<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header mb-4 pb-0 d-flex align-items-center justify-content-between">
    <h4>Matches List</h4>
    <a href="<?= base_url('/matches/form') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Match</a>
  </div>

  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive px-4">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th>No</th>
            <th>Category</th>
            <th>Team Home</th>
            <th>Team Away</th>
            <th>Match Date</th>
            <th>Status</th>
            <th>Score Home</th>
            <th>Score Away</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $startIndex = ($pager["currentPage"] - 1) * $pager["limit"] + 1; ?>

          <?php if (empty($matches)): ?>
            <tr>
              <td colspan="9" class="text-center text-muted">No user data available.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($matches as $match): ?>
              <tr>
                <td><?= $startIndex++ ?></td>
                <td><?= $match['sport_name'] ?></td>
                <td><?= $match['team_home_name'] ?></td>
                <td><?= $match['team_away_name'] ?></td>
                <td><?= date('d M Y', strtotime($match['match_date'])) ?></td>
                <td>
                  <?php
                  $badgeClass = '';
                  $statusText = ucfirst($match['status']);

                  switch ($match['status']) {
                    case 'upcoming':
                      $badgeClass = 'bg-primary';
                      break;
                    case 'ongoing':
                      $badgeClass = 'bg-warning';
                      break;
                    case 'finished':
                      $badgeClass = 'bg-success';
                      break;
                    case 'cancelled':
                      $badgeClass = 'bg-danger';
                      break;
                    default:
                      $badgeClass = 'bg-secondary';
                  }
                  ?>
                  <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                </td>
                <td class="text-center">
                  <?php if ($match['status'] == 'finished'): ?>
                    <strong><?= $match['score_home'] ?></strong>
                  <?php else: ?>
                    <?= $match['score_home'] ?: '-' ?>
                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <?php if ($match['status'] == 'finished'): ?>
                    <strong><?= $match['score_away'] ?></strong>
                  <?php else: ?>
                    <?= $match['score_away'] ?: '-' ?>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= base_url('/matches/form?id=' . $match['match_id']) ?>"
                    class="btn btn-sm btn-warning"
                    title="Edit Match">
                    <i class="fa fa-edit"></i>
                  </a>
                  <form action="<?= base_url('/matches-schedule/delete/' . $match['match_id']) ?>"
                    method="post"
                    style="display:inline-block;">
                    <?= csrf_field() ?>
                    <button type="submit"
                      class="btn btn-sm btn-danger"
                      title="Delete Match"
                      onclick="return confirm('Are you sure you want to delete this match?')">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>

      </table>
    </div>

    <nav aria-label="Page navigation example" class="mt-4 mx-4">
      <ul class="pagination" id="pagination">
      </ul>
    </nav>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
  var currentURL = window.location.search;
  var urlParams = new URLSearchParams(currentURL);
  var pageParam = urlParams.get('page');

  // PAGINATION
  function handlePagination(pageNumber) {
    window.location.replace(`<?php echo base_url(); ?>matches?page=${pageNumber}`);
  }

  var paginationContainer = document.getElementById('pagination');
  var totalPages = <?= $pager["totalPages"] ?>;
  if (totalPages >= 1) {
    for (var i = 1; i <= totalPages; i++) {
      var pageItem = document.createElement('li');
      pageItem.classList.add('page-item');
      pageItem.classList.add('primary');
      if (i === <?= $pager["currentPage"] ?>) {
        pageItem.classList.add('active');
      }

      var pageLink = document.createElement('a');
      pageLink.classList.add('page-link');
      pageLink.href = 'javascript:void(0);'
      pageLink.textContent = i;

      pageLink.addEventListener('click', function() {
        var pageNumber = parseInt(this.textContent);
        handlePagination(pageNumber);
      });

      pageItem.appendChild(pageLink);
      paginationContainer.appendChild(pageItem);
    }
  }
</script>
<?= $this->endSection() ?>