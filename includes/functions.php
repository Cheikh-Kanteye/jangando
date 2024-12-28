<?php
function checkSession()
{
  if (!isset($_SESSION['role'])) {
    require "./views/login.php";
    exit;
  }
}


function paginate($totalResults, $resultsPerPage = 10, $currentPage = 1, $baseUrl = '')
{
  // Calculate the total number of pages
  $totalPages = ceil($totalResults / $resultsPerPage);

  // Ensure current page is within the valid range
  $currentPage = max(1, min($currentPage, $totalPages));

  // Calculate the offset for fetching results
  $offset = ($currentPage - 1) * $resultsPerPage;

  // Generate the pagination buttons HTML
  $paginationHtml = '<div class="pagination">';
  for ($page = 1; $page <= $totalPages; $page++) {
    $activeClass = $page === $currentPage ? 'active' : '';
    $paginationHtml .= sprintf(
      '<button onclick="window.location.href=\'%s?page=%d\'" class="tab %s"><span>%d</span></button>',
      $baseUrl,
      $page,
      $activeClass,
      $page
    );
  }
  $paginationHtml .= '</div>';

  return [$offset, $paginationHtml];
}
