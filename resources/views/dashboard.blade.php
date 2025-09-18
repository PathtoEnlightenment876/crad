@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Your admin dashboard table here -->

        <!-- Feedback Modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="feedbackForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Send Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="feedback" class="form-control" rows="4" placeholder="Enter feedback..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    var feedbackModal = document.getElementById('feedbackModal');
    var feedbackForm = document.getElementById('feedbackForm');

    feedbackModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; 
        var fileId = button.getAttribute('data-id'); 

        feedbackForm.action = "/admin/submission/" + fileId + "/feedback";
    });
});
</script>
@endsection
