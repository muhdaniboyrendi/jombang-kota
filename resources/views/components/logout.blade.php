<div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Are you sure to logout?
                </div>
                <div class="modal-footer">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn app-btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>