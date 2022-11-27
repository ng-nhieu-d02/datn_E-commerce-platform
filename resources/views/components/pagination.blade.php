@if ($paginator->lastPage() > 1)
<style>
    .pagination > li > a {
        font-size: 1.4rem;
        padding: 5px 10px;
    }
    .container-pagination {
        margin-top: 20px;
    }
</style>
<nav class="container-pagination" aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url(1) }}">Previous</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">Next</a>
            </li>
    </ul>
</nav>
@endif