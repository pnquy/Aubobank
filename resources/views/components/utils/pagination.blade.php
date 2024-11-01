@props(['paginationData'])

<nav aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item mr-4">
            <a class="page-link rounded h4" href="{{ $paginationData->previousPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>

        </li>
        @foreach ($paginationData->getUrlRange(1, $paginationData->lastPage()) as $page => $url)
            <li class="page-item mx-2 {{ $paginationData->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link rounded h4" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach



        <li class="page-item ml-4 bg-none">
            <a class="page-link rounded h4" href="{{ $paginationData->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
